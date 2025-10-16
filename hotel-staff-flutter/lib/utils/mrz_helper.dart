import 'package:flutter/foundation.dart';
import 'package:mrz_parser/mrz_parser.dart';

/// MRZ-Only Helper - Fast and Accurate Document Scanning
/// Uses ONLY the Machine Readable Zone (MRZ) for data extraction
class MRZHelper {
  /// Extract data from MRZ (Machine Readable Zone)
  /// Returns: Map with extracted fields or null if MRZ not found
  static Future<Map<String, dynamic>?> extractFromMRZ(String text) async {
    try {
      debugPrint('🔍 MRZ-ONLY extraction started');

      // Clean and prepare MRZ lines
      final mrzLines = _extractMRZLines(text);
      if (mrzLines.isEmpty) {
        debugPrint('❌ No MRZ lines found');
        return null;
      }

      debugPrint('📋 Found ${mrzLines.length} potential MRZ lines:');
      for (int i = 0; i < mrzLines.length; i++) {
        debugPrint('  Line $i: ${mrzLines[i]} (${mrzLines[i].length} chars)');
      }

      // Try passport format (TD-3: 2 lines x 44 chars)
      Map<String, dynamic>? result = _tryPassportMRZ(mrzLines);
      if (result != null) {
        debugPrint('✅ Passport MRZ extracted: ${result.length} fields');
        return result;
      }

      // Try ID card format (TD-1: 3 lines x 30 chars)
      result = _tryIDCardMRZ(mrzLines);
      if (result != null) {
        debugPrint('✅ ID Card MRZ extracted: ${result.length} fields');
        return result;
      }

      debugPrint('❌ MRZ parsing failed - invalid format');
      return null;
    } catch (e) {
      debugPrint('❌ MRZ extraction error: $e');
      return null;
    }
  }

  /// Extract and clean MRZ lines from OCR text
  static List<String> _extractMRZLines(String text) {
    return text
        .split('\n')
        .map((line) => _cleanMRZLine(line))
        .where((line) => _isMRZLine(line))
        .toList();
  }

  /// Clean OCR text for MRZ processing
  static String _cleanMRZLine(String line) {
    return line
        .trim()
        // Fix common OCR character errors
        .replaceAll('«', '<')
        .replaceAll('»', '<')
        .replaceAll('‹', '<')
        .replaceAll('›', '<')
        .replaceAll('〈', '<')
        .replaceAll('〉', '<')
        .replaceAll('《', '<')
        .replaceAll('》', '<')
        .replaceAll(RegExp(r'[Οο]'), '0') // Greek O -> 0
        .replaceAll(RegExp(r'[lI\|]'), '1') // l/I/| -> 1 in numbers
        // Keep only MRZ valid characters: A-Z, 0-9, <
        .replaceAll(RegExp(r'[^A-Z0-9<]'), '')
        .toUpperCase();
  }

  /// Check if line looks like MRZ
  static bool _isMRZLine(String line) {
    // MRZ lines are 28-44 characters
    if (line.length < 25 || line.length > 45) return false;

    // Must contain MRZ markers (< or start with document type)
    if (!line.contains('<') &&
        !line.startsWith('P') &&
        !line.startsWith('I') &&
        !line.startsWith('A') &&
        !line.startsWith('C')) {
      return false;
    }

    // Must be mostly uppercase letters and numbers
    final validChars = line.replaceAll(RegExp(r'[A-Z0-9<]'), '').length;
    return validChars == 0; // All characters must be valid MRZ chars
  }

  /// Try parsing as passport (TD-3 format: 2 lines x 44 chars)
  static Map<String, dynamic>? _tryPassportMRZ(List<String> lines) {
    for (int i = 0; i < lines.length - 1; i++) {
      final line1 = _padMRZLine(lines[i], 44);
      final line2 = _padMRZLine(lines[i + 1], 44);

      // Check if it looks like passport MRZ
      if (!line1.startsWith('P') || !line1.contains('<<')) continue;
      if (line1.length != 44 || line2.length != 44) continue;

      debugPrint('🎯 Trying passport MRZ:');
      debugPrint('  L1: $line1');
      debugPrint('  L2: $line2');

      try {
        // Use mrz_parser library
        final result = MRZParser.tryParse([line1, line2]);
        if (result != null) {
          return _convertToMap(result, 'Passport');
        }
      } catch (e) {
        debugPrint('⚠️ Parser failed: $e');
      }

      // Manual parsing as fallback
      final manual = _manualPassportParse(line1, line2);
      if (manual != null && manual.isNotEmpty) {
        return manual;
      }
    }
    return null;
  }

  /// Try parsing as ID card (TD-1 format: 3 lines x 30 chars)
  static Map<String, dynamic>? _tryIDCardMRZ(List<String> lines) {
    for (int i = 0; i < lines.length - 2; i++) {
      final line1 = _padMRZLine(lines[i], 30);
      final line2 = _padMRZLine(lines[i + 1], 30);
      final line3 = _padMRZLine(lines[i + 2], 30);

      // Check if it looks like ID card MRZ
      if (!line1.startsWith('I') &&
          !line1.startsWith('A') &&
          !line1.startsWith('C')) continue;
      if (line1.length != 30 || line2.length != 30 || line3.length != 30) {
        continue;
      }

      debugPrint('🎯 Trying ID card MRZ:');
      debugPrint('  L1: $line1');
      debugPrint('  L2: $line2');
      debugPrint('  L3: $line3');

      try {
        // Use mrz_parser library
        final result = MRZParser.tryParse([line1, line2, line3]);
        if (result != null) {
          return _convertToMap(result, 'ID Card');
        }
      } catch (e) {
        debugPrint('⚠️ Parser failed: $e');
      }

      // Manual parsing as fallback
      final manual = _manualIDCardParse(line1, line2, line3);
      if (manual != null && manual.isNotEmpty) {
        return manual;
      }
    }
    return null;
  }

  /// Pad or truncate MRZ line to exact length
  static String _padMRZLine(String line, int length) {
    if (line.length > length) return line.substring(0, length);
    if (line.length < length) return line.padRight(length, '<');
    return line;
  }

  /// Convert MRZ parser result to our format
  static Map<String, dynamic> _convertToMap(
      MRZResult result, String docType) {
    final data = <String, dynamic>{
      'documentType': docType,
      'source': 'MRZ',
    };

    // Document info
    if (result.documentNumber.isNotEmpty) {
      data['documentNumber'] = result.documentNumber;
    }

    // Personal info
    if (result.surnames.isNotEmpty) {
      data['lastName'] = result.surnames.replaceAll('<', ' ').trim();
    }
    if (result.givenNames.isNotEmpty) {
      data['firstName'] = result.givenNames.replaceAll('<', ' ').trim();
    }

    // Nationality
    if (result.nationalityCountryCode.isNotEmpty) {
      data['nationality'] = _getCountryName(result.nationalityCountryCode);
      data['nationalityCode'] = result.nationalityCountryCode;
    }

    // Dates
    data['dateOfBirth'] = _formatDate(result.birthDate);
    data['expiryDate'] = _formatDate(result.expiryDate);

    // Gender
    final sexValue = result.sex.toString().split('.').last;
    if (sexValue.isNotEmpty && sexValue != 'unspecified') {
      data['sex'] = sexValue.toUpperCase();
      data['gender'] = sexValue == 'male' ? 'Male' : 'Female';
    }

    debugPrint('📊 Extracted ${data.length} fields from MRZ');
    data.forEach((key, value) => debugPrint('  ✓ $key: $value'));

    return data;
  }

  /// Manual passport MRZ parsing (fallback)
  static Map<String, dynamic>? _manualPassportParse(
      String line1, String line2) {
    try {
      final data = <String, dynamic>{
        'documentType': 'Passport',
        'source': 'MRZ (Manual)',
      };

      // Line 1: P<COUNTRY<<SURNAME<<GIVENNAMES or PBCOUNTRY<<SURNAME<<GIVENNAMES
      final namePattern = RegExp(r'P[A-Z<]{0,4}([A-Z]+)<<([A-Z<]+)');
      final nameMatch = namePattern.firstMatch(line1);
      if (nameMatch != null) {
        data['lastName'] = nameMatch.group(1)!.replaceAll('<', ' ').trim();
        data['firstName'] = nameMatch.group(2)!.replaceAll('<', ' ').trim();
      }

      // Line 2: DOCNUM<COUNTRY<DOB<SEX<EXPIRY
      if (line2.length >= 44) {
        // Document number (positions 0-8)
        final docNum = line2.substring(0, 9).replaceAll('<', '');
        if (docNum.isNotEmpty) data['documentNumber'] = docNum;

        // Nationality (positions 10-12)
        final nationality = line2.substring(10, 13).replaceAll('<', '');
        if (nationality.isNotEmpty) {
          data['nationalityCode'] = nationality;
          data['nationality'] = _getCountryName(nationality);
        }

        // Date of birth (positions 13-18)
        final dob = line2.substring(13, 19);
        if (RegExp(r'^\d{6}$').hasMatch(dob)) {
          data['dateOfBirth'] = _formatMRZDate(dob);
        }

        // Sex (position 20)
        final sex = line2.substring(20, 21);
        if (sex == 'M' || sex == 'F') {
          data['sex'] = sex;
          data['gender'] = sex == 'M' ? 'Male' : 'Female';
        }

        // Expiry date (positions 21-26)
        final expiry = line2.substring(21, 27);
        if (RegExp(r'^\d{6}$').hasMatch(expiry)) {
          data['expiryDate'] = _formatMRZDate(expiry);
        }
      }

      return data.length > 3 ? data : null;
    } catch (e) {
      debugPrint('❌ Manual passport parse error: $e');
      return null;
    }
  }

  /// Manual ID card MRZ parsing (fallback)
  static Map<String, dynamic>? _manualIDCardParse(
      String line1, String line2, String line3) {
    try {
      final data = <String, dynamic>{
        'documentType': 'ID Card',
        'source': 'MRZ (Manual)',
      };

      // Line 1: I<COUNTRY<DOCNUM
      if (line1.length >= 30) {
        final country = line1.substring(2, 5).replaceAll('<', '');
        if (country.isNotEmpty) {
          data['nationalityCode'] = country;
          data['nationality'] = _getCountryName(country);
        }

        final docNum = line1.substring(5, 14).replaceAll('<', '');
        if (docNum.isNotEmpty) data['documentNumber'] = docNum;
      }

      // Line 2: DOB<SEX<EXPIRY
      if (line2.length >= 30) {
        final dob = line2.substring(0, 6);
        if (RegExp(r'^\d{6}$').hasMatch(dob)) {
          data['dateOfBirth'] = _formatMRZDate(dob);
        }

        final sex = line2.substring(7, 8);
        if (sex == 'M' || sex == 'F') {
          data['sex'] = sex;
          data['gender'] = sex == 'M' ? 'Male' : 'Female';
        }

        final expiry = line2.substring(8, 14);
        if (RegExp(r'^\d{6}$').hasMatch(expiry)) {
          data['expiryDate'] = _formatMRZDate(expiry);
        }
      }

      // Line 3: SURNAME<<GIVENNAMES
      final namePattern = RegExp(r'([A-Z<]+?)<<([A-Z<]+)');
      final nameMatch = namePattern.firstMatch(line3);
      if (nameMatch != null) {
        data['lastName'] = nameMatch.group(1)!.replaceAll('<', ' ').trim();
        data['firstName'] = nameMatch.group(2)!.replaceAll('<', ' ').trim();
      }

      return data.length > 3 ? data : null;
    } catch (e) {
      debugPrint('❌ Manual ID card parse error: $e');
      return null;
    }
  }

  /// Format MRZ date (YYMMDD) to readable format (DD/MM/YYYY)
  static String _formatMRZDate(String mrzDate) {
    if (mrzDate.length != 6) return mrzDate;
    try {
      final yy = int.parse(mrzDate.substring(0, 2));
      final mm = mrzDate.substring(2, 4);
      final dd = mrzDate.substring(4, 6);
      // Assume 00-30 = 2000s, 31-99 = 1900s
      final yyyy = yy <= 30 ? 2000 + yy : 1900 + yy;
      return '$dd/$mm/$yyyy';
    } catch (e) {
      return mrzDate;
    }
  }

  /// Format DateTime to DD/MM/YYYY
  static String _formatDate(DateTime date) {
    return '${date.day.toString().padLeft(2, '0')}/${date.month.toString().padLeft(2, '0')}/${date.year}';
  }

  /// Get country full name from ISO code
  static String _getCountryName(String code) {
    final countries = {
      'LKA': 'Sri Lanka',
      'IND': 'India',
      'USA': 'United States',
      'GBR': 'United Kingdom',
      'AUS': 'Australia',
      'CAN': 'Canada',
      'CHN': 'China',
      'JPN': 'Japan',
      'SGP': 'Singapore',
      'THA': 'Thailand',
      'MYS': 'Malaysia',
      'IDN': 'Indonesia',
      'PAK': 'Pakistan',
      'BGD': 'Bangladesh',
      'NPL': 'Nepal',
      'MDV': 'Maldives',
      'ARE': 'UAE',
      'SAU': 'Saudi Arabia',
      'QAT': 'Qatar',
      'KWT': 'Kuwait',
    };
    return countries[code] ?? code;
  }
}
