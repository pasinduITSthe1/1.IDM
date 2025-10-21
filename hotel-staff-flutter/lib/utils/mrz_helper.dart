import 'package:flutter/foundation.dart';
import 'package:mrz_parser/mrz_parser.dart';
import 'dart:math';

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

  /// Clean OCR text for MRZ processing (ENHANCED)
  static String _cleanMRZLine(String line) {
    String cleaned = line
        .trim()
        .toUpperCase()
        // Fix common OCR character errors - COMPREHENSIVE
        .replaceAll('«', '<')
        .replaceAll('»', '<')
        .replaceAll('‹', '<')
        .replaceAll('›', '<')
        .replaceAll('〈', '<')
        .replaceAll('〉', '<')
        .replaceAll('《', '<')
        .replaceAll('》', '<')
        .replaceAll('＜', '<')
        .replaceAll('﹤', '<')
        .replaceAll('⟨', '<')
        .replaceAll('⟩', '<')
        // Fix letter/number confusions
        .replaceAll(RegExp(r'[ΟοО]'), '0') // Greek O, Cyrillic O -> 0
        .replaceAll(RegExp(r'[Qq]'), '0') // Q -> 0
        .replaceAll(RegExp(r'[Ss\$]'), '5') // S/$ -> 5 in doc numbers
        .replaceAll(RegExp(r'[Zz]'), '2') // Z -> 2 in numbers
        .replaceAll(RegExp(r'[lI\|!1іІ]'), '1') // l/I/|/!/і -> 1
        .replaceAll(RegExp(r'[Bb]'), '8') // B -> 8 in numbers
        .replaceAll(RegExp(r'[Gg]'), '6') // G -> 6 in numbers
        .replaceAll(RegExp(r'[Tt]'), '7') // T -> 7 in numbers
        // Fix common spacing issues
        .replaceAll(RegExp(r'\s+'), '');

    // Smart correction: restore letters in name sections (before first digit)
    if (cleaned.contains(RegExp(r'\d'))) {
      final firstDigitIndex = cleaned.indexOf(RegExp(r'\d'));
      final nameSection = line
          .substring(0, min(firstDigitIndex, line.length))
          .toUpperCase()
          .replaceAll('«', '<')
          .replaceAll('»', '<')
          .replaceAll(RegExp(r'[^A-Z<]'), '');
      final numberSection = cleaned.substring(firstDigitIndex);
      cleaned = nameSection + numberSection;
    }

    // Keep only MRZ valid characters: A-Z, 0-9, <
    return cleaned.replaceAll(RegExp(r'[^A-Z0-9<]'), '');
  }

  /// Check if line looks like MRZ (ENHANCED DETECTION)
  static bool _isMRZLine(String line) {
    // MRZ lines are 28-44 characters (allow ±2 for OCR errors)
    if (line.length < 23 || line.length > 47) return false;

    // Must contain MRZ markers or start with document type
    final hasMRZMarker = line.contains('<') || line.contains('<<');
    final startsWithDocType = line.startsWith(RegExp(r'^[PIAC][A-Z<]'));
    final hasMultipleChevrons = line.split('<').length > 2;

    if (!hasMRZMarker && !startsWithDocType && !hasMultipleChevrons) {
      return false;
    }

    // Must be mostly uppercase letters and numbers
    final validChars = line.replaceAll(RegExp(r'[A-Z0-9<]'), '').length;
    final validPercentage = (line.length - validChars) / line.length;

    // At least 80% must be valid MRZ characters
    return validPercentage >= 0.8;
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
    // Try standard 3-line ID card format
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

      debugPrint('🎯 Trying ID card MRZ (3 lines):');
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

    // Try 2-line incomplete ID card format (missing first line)
    debugPrint('🔄 Trying 2-line incomplete ID card format...');
    for (int i = 0; i < lines.length - 1; i++) {
      final line1 = _padMRZLine(lines[i], 30);
      final line2 = _padMRZLine(lines[i + 1], 30);

      // Check if it looks like ID card MRZ (lines 2 and 3 of TD-1)
      if (line1.length != 30 || line2.length != 30) continue;

      // Enhanced detection patterns for 2-line ID card MRZ
      // Line1 patterns: YYMMDDMSYYMMDDCCC or similar
      // Line2 patterns: SURNAME<<GIVENNAMES

      // Pattern 1: DOB + SEX + EXPIRY + COUNTRY (most common)
      final datePattern1 = RegExp(r'^\d{6}[MF]\d{6}[A-Z]{3}');
      // Pattern 2: Numbers + SEX + Numbers + COUNTRY
      final datePattern2 = RegExp(r'^\d+[MF]\d+[A-Z]{3}');
      // Pattern 3: Any format with M/F and country code
      final datePattern3 = RegExp(r'.*[MF].*[A-Z]{3}');

      final namePattern = RegExp(r'^[A-Z]+<<[A-Z<]+');

      final hasDateInfo = datePattern1.hasMatch(line1) ||
          datePattern2.hasMatch(line1) ||
          datePattern3.hasMatch(line1);

      if (hasDateInfo && namePattern.hasMatch(line2)) {
        debugPrint('🎯 Found 2-line ID card MRZ:');
        debugPrint('  L1 (dates): $line1');
        debugPrint('  L2 (names): $line2');

        final manual = _manual2LineIDCardParse(line1, line2);
        if (manual != null && manual.isNotEmpty) {
          return manual;
        }
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
  static Map<String, dynamic> _convertToMap(MRZResult result, String docType) {
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

  /// Manual 2-line ID card MRZ parsing (when first line is missing)
  /// Line1: DOB + Sex + Expiry (YYMMDDMYYMMDD + country/personal)
  /// Line2: SURNAME<<GIVENNAMES
  static Map<String, dynamic>? _manual2LineIDCardParse(
      String line1, String line2) {
    try {
      final data = <String, dynamic>{
        'documentType': 'ID Card',
        'source': 'MRZ (2-Line Manual)',
      };

      // Line 1: Parse date information
      // Format examples:
      // 8908098M2311045LKA<<<<<<<<<<<2 (your format)
      // YYMMDDMYYMMDDLKA<<<<<<<<<<<2 (standard)

      if (line1.length >= 16) {
        // Try to find date patterns in the line
        // Look for YYMMDD + M/F + YYMMDD pattern
        final fullPattern = RegExp(r'(\d{6})([MF])(\d{6})([A-Z]{3})');
        final match = fullPattern.firstMatch(line1);

        if (match != null) {
          // Standard format found
          final dob = match.group(1)!;
          final sex = match.group(2)!;
          final expiry = match.group(3)!;
          final country = match.group(4)!;

          if (RegExp(r'^\d{6}$').hasMatch(dob)) {
            data['dateOfBirth'] = _formatMRZDate(dob);
          }

          data['sex'] = sex;
          data['gender'] = sex == 'M' ? 'Male' : 'Female';

          if (RegExp(r'^\d{6}$').hasMatch(expiry)) {
            data['expiryDate'] = _formatMRZDate(expiry);
          }

          data['nationalityCode'] = country;
          data['nationality'] = _getCountryName(country);
        } else {
          // Try alternative parsing for non-standard formats
          // Look for M/F position and extract around it
          final sexPos = line1.indexOf(RegExp(r'[MF]'));
          if (sexPos > 5 && sexPos < line1.length - 9) {
            // Extract DOB (6 digits before M/F)
            final dobStart = sexPos - 6;
            final dob = line1.substring(dobStart, sexPos);
            if (RegExp(r'^\d{6}$').hasMatch(dob)) {
              data['dateOfBirth'] = _formatMRZDate(dob);
            }

            // Extract sex
            final sex = line1.substring(sexPos, sexPos + 1);
            data['sex'] = sex;
            data['gender'] = sex == 'M' ? 'Male' : 'Female';

            // Extract expiry (6 digits after M/F)
            final expiryStart = sexPos + 1;
            if (expiryStart + 6 <= line1.length) {
              final expiry = line1.substring(expiryStart, expiryStart + 6);
              if (RegExp(r'^\d{6}$').hasMatch(expiry)) {
                data['expiryDate'] = _formatMRZDate(expiry);
              }
            }

            // Extract country code (look for 3 consecutive letters)
            final countryMatch = RegExp(r'[A-Z]{3}').firstMatch(line1);
            if (countryMatch != null) {
              final country = countryMatch.group(0)!;
              data['nationalityCode'] = country;
              data['nationality'] = _getCountryName(country);
            }
          }
        }
      }

      // Line 2: Parse names
      // Format: ALEXANDER<<JEREMY<DAN1EL<<<<<<
      // Handle OCR errors: 1 → I, 0 → O
      final cleanedLine2 = line2
          .replaceAll('1', 'I') // Fix OCR error: 1 → I
          .replaceAll('0', 'O'); // Fix OCR error: 0 → O

      final namePattern = RegExp(r'^([A-Z<]+?)<<([A-Z<]+)');
      final nameMatch = namePattern.firstMatch(cleanedLine2);
      if (nameMatch != null) {
        data['lastName'] = nameMatch.group(1)!.replaceAll('<', ' ').trim();
        data['firstName'] = nameMatch.group(2)!.replaceAll('<', ' ').trim();
      } else {
        // Try alternative name parsing
        final parts = cleanedLine2.split('<<');
        if (parts.length >= 2) {
          data['lastName'] = parts[0].replaceAll('<', ' ').trim();
          data['firstName'] = parts[1].replaceAll('<', ' ').trim();
        }
      }

      debugPrint('✅ 2-Line ID Card Data Extracted:');
      data.forEach((key, value) {
        debugPrint('  $key: $value');
      });

      return data.length > 3 ? data : null;
    } catch (e) {
      debugPrint('❌ Manual 2-line ID card parse error: $e');
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
