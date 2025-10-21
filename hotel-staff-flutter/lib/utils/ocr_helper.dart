import 'package:flutter/foundation.dart';
import 'package:mrz_parser/mrz_parser.dart';

/// Enhanced OCR Helper with MRZ parsing support
class OCRHelper {
  /// Extract data using MRZ (Machine Readable Zone) detection
  static Map<String, dynamic>? extractMRZ(String text) {
    try {
      debugPrint('🔍 Starting MRZ extraction...');

      // Step 1: Try using mrz_parser library (most accurate)
      final mrzResult = _parseMRZWithLibrary(text);
      if (mrzResult != null && mrzResult.length >= 3) {
        debugPrint('✅ MRZ extracted using library: ${mrzResult.length} fields');
        return mrzResult;
      }

      // Step 2: Manual MRZ parsing
      final manualResult = _parseManualMRZ(text);
      if (manualResult != null && manualResult.length >= 3) {
        debugPrint('✅ MRZ extracted manually: ${manualResult.length} fields');
        return manualResult;
      }

      debugPrint('⚠️ MRZ extraction failed');
      return null;
    } catch (e) {
      debugPrint('❌ MRZ error: $e');
      return null;
    }
  }

  /// Parse MRZ using mrz_parser library
  static Map<String, dynamic>? _parseMRZWithLibrary(String text) {
    try {
      final lines = text
          .split('\n')
          .map((l) => l
              .trim()
              // Fix common OCR errors in MRZ
              .replaceAll('«', '<')
              .replaceAll('»', '<')
              .replaceAll('‹', '<')
              .replaceAll('›', '<')
              .replaceAll('〈', '<')
              .replaceAll('〉', '<')
              .replaceAll('《', '<')
              .replaceAll('》', '<')
              .replaceAll(RegExp(r'[O]'), '0') // O -> 0 in numbers
              .replaceAll(RegExp(r'[^A-Z0-9<]'), ''))
          .where((l) => l.length >= 25)
          .toList();

      debugPrint('📋 Found ${lines.length} potential MRZ lines');
      for (int i = 0; i < lines.length; i++) {
        debugPrint('  Line $i (${lines[i].length} chars): ${lines[i]}');
      }

      for (int i = 0; i < lines.length; i++) {
        // Try TD-3 (Passport: 2 lines x 44 chars)
        if (i + 1 < lines.length) {
          final l1 = _fixLineLength(lines[i], 44);
          final l2 = _fixLineLength(lines[i + 1], 44);

          // More lenient check - look for MRZ-like patterns
          if ((l1.startsWith('P<') || l1.contains('<<')) &&
              l1.length == 44 &&
              l2.length == 44) {
            try {
              debugPrint('🎯 Attempting TD-3 parse...');
              // MRZParser expects List<String?>
              final mrzLines = [l1, l2];
              final result = MRZParser.tryParse(mrzLines);
              if (result != null) {
                debugPrint('✅ TD-3 MRZ parsed successfully');
                return _convertMRZResult(result, 'passport');
              }
            } catch (e) {
              debugPrint('❌ TD-3 parse failed: $e');
            }
          }
        }

        // Try TD-1 (ID Card: 3 lines x 30 chars)
        if (i + 2 < lines.length) {
          final l1 = _fixLineLength(lines[i], 30);
          final l2 = _fixLineLength(lines[i + 1], 30);
          final l3 = _fixLineLength(lines[i + 2], 30);

          if ((l1.startsWith('I<') ||
                  l1.startsWith('A<') ||
                  l1.startsWith('C<')) &&
              l1.length == 30 &&
              l2.length == 30 &&
              l3.length == 30) {
            try {
              // MRZParser expects List<String?>
              final mrzLines = [l1, l2, l3];
              final result = MRZParser.tryParse(mrzLines);
              if (result != null) {
                return _convertMRZResult(result, 'id_card');
              }
            } catch (e) {
              debugPrint('TD-1 parse failed: $e');
            }
          }
        }
      }
      return null;
    } catch (e) {
      debugPrint('Library parsing error: $e');
      return null;
    }
  }

  /// Fix MRZ line length (pad or trim)
  static String _fixLineLength(String line, int length) {
    if (line.length == length) return line;
    if (line.length < length) return line.padRight(length, '<');
    return line.substring(0, length);
  }

  /// Convert MRZResult to Map
  static Map<String, dynamic> _convertMRZResult(
      MRZResult result, String docType) {
    final data = <String, dynamic>{'documentType': docType};

    if (result.givenNames.isNotEmpty) data['firstName'] = result.givenNames;
    if (result.surnames.isNotEmpty) data['lastName'] = result.surnames;
    if (result.documentNumber.isNotEmpty)
      data['documentNumber'] = result.documentNumber;
    if (result.nationalityCountryCode.isNotEmpty)
      data['nationality'] = result.nationalityCountryCode;

    // Convert Sex enum to string
    if (result.sex == Sex.male) {
      data['sex'] = 'M';
    } else if (result.sex == Sex.female) {
      data['sex'] = 'F';
    }

    if (result.countryCode.isNotEmpty)
      data['issuedCountry'] = result.countryCode;

    // birthDate and expiryDate are required (not nullable) in MRZResult
    data['dateOfBirth'] =
        '${result.birthDate.year}-${result.birthDate.month.toString().padLeft(2, '0')}-${result.birthDate.day.toString().padLeft(2, '0')}';

    data['expirationDate'] =
        '${result.expiryDate.year}-${result.expiryDate.month.toString().padLeft(2, '0')}-${result.expiryDate.day.toString().padLeft(2, '0')}';

    return data;
  }

  /// Manual MRZ parsing
  static Map<String, dynamic>? _parseManualMRZ(String text) {
    try {
      final lines = text
          .split('\n')
          .map((l) => l.trim().replaceAll(RegExp(r'[^A-Z0-9<]'), ''))
          .where((l) => l.length >= 25 && l.contains(RegExp(r'[P<I<A<C<]|<<')))
          .toList();

      if (lines.isEmpty) return null;

      final l1 = lines.length > 0 ? lines[0] : '';
      final l2 = lines.length > 1 ? lines[1] : '';
      final l3 = lines.length > 2 ? lines[2] : '';

      // Passport format
      if (l1.contains('P<') && l1.length >= 40 && l2.length >= 40) {
        return _parsePassport(l1, l2);
      }

      // ID Card format
      if ((l1.startsWith('I<') || l1.startsWith('A<') || l1.startsWith('C<')) &&
          l2.length >= 25 &&
          l3.length >= 25) {
        return _parseIDCard(l1, l2, l3);
      }

      return null;
    } catch (e) {
      debugPrint('Manual parse error: $e');
      return null;
    }
  }

  /// Parse passport MRZ
  static Map<String, dynamic> _parsePassport(String line1, String line2) {
    final data = <String, dynamic>{'documentType': 'passport'};

    try {
      // Line 1: P<COUNTRY<<SURNAME<<GIVENNAMES or PBCOUNTRY<<SURNAME<<GIVENNAMES
      // Try format: P<LKA<<SURNAME<<GIVENNAMES
      var nameMatch =
          RegExp(r'P<([A-Z]{3})([A-Z<]+?)<<([A-Z<]+)').firstMatch(line1);

      // Try alternate format: PBLKA<<SURNAME<<GIVENNAMES (Sri Lankan passport)
      if (nameMatch == null) {
        nameMatch =
            RegExp(r'P[A-Z]([A-Z]{3})([A-Z<]+?)<<([A-Z<]+)').firstMatch(line1);
      }

      // Try without country separator: PBLKASURNAME<<GIVENNAMES
      if (nameMatch == null) {
        nameMatch =
            RegExp(r'P[A-Z]{1,3}([A-Z]+?)<<([A-Z<]+)').firstMatch(line1);
        if (nameMatch != null) {
          data['lastName'] = nameMatch.group(1)!.replaceAll('<', ' ').trim();
          data['firstName'] = nameMatch.group(2)!.replaceAll('<', ' ').trim();
        }
      } else {
        if (nameMatch.groupCount >= 3) {
          data['issuedCountry'] = nameMatch.group(1);
          data['lastName'] = nameMatch.group(2)!.replaceAll('<', ' ').trim();
          data['firstName'] = nameMatch.group(3)!.replaceAll('<', ' ').trim();
        }
      }

      // Line 2: DOCNUM<COUNTRY<DOB<SEX<EXPIRY
      if (line2.length >= 44) {
        data['documentNumber'] =
            line2.substring(0, 9).replaceAll('<', '').trim();
        data['nationality'] =
            line2.substring(10, 13).replaceAll('<', '').trim();

        final dob = line2.substring(13, 19);
        if (RegExp(r'^\d{6}$').hasMatch(dob)) {
          data['dateOfBirth'] = _formatDate(dob);
        }

        final sex = line2.substring(20, 21);
        if (sex == 'M' || sex == 'F') data['sex'] = sex;

        final exp = line2.substring(21, 27);
        if (RegExp(r'^\d{6}$').hasMatch(exp)) {
          data['expirationDate'] = _formatDate(exp);
        }
      }
    } catch (e) {
      debugPrint('Passport parse error: $e');
    }

    return data;
  }

  /// Parse ID card MRZ
  static Map<String, dynamic> _parseIDCard(
      String line1, String line2, String line3) {
    final data = <String, dynamic>{'documentType': 'id_card'};

    try {
      // Line 1: I<COUNTRY<DOCNUM
      if (line1.length >= 30) {
        data['issuedCountry'] =
            line1.substring(2, 5).replaceAll('<', '').trim();
        data['nationality'] = data['issuedCountry'];
        data['documentNumber'] =
            line1.substring(5, 14).replaceAll('<', '').trim();
      }

      // Line 2: DOB<SEX<EXPIRY
      if (line2.length >= 30) {
        final dob = line2.substring(0, 6);
        if (RegExp(r'^\d{6}$').hasMatch(dob)) {
          data['dateOfBirth'] = _formatDate(dob);
        }

        if (line2.length >= 8) {
          final sex = line2.substring(7, 8);
          if (sex == 'M' || sex == 'F') data['sex'] = sex;
        }

        if (line2.length >= 14) {
          final exp = line2.substring(8, 14);
          if (RegExp(r'^\d{6}$').hasMatch(exp)) {
            data['expirationDate'] = _formatDate(exp);
          }
        }
      }

      // Line 3: SURNAME<<GIVENNAMES
      final nameMatch = RegExp(r'([A-Z<]+?)<<([A-Z<]+)').firstMatch(line3);
      if (nameMatch != null) {
        data['lastName'] = nameMatch.group(1)!.replaceAll('<', ' ').trim();
        data['firstName'] = nameMatch.group(2)!.replaceAll('<', ' ').trim();
      }
    } catch (e) {
      debugPrint('ID card parse error: $e');
    }

    return data;
  }

  /// Format MRZ date (YYMMDD to YYYY-MM-DD)
  static String _formatDate(String date) {
    if (date.length != 6) return date;
    try {
      final yy = int.parse(date.substring(0, 2));
      final mm = date.substring(2, 4);
      final dd = date.substring(4, 6);
      final yyyy = yy > 30 ? 1900 + yy : 2000 + yy;
      return '$yyyy-$mm-$dd';
    } catch (e) {
      return date;
    }
  }

  /// Extract data using OCR pattern matching
  static Map<String, dynamic>? extractDataFromOCR(String text) {
    debugPrint('🔍 Starting OCR pattern extraction...');
    final data = <String, dynamic>{};

    final cleanText = text.replaceAll(RegExp(r'[ \t]+'), ' ').trim();

    // Enhanced patterns for Sri Lankan ID and passports
    final patterns = {
      'documentNumber': [
        // Sri Lankan NIC format: XXX-XXXX-XXXXXXX-X
        RegExp(r'\b(\d{3}[\-\s]?\d{4}[\-\s]?\d{7}[\-\s]?\d)\b'),
        // Passport format with letters and numbers
        RegExp(r'\b([A-Z]{1,2}\d{7,10})\b'),
        // General document number (8-15 digits)
        RegExp(r'\b(\d{8,15})\b'),
        // With label
        RegExp(
            r'(?:ID|Doc|Number|No\.?|Passport|NIC|D\s*Number)[:\s]+([\dA-Z\-/]{5,20})',
            caseSensitive: false),
      ],
      'firstName': [
        // Name patterns
        RegExp(r'(?:Name|First\s*Name|Given)[:\s]+([A-Z][A-Za-z\s]{2,40})',
            caseSensitive: false),
        // After "Narme:" (common OCR error)
        RegExp(r'Narme[:\s]+([A-Z][A-Za-z\s]{2,40})', caseSensitive: false),
      ],
      'lastName': [
        RegExp(r'(?:Last\s*Name|Surname|Family)[:\s]+([A-Z][A-Za-z\s]{2,40})',
            caseSensitive: false),
      ],
      'dateOfBirth': [
        // DD/MM/YYYY or DD-MM-YYYY
        RegExp(
            r'(?:DOB|Birth|Date\s*of\s*Birth)[:\s]*(\d{1,2}[/\-]\d{1,2}[/\-]\d{2,4})',
            caseSensitive: false),
        // Standalone date
        RegExp(r'\b(\d{1,2}[/\-]\d{1,2}[/\-]\d{4})\b'),
      ],
      'nationality': [
        // Sri Lanka variations
        RegExp(r'(?:Nationality|Country)[:\s]+(Sri\s*Lanka|SriLanka|LKA)',
            caseSensitive: false),
        RegExp(r'\b(Sri\s*Lanka|SriLanka)\b', caseSensitive: false),
      ],
      'issuingCountry': [
        RegExp(r'(?:Issuing|Issue)[:\s]+(Sri\s*Lanka|SriLanka|LKA)',
            caseSensitive: false),
      ],
      'sex': [
        // Gender/Sex field
        RegExp(r'(?:Sex|Gender)[:\s]+([MFmf])', caseSensitive: false),
        RegExp(r'\b(Male|Female|M|F)\b'),
      ],
      'expiryDate': [
        RegExp(
            r'(?:Expiry|Expiration|Valid\s*Until)[:\s]+(\d{1,2}[/\-]\d{1,2}[/\-]\d{2,4})',
            caseSensitive: false),
      ],
      'issueDate': [
        RegExp(
            r'(?:Issue|Issued|Issuing)[:\s]*(?:Date)?[:\s]*(\d{1,2}[/\-]\d{1,2}[/\-]\d{2,4})',
            caseSensitive: false),
      ],
    };

    // Process patterns
    for (final entry in patterns.entries) {
      final key = entry.key;
      for (final pattern in entry.value) {
        final match = pattern.firstMatch(cleanText);
        if (match != null && match.group(1) != null) {
          var value = match.group(1)!.trim();

          if (key == 'dateOfBirth') {
            value = _convertDateFormat(value);
            if (!RegExp(r'^\d{4}-\d{2}-\d{2}$').hasMatch(value)) continue;
          }

          if (key == 'sex') {
            value = value.toUpperCase();
            if (value == 'MALE') value = 'M';
            if (value == 'FEMALE') value = 'F';
            if (value != 'M' && value != 'F') continue;
          }

          if ((key == 'firstName' || key == 'lastName') && value.length < 2)
            continue;
          if (key == 'documentNumber' && value.length < 5) continue;

          data[key] = value;
          debugPrint('✅ Found $key: $value');
          break;
        }
      }
    }

    // Try to extract names from MRZ-like format if not found
    if (data['firstName'] == null || data['lastName'] == null) {
      final lines = text.split('\n');
      for (final line in lines) {
        // Look for MRZ name pattern: SURNAME<<GIVENNAMES or ALEXANDER<<JEREMY<DANIEL
        // Also handle PBLKASURNAME<<GIVENNAMES format
        var mrzNameMatch = RegExp(r'([A-Z]{4,})<<([A-Z<]+)').firstMatch(line);

        // Try removing P[A-Z]{1,3} prefix for passports
        if (mrzNameMatch == null) {
          mrzNameMatch =
              RegExp(r'P[A-Z]{1,4}([A-Z]+?)<<([A-Z<]+)').firstMatch(line);
        }

        if (mrzNameMatch != null) {
          if (data['lastName'] == null) {
            data['lastName'] =
                mrzNameMatch.group(1)!.replaceAll('<', ' ').trim();
            debugPrint('✅ Found lastName from MRZ: ${data['lastName']}');
          }
          if (data['firstName'] == null) {
            final givenNames =
                mrzNameMatch.group(2)!.replaceAll('<', ' ').trim();
            data['firstName'] = givenNames;
            debugPrint('✅ Found firstName from MRZ: ${data['firstName']}');
          }
          break;
        }

        // Look for "Name:" or "Surname:" or "Given Names:" followed by name
        final surnameMatch = RegExp(
                r'(?:Surname|SURNAME)[:\s/]+([A-Z][A-Za-z\s]{2,30})',
                caseSensitive: false)
            .firstMatch(line);
        if (surnameMatch != null && data['lastName'] == null) {
          data['lastName'] = surnameMatch.group(1)!.trim();
          debugPrint('✅ Found lastName from label: ${data['lastName']}');
        }

        final givenNameMatch = RegExp(
                r'(?:Given Names?|Other Names?|First Names?)[:\s/]+([A-Z][A-Za-z\s]{2,50})',
                caseSensitive: false)
            .firstMatch(line);
        if (givenNameMatch != null && data['firstName'] == null) {
          data['firstName'] = givenNameMatch.group(1)!.trim();
          debugPrint('✅ Found firstName from label: ${data['firstName']}');
        }

        // Look for "Name:" followed by full name (fallback)
        if (data['firstName'] == null && data['lastName'] == null) {
          final fullNameMatch = RegExp(
                  r'(?:Narme|Name)[:\s]+([A-Z][A-Za-z\s]{5,50})',
                  caseSensitive: false)
              .firstMatch(line);
          if (fullNameMatch != null) {
            final fullName = fullNameMatch.group(1)!.trim();
            final parts = fullName.split(RegExp(r'\s+'));
            if (parts.length >= 2) {
              data['firstName'] = parts.sublist(0, parts.length - 1).join(' ');
              data['lastName'] = parts.last;
              debugPrint(
                  '✅ Found full name: ${data['firstName']} ${data['lastName']}');
            }
          }
        }
      }
    }

    debugPrint('✅ OCR extraction: ${data.length} fields');
    return data.isNotEmpty ? data : null;
  }

  /// Convert date formats to YYYY-MM-DD
  static String _convertDateFormat(String dateStr) {
    if (dateStr.isEmpty) return '';

    final cleaned = dateStr.replaceAll(RegExp(r'[.\-\s]'), '/');

    final patterns = [
      RegExp(r'^(\d{1,2})/(\d{1,2})/(\d{4})$'),
      RegExp(r'^(\d{4})/(\d{1,2})/(\d{1,2})$'),
      RegExp(r'^(\d{1,2})/(\d{1,2})/(\d{2})$'),
    ];

    for (final pattern in patterns) {
      final match = pattern.firstMatch(cleaned);
      if (match != null) {
        var p1 = match.group(1)!;
        var p2 = match.group(2)!;
        var p3 = match.group(3)!;

        if (p3.length == 2) {
          final yy = int.parse(p3);
          p3 = yy > 30 ? '19$p3' : '20$p3';
        }

        if (pattern.pattern.contains(r'(\d{4})')) {
          return '$p1-${p2.padLeft(2, '0')}-${p3.padLeft(2, '0')}';
        } else if (int.tryParse(p1) != null && int.parse(p1) > 12) {
          return '$p3-${p2.padLeft(2, '0')}-${p1.padLeft(2, '0')}';
        } else {
          return '$p3-${p1.padLeft(2, '0')}-${p2.padLeft(2, '0')}';
        }
      }
    }

    return dateStr;
  }
}
