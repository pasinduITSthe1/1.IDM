import 'package:mrz_parser/mrz_parser.dart';

/// Production-Grade MRZ Scanner
///
/// Uses the best free Flutter libraries for maximum MRZ accuracy:
/// - google_mlkit_text_recognition (Google's ML Kit - FREE)
/// - mrz_parser (Dart MRZ parsing library - FREE)
///
/// Optimized for production use with enhanced preprocessing and validation
class ProductionMRZScanner {
  /// Extract MRZ data with production-grade accuracy
  static Future<Map<String, dynamic>?> extractMRZData(String ocrText) async {
    try {
      print('🔍 Production MRZ Extraction Started');
      print('📄 Processing ${ocrText.length} characters of OCR text');

      // Step 1: Clean and prepare OCR text for MRZ processing
      final cleanedText = _cleanOCRText(ocrText);
      final mrzLines = _extractMRZLines(cleanedText);

      print('📋 Extracted ${mrzLines.length} potential MRZ lines');
      for (int i = 0; i < mrzLines.length; i++) {
        print('  MRZ Line $i: "${mrzLines[i]}" (${mrzLines[i].length} chars)');
      }

      if (mrzLines.isEmpty) {
        print('❌ No MRZ lines found in OCR text');
        return null;
      }

      // Step 2: Try parsing different MRZ formats
      Map<String, dynamic>? result;

      // Try TD-3 (Passport) format first (2 lines x 44 chars)
      result = _tryTD3Format(mrzLines);
      if (result != null) {
        print('✅ TD-3 (Passport) MRZ parsed successfully');
        return result;
      }

      // Try TD-1 (ID Card) format (3 lines x 30 chars)
      result = _tryTD1Format(mrzLines);
      if (result != null) {
        print('✅ TD-1 (ID Card) MRZ parsed successfully');
        return result;
      }

      // Try TD-2 format (2 lines x 36 chars)
      result = _tryTD2Format(mrzLines);
      if (result != null) {
        print('✅ TD-2 MRZ parsed successfully');
        return result;
      }

      print('❌ No valid MRZ format detected');
      return null;
    } catch (e) {
      print('❌ Production MRZ extraction error: $e');
      return null;
    }
  }

  /// Clean OCR text specifically for MRZ processing
  static String _cleanOCRText(String text) {
    var cleaned = text
        .toUpperCase()
        // Fix common OCR errors in MRZ
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
        // Fix number/letter confusions using context-aware regex
        .replaceAll(RegExp(r'[ΟοО]'), '0') // Greek/Cyrillic O -> 0
        .replaceAll(RegExp(r'O(?=\d)'), '0') // O followed by digit → 0
        .replaceAll(RegExp(r'(?<=\d)O'), '0') // O after digit → 0
        .replaceAll(RegExp(r'I(?=\d)'), '1') // I followed by digit → 1
        .replaceAll(RegExp(r'(?<=\d)I'), '1') // I after digit → 1
        .replaceAll(RegExp(r'S(?=\d{2,})'), '5') // S in number context → 5
        .replaceAll(RegExp(r'Z(?=\d{2,})'), '2') // Z in number context → 2
        // Remove non-MRZ characters
        .replaceAll(RegExp(r'[^A-Z0-9<\s\n]'), '')
        .trim();

    // CRITICAL FIX: Remove spaces from lines that look like MRZ
    // ML Kit often adds spaces to MRZ lines
    final lines = cleaned.split('\n');
    final fixedLines = <String>[];

    for (var line in lines) {
      // If line has multiple < symbols and letters/numbers, it's likely MRZ
      if (line.contains('<') && line.length > 20) {
        // Remove ALL spaces from MRZ lines
        fixedLines.add(line.replaceAll(' ', ''));
      } else {
        fixedLines.add(line);
      }
    }

    return fixedLines.join('\n');
  }

  /// Extract potential MRZ lines from cleaned text
  static List<String> _extractMRZLines(String cleanedText) {
    print('🔍 Extracting MRZ lines from cleaned text...');
    print('📄 Cleaned text length: ${cleanedText.length}');

    final allLines =
        cleanedText.split('\n').map((line) => line.trim()).toList();
    print('📋 Total lines: ${allLines.length}');

    final mrzLines = <String>[];
    for (int i = 0; i < allLines.length; i++) {
      var line = allLines[i];
      if (line.isEmpty) continue;

      // CRITICAL: Remove ALL spaces before validation
      line = line.replaceAll(' ', '');

      final isMrz = _isMRZLine(line);
      print('  Line $i: "${line}" (${line.length} chars) - MRZ: $isMrz');

      if (isMrz) {
        // Apply MRZ-specific OCR corrections
        line = _fixMRZOCRErrors(line);
        mrzLines.add(line);
      }
    }

    print('✅ Found ${mrzLines.length} MRZ lines');
    return mrzLines;
  }

  /// Fix common OCR errors in MRZ lines
  /// In MRZ: Numbers at start of lines, dates, doc numbers are usually digits
  /// Names and country codes are usually letters
  static String _fixMRZOCRErrors(String line) {
    if (line.isEmpty) return line;

    var fixed = line;

    // Pattern 1: Fix document number patterns like "ILARE1188123"
    // If line starts with 1-2 letters followed by mix of I/1, assume I=1 in number portion
    if (RegExp(r'^[A-Z]{1,5}[I1]{2,}').hasMatch(fixed)) {
      // Example: "ILARE" + "II88I23" → "ILARE" + "1188123"
      final match = RegExp(r'^([A-Z]{1,5})([I10-9]+)').firstMatch(fixed);
      if (match != null) {
        final prefix = match.group(1)!;
        var numbers = match.group(2)!;
        // In this part, I should be 1
        numbers = numbers.replaceAll('I', '1').replaceAll('O', '0');
        fixed = prefix + numbers + fixed.substring(match.end);
        print('  🔧 Fixed doc number: $line → $fixed');
      }
    }

    // Pattern 2: Fix date patterns like "8908098" where I might be 1
    // Dates are usually 6 digits: YYMMDD or YYYYMMDD
    fixed = fixed.replaceAllMapped(RegExp(r'\d{2}[I01]{2}[I01]{2}[I01]'), (m) {
      final date = m.group(0)!.replaceAll('I', '1').replaceAll('O', '0');
      if (date != m.group(0)) {
        print('  🔧 Fixed date pattern: ${m.group(0)} → $date');
      }
      return date;
    });

    // Pattern 3: Long number sequences with I/O should be corrected
    // Example: "789784I98947370577" → "78978419894737 0577"
    fixed = fixed.replaceAllMapped(RegExp(r'\d+[IO]\d+'), (m) {
      final num = m.group(0)!.replaceAll('I', '1').replaceAll('O', '0');
      if (num != m.group(0)) {
        print('  🔧 Fixed number sequence: ${m.group(0)} → $num');
      }
      return num;
    });

    return fixed;
  }

  /// Check if a line looks like an MRZ line
  static bool _isMRZLine(String line) {
    // MRZ lines have specific characteristics:
    // - Minimum length of 20 characters (more lenient)
    // - Contain only A-Z, 0-9, and < characters
    // - Have a specific pattern of < characters
    if (line.length < 20) return false;

    // Check if line contains only valid MRZ characters
    if (!RegExp(r'^[A-Z0-9<]+$').hasMatch(line)) return false;

    // Allow some flexibility for OCR errors - check if mostly valid chars
    final validChars =
        line.split('').where((c) => RegExp(r'[A-Z0-9<]').hasMatch(c)).length;
    final validRatio = validChars / line.length;

    if (validRatio < 0.9) return false; // At least 90% valid MRZ characters

    // Must contain some < characters (MRZ padding) OR be all caps with numbers
    final hasFillers = line.contains('<');
    final hasLetters = RegExp(r'[A-Z]').hasMatch(line);
    final hasNumbers = RegExp(r'[0-9]').hasMatch(line);

    if (!hasFillers && !hasLetters && !hasNumbers) return false;

    // Should not be all < characters
    if (line.replaceAll('<', '').isEmpty) return false;

    return true;
  }

  /// Try parsing as TD-3 format (Passport: 2 lines x 44 chars)
  static Map<String, dynamic>? _tryTD3Format(List<String> lines) {
    print('🔍 Trying TD-3 (Passport) format...');

    for (int i = 0; i < lines.length - 1; i++) {
      final line1 = _normalizeMRZLine(lines[i], 44);
      final line2 = _normalizeMRZLine(lines[i + 1], 44);

      // TD-3 validation
      if (line1.length != 44 || line2.length != 44) continue;
      if (!line1.startsWith('P<')) continue; // Passport indicator

      print('🎯 Attempting TD-3 parse:');
      print('  Line 1: $line1');
      print('  Line 2: $line2');

      try {
        final result = MRZParser.tryParse([line1, line2]);
        if (result != null) {
          return _convertMRZResult(result, 'Passport');
        }
      } catch (e) {
        print('⚠️ TD-3 parse failed: $e');
      }
    }

    return null;
  }

  /// Try parsing as TD-1 format (ID Card: 3 lines x 30 chars)
  static Map<String, dynamic>? _tryTD1Format(List<String> lines) {
    print('🔍 Trying TD-1 (ID Card) format...');

    for (int i = 0; i < lines.length - 2; i++) {
      final line1 = _normalizeMRZLine(lines[i], 30);
      final line2 = _normalizeMRZLine(lines[i + 1], 30);
      final line3 = _normalizeMRZLine(lines[i + 2], 30);

      // TD-1 validation
      if (line1.length != 30 || line2.length != 30 || line3.length != 30)
        continue;
      if (!RegExp(r'^[ICA]').hasMatch(line1))
        continue; // ID/Card/Alien indicator

      print('🎯 Attempting TD-1 parse:');
      print('  Line 1: $line1');
      print('  Line 2: $line2');
      print('  Line 3: $line3');

      try {
        // Try official parser first
        final result = MRZParser.tryParse([line1, line2, line3]);
        if (result != null) {
          return _convertMRZResult(result, 'ID Card');
        }
      } catch (e) {
        print('⚠️ Official TD-1 parse failed: $e');
        print('🔧 Trying lenient manual TD-1 parser...');

        // Fallback: Manual lenient parsing for OCR errors
        final manualResult = _manualTD1Parse(line1, line2, line3);
        if (manualResult != null) {
          print('✅ Manual TD-1 parse successful!');
          return manualResult;
        }
      }
    }

    return null;
  }

  /// Manual lenient TD-1 parser for OCR-damaged MRZ
  /// TD-1 Format (ID Card):
  /// Line 1: IICCCDDDDDDDDDD<<<<<<<<<<<< (I=type, CCC=country, D=doc#)
  /// Line 2: YYMMDDDSMMMMMMM<<NNNNNNNNNN (birth date, sex, expiry, nationality, optional)
  /// Line 3: LASTNAME<<FIRSTNAME<<<<<<<< (names)
  static Map<String, dynamic>? _manualTD1Parse(
      String line1, String line2, String line3) {
    try {
      // Line 1: Document type (1) + Country code (3) + Document number (9) + check (1) + optional (15) + check (1)
      final docType = line1.substring(0, 1);
      final country = line1.substring(1, 4).replaceAll('<', '');
      var docNumber = line1.substring(4, 13).replaceAll('<', '');

      // Clean up document number from OCR errors
      docNumber = docNumber.replaceAll('I', '1').replaceAll('O', '0');

      // Line 2: Birth date (6) + check (1) + Sex (1) + Expiry (6) + check (1) + Nationality (3) + Optional (11) + check (1)
      var birthDate =
          line2.substring(0, 6).replaceAll('I', '1').replaceAll('O', '0');
      final sex = line2.substring(7, 8);
      var expiryDate =
          line2.substring(8, 14).replaceAll('I', '1').replaceAll('O', '0');
      final nationality = line2.substring(15, 18).replaceAll('<', '');

      // Line 3: Names
      final nameParts = line3.split('<<');
      final lastName =
          nameParts.isNotEmpty ? nameParts[0].replaceAll('<', ' ').trim() : '';
      final firstName =
          nameParts.length > 1 ? nameParts[1].replaceAll('<', ' ').trim() : '';

      // Format dates: YYMMDD to YYYY-MM-DD
      final formattedBirthDate = _formatMRZDate(birthDate);
      final formattedExpiryDate = _formatMRZDate(expiryDate);

      print('📝 Manual parse results:');
      print('  Type: $docType');
      print('  Country: $country');
      print('  Doc #: $docNumber');
      print('  Birth: $formattedBirthDate');
      print('  Sex: $sex');
      print('  Expiry: $formattedExpiryDate');
      print('  Nationality: $nationality');
      print('  Name: $firstName $lastName');

      // Validate minimum requirements
      if (docNumber.isEmpty || lastName.isEmpty) {
        print('❌ Manual parse: Missing critical data');
        return null;
      }

      return {
        'documentType': 'ID Card (TD-1)',
        'documentNumber': docNumber,
        'firstName': firstName,
        'lastName': lastName,
        'dateOfBirth': formattedBirthDate,
        'sex': sex,
        'expiryDate': formattedExpiryDate,
        'nationality': nationality,
        'issuingCountry': country,
        'parseMethod': 'Manual (OCR-tolerant)',
      };
    } catch (e) {
      print('❌ Manual TD-1 parse error: $e');
      return null;
    }
  }

  /// Format MRZ date string YYMMDD to YYYY-MM-DD
  static String _formatMRZDate(String yymmdd) {
    if (yymmdd.length != 6) return yymmdd;

    try {
      final yy = int.parse(yymmdd.substring(0, 2));
      final mm = yymmdd.substring(2, 4);
      final dd = yymmdd.substring(4, 6);

      // Assume 00-30 = 2000-2030, 31-99 = 1931-1999
      final yyyy = yy <= 30 ? 2000 + yy : 1900 + yy;

      return '$yyyy-$mm-$dd';
    } catch (e) {
      return yymmdd;
    }
  }

  /// Try parsing as TD-2 format (2 lines x 36 chars)
  static Map<String, dynamic>? _tryTD2Format(List<String> lines) {
    print('🔍 Trying TD-2 format...');

    for (int i = 0; i < lines.length - 1; i++) {
      final line1 = _padOrTruncate(lines[i], 36);
      final line2 = _padOrTruncate(lines[i + 1], 36);

      // TD-2 validation
      if (line1.length != 36 || line2.length != 36) continue;

      print('🎯 Attempting TD-2 parse:');
      print('  Line 1: $line1');
      print('  Line 2: $line2');

      try {
        final result = MRZParser.tryParse([line1, line2]);
        if (result != null) {
          print('✅ TD-2 parse successful!');
          return _convertMRZResult(result, 'TD-2 Document');
        }
      } catch (e) {
        print('⚠️ TD-2 parse failed: $e');
      }
    }

    return null;
  }

  /// Smart padding or truncating to exact MRZ line length
  static String _padOrTruncate(String line, int targetLength) {
    if (line.length == targetLength) {
      return line;
    } else if (line.length < targetLength) {
      // Pad with < filler characters
      return line + ('<' * (targetLength - line.length));
    } else {
      // Truncate if too long
      return line.substring(0, targetLength);
    }
  }

  /// Normalize MRZ line to exact length with proper padding (Legacy - use _padOrTruncate instead)
  static String _normalizeMRZLine(String line, int targetLength) {
    // Remove extra spaces and normalize
    String normalized = line.replaceAll(' ', '').toUpperCase();

    // Pad with < characters if too short
    if (normalized.length < targetLength) {
      normalized = normalized.padRight(targetLength, '<');
    }

    // Truncate if too long
    if (normalized.length > targetLength) {
      normalized = normalized.substring(0, targetLength);
    }

    return normalized;
  }

  /// Convert MRZResult to our standard format
  static Map<String, dynamic> _convertMRZResult(
      MRZResult result, String docType) {
    final data = <String, dynamic>{
      'documentType': docType,
      'source': 'Production MRZ',
      'extractionTimestamp': DateTime.now().toIso8601String(),
    };

    // Extract names
    if (result.givenNames.isNotEmpty) {
      data['firstName'] = result.givenNames.trim();
    }
    if (result.surnames.isNotEmpty) {
      data['lastName'] = result.surnames.trim();
    }

    // Extract document info
    if (result.documentNumber.isNotEmpty) {
      data['documentNumber'] = result.documentNumber.trim();
    }

    // Extract dates
    data['dateOfBirth'] = _formatDate(result.birthDate);
    data['expiryDate'] = _formatDate(result.expiryDate);

    // Extract other info
    final sexStr = result.sex == Sex.male
        ? 'M'
        : result.sex == Sex.female
            ? 'F'
            : '';
    if (sexStr.isNotEmpty) {
      data['sex'] = sexStr;
      data['gender'] = sexStr == 'M' ? 'Male' : 'Female';
    }

    if (result.nationalityCountryCode.isNotEmpty) {
      data['nationalityCode'] = result.nationalityCountryCode;
      data['nationality'] = _getCountryName(result.nationalityCountryCode);
    }

    if (result.countryCode.isNotEmpty) {
      data['issuedCountry'] = _getCountryName(result.countryCode);
      data['issuedCountryCode'] = result.countryCode;
    }

    // Add validation status
    data['isValid'] = _validateMRZData(data);

    print('✅ MRZ Data Extracted:');
    data.forEach((key, value) {
      print('  📋 $key: $value');
    });

    return data;
  }

  /// Format DateTime to DD/MM/YYYY
  static String _formatDate(DateTime date) {
    return '${date.day.toString().padLeft(2, '0')}/${date.month.toString().padLeft(2, '0')}/${date.year}';
  }

  /// Get country name from ISO code
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
      'AFG': 'Afghanistan',
      'DEU': 'Germany',
      'FRA': 'France',
      'ITA': 'Italy',
      'ESP': 'Spain',
      'NLD': 'Netherlands',
      'BEL': 'Belgium',
      'CHE': 'Switzerland',
      'AUT': 'Austria',
      'SWE': 'Sweden',
      'NOR': 'Norway',
      'DNK': 'Denmark',
      'FIN': 'Finland',
      'RUS': 'Russia',
      'UKR': 'Ukraine',
      'POL': 'Poland',
      'CZE': 'Czech Republic',
      'HUN': 'Hungary',
      'ROU': 'Romania',
      'BGR': 'Bulgaria',
      'HRV': 'Croatia',
      'SRB': 'Serbia',
      'BIH': 'Bosnia and Herzegovina',
      'MKD': 'North Macedonia',
      'ALB': 'Albania',
      'MNE': 'Montenegro',
      'SVN': 'Slovenia',
      'SVK': 'Slovakia',
    };

    return countries[code] ?? code;
  }

  /// Validate extracted MRZ data for production use
  static bool _validateMRZData(Map<String, dynamic> data) {
    // Check for required fields
    if (!data.containsKey('firstName') || data['firstName'].toString().isEmpty)
      return false;
    if (!data.containsKey('lastName') || data['lastName'].toString().isEmpty)
      return false;
    if (!data.containsKey('documentNumber') ||
        data['documentNumber'].toString().isEmpty) return false;

    // Validate date formats
    if (data.containsKey('dateOfBirth')) {
      if (!_isValidDateFormat(data['dateOfBirth'])) return false;
    }
    if (data.containsKey('expiryDate')) {
      if (!_isValidDateFormat(data['expiryDate'])) return false;
    }

    // Validate sex
    if (data.containsKey('sex')) {
      final sex = data['sex'].toString().toUpperCase();
      if (sex != 'M' && sex != 'F') return false;
    }

    return true;
  }

  /// Check if date is in valid format
  static bool _isValidDateFormat(dynamic date) {
    if (date == null) return false;
    final dateStr = date.toString();
    return RegExp(r'^\d{2}/\d{2}/\d{4}$').hasMatch(dateStr);
  }
}
