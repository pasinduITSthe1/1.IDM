/// Smart Document Text Extractor
///
/// This class provides intelligent text extraction from documents
/// without relying on specific MRZ formats. It uses pattern recognition
/// to identify common document fields like names, dates, numbers, etc.
class SmartDocumentExtractor {
  /// Extract document data from OCR text using intelligent pattern recognition
  static Map<String, dynamic> extractDocumentData(String ocrText) {
    try {
      print('🤖 Smart Document Extraction Started');
      print('📄 Processing text of ${ocrText.length} characters');

      final extractedData = <String, dynamic>{};

      // Clean and prepare text
      final cleanText = _cleanOCRText(ocrText);
      final lines = cleanText
          .split('\n')
          .where((line) => line.trim().isNotEmpty)
          .toList();

      print('📋 Found ${lines.length} text lines');
      for (int i = 0; i < lines.length; i++) {
        print('  Line $i: "${lines[i]}"');
      }

      // Extract all possible information
      extractedData.addAll(_extractNames(lines));
      extractedData.addAll(_extractDates(lines));
      extractedData.addAll(_extractDocumentNumbers(lines));
      extractedData.addAll(_extractNationality(lines));
      extractedData.addAll(_extractSex(lines));
      extractedData.addAll(_extractCountries(lines));
      extractedData.addAll(_extractOtherInfo(lines));

      // Add metadata
      extractedData['documentType'] = _detectDocumentType(lines);
      extractedData['source'] = 'Smart OCR';
      extractedData['extractionTimestamp'] = DateTime.now().toIso8601String();

      print(
          '✅ Smart Extraction Complete: ${extractedData.length} fields found');
      extractedData.forEach((key, value) {
        print('  🔸 $key: $value');
      });

      return extractedData;
    } catch (e) {
      print('❌ Smart extraction error: $e');
      return {};
    }
  }

  /// Clean OCR text for better processing
  static String _cleanOCRText(String text) {
    return text
        .replaceAll(RegExp(r'[^\w\s<>/\-.]'),
            ' ') // Keep only letters, numbers, spaces, and basic punctuation
        .replaceAll(RegExp(r'\s+'), ' ') // Multiple spaces to single space
        .trim()
        .toUpperCase();
  }

  /// Extract names using various patterns
  static Map<String, dynamic> _extractNames(List<String> lines) {
    final names = <String, dynamic>{};

    // Common name patterns
    final namePatterns = [
      RegExp(r'^([A-Z]+)\s*<<\s*([A-Z<\s]+)'), // MRZ-style: SURNAME<<GIVENNAMES
      RegExp(r'NAME[:\s]*([A-Z\s]+)'), // "NAME: JOHN DOE"
      RegExp(r'([A-Z]{2,})\s+([A-Z]{2,}(?:\s+[A-Z]{2,})*)'), // "JOHN DOE SMITH"
      RegExp(r'^([A-Z]+)\s*,\s*([A-Z\s]+)'), // "SMITH, JOHN DOE"
    ];

    for (final line in lines) {
      for (final pattern in namePatterns) {
        final match = pattern.firstMatch(line);
        if (match != null) {
          if (pattern.pattern.contains('<<')) {
            // MRZ style
            names['lastName'] = match.group(1)!.replaceAll('<', ' ').trim();
            names['firstName'] = match.group(2)!.replaceAll('<', ' ').trim();
          } else if (pattern.pattern.contains(',')) {
            // Last, First format
            names['lastName'] = match.group(1)!.trim();
            names['firstName'] = match.group(2)!.trim();
          } else if (pattern.pattern.contains('NAME')) {
            // Extract full name and try to split
            final fullName = match.group(1)!.trim();
            final nameParts = fullName.split(' ');
            if (nameParts.length >= 2) {
              names['firstName'] = nameParts.first;
              names['lastName'] = nameParts.skip(1).join(' ');
            }
          } else {
            // First Last format
            names['firstName'] = match.group(1)!.trim();
            names['lastName'] = match.group(2)!.trim();
          }

          print('👤 Names found: ${names['firstName']} ${names['lastName']}');
          break;
        }
      }
      if (names.isNotEmpty) break;
    }

    return names;
  }

  /// Extract dates (birth, expiry, issue)
  static Map<String, dynamic> _extractDates(List<String> lines) {
    final dates = <String, dynamic>{};

    // Date patterns
    final datePatterns = [
      RegExp(r'(\d{2})(\d{2})(\d{2})'), // YYMMDD
      RegExp(r'(\d{4})[/-](\d{2})[/-](\d{2})'), // YYYY-MM-DD or YYYY/MM/DD
      RegExp(r'(\d{2})[/-](\d{2})[/-](\d{4})'), // DD-MM-YYYY or DD/MM/YYYY
      RegExp(r'(\d{2})[/-](\d{2})[/-](\d{2})'), // DD-MM-YY or DD/MM/YY
    ];

    // Look for date contexts
    final dobPatterns = [
      RegExp(r'DOB[:\s]*(\d{2}[/-]\d{2}[/-]\d{2,4})'),
      RegExp(r'BIRTH[:\s]*(\d{2}[/-]\d{2}[/-]\d{2,4})'),
      RegExp(r'BORN[:\s]*(\d{2}[/-]\d{2}[/-]\d{2,4})'),
    ];

    final expiryPatterns = [
      RegExp(r'EXP[:\s]*(\d{2}[/-]\d{2}[/-]\d{2,4})'),
      RegExp(r'EXPIRY[:\s]*(\d{2}[/-]\d{2}[/-]\d{2,4})'),
      RegExp(r'EXPIRES[:\s]*(\d{2}[/-]\d{2}[/-]\d{2,4})'),
    ];

    // Extract specific dates
    for (final line in lines) {
      // Date of birth
      for (final pattern in dobPatterns) {
        final match = pattern.firstMatch(line);
        if (match != null) {
          dates['dateOfBirth'] = _formatDate(match.group(1)!);
          print('🎂 Birth date found: ${dates['dateOfBirth']}');
        }
      }

      // Expiry date
      for (final pattern in expiryPatterns) {
        final match = pattern.firstMatch(line);
        if (match != null) {
          dates['expiryDate'] = _formatDate(match.group(1)!);
          print('📅 Expiry date found: ${dates['expiryDate']}');
        }
      }

      // General date extraction from number patterns
      if (dates.isEmpty) {
        for (final pattern in datePatterns) {
          final matches = pattern.allMatches(line);
          for (final match in matches) {
            final dateStr = match.group(0)!;
            if (_isValidDate(dateStr)) {
              if (!dates.containsKey('dateOfBirth')) {
                dates['dateOfBirth'] = _formatDate(dateStr);
                print('📆 Potential birth date: ${dates['dateOfBirth']}');
              } else if (!dates.containsKey('expiryDate')) {
                dates['expiryDate'] = _formatDate(dateStr);
                print('📆 Potential expiry date: ${dates['expiryDate']}');
              }
            }
          }
        }
      }
    }

    return dates;
  }

  /// Extract document numbers
  static Map<String, dynamic> _extractDocumentNumbers(List<String> lines) {
    final numbers = <String, dynamic>{};

    // Document number patterns
    final docPatterns = [
      RegExp(r'(?:DOC|DOCUMENT|PASSPORT|ID)[\s:]*([A-Z0-9]{6,})'),
      RegExp(r'^[A-Z]{1,2}\d{6,}'), // Common format: A1234567
      RegExp(r'^\d{8,}'), // Pure number documents
      RegExp(r'^[A-Z0-9]{8,}'), // Alphanumeric documents
    ];

    for (final line in lines) {
      for (final pattern in docPatterns) {
        final match = pattern.firstMatch(line);
        if (match != null) {
          final docNum = match.group(1) ?? match.group(0)!;
          if (docNum.length >= 6) {
            numbers['documentNumber'] = docNum;
            print('🆔 Document number found: $docNum');
            break;
          }
        }
      }
      if (numbers.isNotEmpty) break;
    }

    return numbers;
  }

  /// Extract nationality/country information
  static Map<String, dynamic> _extractNationality(List<String> lines) {
    final nationality = <String, dynamic>{};

    // Country codes and names
    final countries = {
      'LKA': 'Sri Lanka',
      'SRI': 'Sri Lanka',
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
      'BGD': 'Bangladesh'
    };

    for (final line in lines) {
      // Look for 3-letter country codes
      final codeMatch = RegExp(r'\b([A-Z]{3})\b').firstMatch(line);
      if (codeMatch != null) {
        final code = codeMatch.group(1)!;
        if (countries.containsKey(code)) {
          nationality['nationalityCode'] = code;
          nationality['nationality'] = countries[code];
          print('🌍 Nationality found: ${countries[code]} ($code)');
          break;
        }
      }

      // Look for full country names
      for (final country in countries.values) {
        if (line.contains(country.toUpperCase())) {
          nationality['nationality'] = country;
          print('🌍 Nationality found: $country');
          break;
        }
      }
    }

    return nationality;
  }

  /// Extract sex/gender information
  static Map<String, dynamic> _extractSex(List<String> lines) {
    final sex = <String, dynamic>{};

    for (final line in lines) {
      // Look for M/F in context
      final sexMatch = RegExp(r'\b([MF])\b').firstMatch(line);
      if (sexMatch != null) {
        final gender = sexMatch.group(1)!;
        sex['sex'] = gender;
        sex['gender'] = gender == 'M' ? 'Male' : 'Female';
        print('👤 Sex found: ${sex['gender']} ($gender)');
        break;
      }
    }

    return sex;
  }

  /// Extract country-related information
  static Map<String, dynamic> _extractCountries(List<String> lines) {
    final countries = <String, dynamic>{};

    // This could extract issued country, etc.
    // For now, we'll use the nationality extraction

    return countries;
  }

  /// Extract other useful information
  static Map<String, dynamic> _extractOtherInfo(List<String> lines) {
    final otherInfo = <String, dynamic>{};

    // Look for any other patterns that might be useful
    for (final line in lines) {
      // Email addresses
      final emailMatch = RegExp(r'\b[\w\.-]+@[\w\.-]+\.\w+\b').firstMatch(line);
      if (emailMatch != null) {
        otherInfo['email'] = emailMatch.group(0);
      }

      // Phone numbers
      final phoneMatch =
          RegExp(r'\+?\d{1,3}[\s-]?\d{3,4}[\s-]?\d{3,4}[\s-]?\d{3,4}')
              .firstMatch(line);
      if (phoneMatch != null) {
        otherInfo['phone'] = phoneMatch.group(0);
      }
    }

    return otherInfo;
  }

  /// Detect document type from content
  static String _detectDocumentType(List<String> lines) {
    final allText = lines.join(' ').toUpperCase();

    if (allText.contains('PASSPORT')) return 'Passport';
    if (allText.contains('IDENTITY') || allText.contains('ID CARD'))
      return 'ID Card';
    if (allText.contains('DRIVER') || allText.contains('LICENSE'))
      return 'Driver License';
    if (allText.contains('VISA')) return 'Visa';

    return 'Unknown Document';
  }

  /// Format date string to consistent format
  static String _formatDate(String dateStr) {
    try {
      // Remove any separators
      final cleanDate = dateStr.replaceAll(RegExp(r'[/-]'), '');

      if (cleanDate.length == 6) {
        // YYMMDD format
        final yy = int.parse(cleanDate.substring(0, 2));
        final mm = cleanDate.substring(2, 4);
        final dd = cleanDate.substring(4, 6);
        final yyyy = yy <= 30 ? 2000 + yy : 1900 + yy;
        return '$dd/$mm/$yyyy';
      } else if (cleanDate.length == 8) {
        // YYYYMMDD or DDMMYYYY
        if (int.parse(cleanDate.substring(0, 4)) > 1900) {
          // YYYYMMDD
          final yyyy = cleanDate.substring(0, 4);
          final mm = cleanDate.substring(4, 6);
          final dd = cleanDate.substring(6, 8);
          return '$dd/$mm/$yyyy';
        } else {
          // DDMMYYYY
          final dd = cleanDate.substring(0, 2);
          final mm = cleanDate.substring(2, 4);
          final yyyy = cleanDate.substring(4, 8);
          return '$dd/$mm/$yyyy';
        }
      }

      return dateStr; // Return original if can't parse
    } catch (e) {
      return dateStr;
    }
  }

  /// Check if a date string represents a valid date
  static bool _isValidDate(String dateStr) {
    try {
      final cleanDate = dateStr.replaceAll(RegExp(r'[/-]'), '');
      if (cleanDate.length == 6) {
        final mm = int.parse(cleanDate.substring(2, 4));
        final dd = int.parse(cleanDate.substring(4, 6));
        return mm >= 1 && mm <= 12 && dd >= 1 && dd <= 31;
      }
      return true; // Assume other formats are valid for now
    } catch (e) {
      return false;
    }
  }
}
