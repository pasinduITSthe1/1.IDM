import 'package:flutter/foundation.dart';

class OCRHelper {
  // Extract data using MRZ (Machine Readable Zone) detection
  static Map<String, dynamic>? extractMRZ(String text) {
    try {
      final lines = text
          .split('\n')
          .map((l) => l.trim())
          .where((l) => l.isNotEmpty)
          .toList();

      // Filter potential MRZ lines - more lenient for partial reads
      final mrzLines = lines.where((line) {
        final mrzOnly = line.replaceAll(RegExp(r'[^A-Z0-9<]'), '');
        // Reduced minimum length to 24 for better detection
        return mrzOnly.length >= 24 &&
            RegExp(r'[A-Z0-9<]{24,}').hasMatch(mrzOnly) &&
            (line.contains('<<') || line.contains('P<') || line.contains('I<') || line.contains('A<') || line.contains('C<'));
      }).toList();

      debugPrint('Potential MRZ Lines: $mrzLines');

      if (mrzLines.isNotEmpty) {
        // Try to parse MRZ data - more flexible approach
        final line1 = mrzLines[0].replaceAll(RegExp(r'[^A-Z0-9<]'), '');
        final line2 = mrzLines.length > 1 
            ? mrzLines[1].replaceAll(RegExp(r'[^A-Z0-9<]'), '')
            : '';
        final line3 = mrzLines.length > 2
            ? mrzLines[2].replaceAll(RegExp(r'[^A-Z0-9<]'), '')
            : '';

        final data = <String, dynamic>{};

        // Parse TD-1 (ID Card) or TD-3 (Passport) format
        if (line1.startsWith('P<') || line1.contains('P<')) {
          // Passport format (TD-3)
          data['documentType'] = 'Passport';

          // Extract name from line 1 - more flexible pattern
          final nameMatch = RegExp(r'P<[A-Z]{2,3}([A-Z<]+?)<<([A-Z<]+)').firstMatch(line1);
          if (nameMatch != null) {
            data['lastName'] = nameMatch.group(1)?.replaceAll('<', ' ').trim();
            data['firstName'] = nameMatch.group(2)?.replaceAll('<', ' ').trim();
          }

          // Extract data from line 2 - flexible length handling
          if (line2.length >= 30) {
            // Document number (first 9 chars)
            if (line2.length >= 9) {
              data['documentNumber'] = line2.substring(0, 9).replaceAll('<', '').trim();
            }
            
            // Nationality (chars 10-13)
            if (line2.length >= 13) {
              data['nationality'] = line2.substring(10, 13).trim();
            }
            
            // Date of birth (chars 13-19)
            if (line2.length >= 19) {
              data['dateOfBirth'] = _formatMRZDate(line2.substring(13, 19));
            }
            
            // Sex (char 20)
            if (line2.length >= 21) {
              data['sex'] = line2.substring(20, 21).trim();
            }
            
            // Expiration date (chars 21-27)
            if (line2.length >= 27) {
              data['expirationDate'] = _formatMRZDate(line2.substring(21, 27));
            }
          }
        } else if (line1.contains('I<') || line1.contains('A<') || line1.contains('C<') ||
                   line1.startsWith('I<') || line1.startsWith('A<') || line1.startsWith('C<')) {
          // ID Card format (TD-1)
          data['documentType'] = 'ID Card';

          // Extract nationality - more flexible
          final nationalityMatch = RegExp(r'[IAC]<([A-Z]{2,3})').firstMatch(line1);
          if (nationalityMatch != null) {
            data['nationality'] = nationalityMatch.group(1);
          }

          // Extract document number - flexible length
          final docNumMatch = RegExp(r'[IAC]<[A-Z]{2,3}([A-Z0-9<]{6,12})').firstMatch(line1);
          if (docNumMatch != null) {
            data['documentNumber'] = docNumMatch.group(1)?.replaceAll('<', '').trim();
          }

          // Extract DOB, sex, expiry from line 2 - flexible handling
          if (line2.length >= 20) {
            // DOB (first 6 chars)
            final dobStr = line2.substring(0, 6);
            if (RegExp(r'^\d{6}$').hasMatch(dobStr)) {
              data['dateOfBirth'] = _formatMRZDate(dobStr);
            }
            
            // Sex (char 7-8)
            if (line2.length >= 8) {
              final sexChar = line2.substring(7, 8);
              if (sexChar == 'M' || sexChar == 'F') {
                data['sex'] = sexChar;
              }
            }
            
            // Expiry (chars 8-14)
            if (line2.length >= 14) {
              final expiryStr = line2.substring(8, 14);
              if (RegExp(r'^\d{6}$').hasMatch(expiryStr)) {
                data['expirationDate'] = _formatMRZDate(expiryStr);
              }
            }
          }

          // Extract name from line 3
          if (line3.isNotEmpty) {
            final nameMatch = RegExp(r'([A-Z<]+?)<<([A-Z<]+)').firstMatch(line3);
            if (nameMatch != null) {
              data['lastName'] = nameMatch.group(1)?.replaceAll('<', ' ').trim();
              data['firstName'] = nameMatch.group(2)?.replaceAll('<', ' ').trim();
            } else {
              // Try simpler name pattern
              final simpleNameMatch = RegExp(r'([A-Z]{2,})<<([A-Z]{2,})').firstMatch(line3);
              if (simpleNameMatch != null) {
                data['lastName'] = simpleNameMatch.group(1)?.replaceAll('<', ' ').trim();
                data['firstName'] = simpleNameMatch.group(2)?.replaceAll('<', ' ').trim();
              }
            }
          }
        }

        // Clean up empty values
        data.removeWhere((key, value) => value == null || value.toString().isEmpty);

        debugPrint('MRZ Extracted Data: $data');
        return data.isNotEmpty ? data : null;
      }

      return null;
    } catch (e) {
      debugPrint('MRZ extraction error: $e');
      return null;
    }
  }

  // Extract data using OCR pattern matching
  static Map<String, dynamic>? extractDataFromOCR(String text) {
    debugPrint('Attempting OCR pattern extraction...');
    final data = <String, dynamic>{};

    // Clean text for better pattern matching while preserving structure
    final cleanText = text.replaceAll(RegExp(r'[ \t]+'), ' ').trim();
    final lines = cleanText.split('\n').map((l) => l.trim()).where((l) => l.isNotEmpty).toList();
    
    debugPrint('OCR Lines: ${lines.length}');
    debugPrint('Sample lines: ${lines.take(10).join(" | ")}');

    // Enhanced patterns for various ID formats - more comprehensive
    final patterns = {
      'documentNumber': [
        // Pattern with label
        RegExp(
            r'(?:ID|Doc(?:ument)?|Number|No\.?|Card\s*No\.?|Passport|License|NIC|Identification|#)[:\s]*([A-Z0-9\-/]{4,20})',
            caseSensitive: false),
        // Standalone patterns
        RegExp(r'\b([A-Z]{1,2}\d{7,12})\b'),
        RegExp(r'\b(\d{9,12})\b'),
        RegExp(r'\b([A-Z]\d{8,10})\b'),
        RegExp(r'\b([A-Z0-9]{8,15})\b'),
      ],
      'firstName': [
        // Pattern with label
        RegExp(
            r'(?:First\s*Name|Given\s*Name|Prenom|Name)[:\s]*([A-Z][A-Za-z]{1,25})',
            caseSensitive: false),
        RegExp(
            r'(?:Given|First)[:\s]*([A-Z][A-Za-z\s]{1,30}?)(?:\s*(?:Last|Surname|Family))',
            caseSensitive: false),
      ],
      'lastName': [
        // Pattern with label
        RegExp(
            r'(?:Last\s*Name|Surname|Family\s*Name|Nom)[:\s]*([A-Z][A-Za-z\s]{1,30})',
            caseSensitive: false),
        RegExp(
            r'(?:Surname|Last|Family)[:\s]*([A-Z][A-Za-z\s]{1,30}?)(?:\s*(?:First|Given|DOB|Date|Sex))',
            caseSensitive: false),
      ],
      'dateOfBirth': [
        // Pattern with label
        RegExp(
            r'(?:DOB|Date\s*of\s*Birth|Born|Birth\s*Date|Naissance|D\.O\.B\.?)[:\s]*(\d{1,2}[/\-.\s]\d{1,2}[/\-.\s]\d{2,4})',
            caseSensitive: false),
        // Standalone date patterns
        RegExp(r'\b(\d{1,2}[/\-]\d{1,2}[/\-]\d{4})\b'),
        RegExp(r'\b(\d{4}[/\-]\d{1,2}[/\-]\d{1,2})\b'),
        RegExp(r'\b(\d{2}[/\-]\d{2}[/\-]\d{2})\b'),
      ],
      'nationality': [
        RegExp(
            r'(?:Nationality|Citizen|Country|Nationalite)[:\s]*([A-Z][A-Za-z\s]{2,30})',
            caseSensitive: false),
        RegExp(r'(?:NAT|NATION)[:\s]*([A-Z]{2,3})\b', caseSensitive: false),
      ],
      'sex': [
        RegExp(r'(?:Sex|Gender|Sexe)[:\s]*([MFmfHF])', caseSensitive: false),
        RegExp(r'\bSex[:\s]*([MF])\b', caseSensitive: false),
        RegExp(r'\b(Male|Female|MALE|FEMALE)\b'),
      ],
      'address': [
        RegExp(
            r'(?:Address|Addr|Residence)[:\s]*([A-Za-z0-9\s,.-]{10,100})',
            caseSensitive: false),
      ],
    };

    // Try each pattern group
    for (final entry in patterns.entries) {
      final key = entry.key;
      final patternArray = entry.value;

      for (final pattern in patternArray) {
        final match = pattern.firstMatch(cleanText);
        if (match != null && match.group(1) != null) {
          var value = match.group(1)!.trim();

          // Skip if value is too short or invalid
          if (value.isEmpty) continue;

          // Convert date formats
          if (key == 'dateOfBirth') {
            value = _convertDateFormat(value);
            // Validate date
            if (!RegExp(r'^\d{4}-\d{2}-\d{2}$').hasMatch(value)) {
              continue; // Invalid date format
            }
          }

          // Normalize sex value
          if (key == 'sex') {
            if (value.toUpperCase() == 'MALE') {
              value = 'M';
            } else if (value.toUpperCase() == 'FEMALE') {
              value = 'F';
            } else {
              value = value.toUpperCase();
              if (value == 'H') value = 'M'; // Handle French "Homme"
            }
            if (value != 'M' && value != 'F') continue; // Invalid sex value
          }

          // Validate minimum length for names
          if ((key == 'firstName' || key == 'lastName') && value.length < 2) {
            continue;
          }

          // Validate document number
          if (key == 'documentNumber' && value.length < 4) {
            continue;
          }

          data[key] = value;
          debugPrint('Found $key: $value');
          break; // Found match, try next field
        }
      }
    }

    // Fallback extraction if insufficient data
    if (data.length < 2) {
      debugPrint('Trying fallback extraction patterns...');

      // Try line-by-line structured extraction
      for (int i = 0; i < lines.length; i++) {
        final line = lines[i];
        
        // Look for name patterns on same line
        if (!data.containsKey('firstName') || !data.containsKey('lastName')) {
          // Pattern: LASTNAME FIRSTNAME
          final nameMatch = RegExp(r'^([A-Z][A-Z\s]{2,25})\s+([A-Z][A-Z\s]{2,25})$').firstMatch(line);
          if (nameMatch != null) {
            if (!data.containsKey('lastName')) {
              data['lastName'] = nameMatch.group(1)!.trim();
              debugPrint('Fallback: Found lastName on line: ${nameMatch.group(1)}');
            }
            if (!data.containsKey('firstName')) {
              data['firstName'] = nameMatch.group(2)!.trim();
              debugPrint('Fallback: Found firstName on line: ${nameMatch.group(2)}');
            }
          }
        }

        // Look for dates
        if (!data.containsKey('dateOfBirth')) {
          final dateMatch = RegExp(r'\b(\d{1,2}[/\-]\d{1,2}[/\-]\d{2,4})\b').firstMatch(line);
          if (dateMatch != null) {
            final convertedDate = _convertDateFormat(dateMatch.group(1)!);
            if (RegExp(r'^\d{4}-\d{2}-\d{2}$').hasMatch(convertedDate)) {
              data['dateOfBirth'] = convertedDate;
              debugPrint('Fallback: Found date on line: ${dateMatch.group(1)}');
            }
          }
        }

        // Look for document numbers
        if (!data.containsKey('documentNumber')) {
          final docMatch = RegExp(r'\b([A-Z0-9]{8,15})\b').firstMatch(line);
          if (docMatch != null) {
            final docNum = docMatch.group(1)!;
            // Filter out dates and common words
            if (!RegExp(r'^\d{8,}$').hasMatch(docNum) && 
                !RegExp(r'^(PASSPORT|NATIONAL|IDENTITY|DOCUMENT)$', caseSensitive: false).hasMatch(docNum)) {
              data['documentNumber'] = docNum;
              debugPrint('Fallback: Found document number on line: $docNum');
            }
          }
        }

        // Look for sex/gender
        if (!data.containsKey('sex')) {
          final sexMatch = RegExp(r'\b(MALE|FEMALE|M|F)\b').firstMatch(line);
          if (sexMatch != null) {
            var sex = sexMatch.group(1)!;
            if (sex == 'MALE') sex = 'M';
            if (sex == 'FEMALE') sex = 'F';
            if (sex == 'M' || sex == 'F') {
              data['sex'] = sex;
              debugPrint('Fallback: Found sex on line: $sex');
            }
          }
        }
      }

      // Last resort: look for any capital letter sequences (names)
      if (!data.containsKey('firstName') && !data.containsKey('lastName')) {
        final nameMatches = RegExp(r'\b[A-Z][A-Z]{2,20}\b').allMatches(cleanText);
        final names = nameMatches
            .map((m) => m.group(0)!)
            .where((n) => !RegExp(r'^(ID|CARD|PASSPORT|NATIONAL|IDENTITY|NAME|FIRST|LAST|DOB|SEX|MALE|FEMALE)$').hasMatch(n))
            .toList();
        
        if (names.length >= 2) {
          if (!data.containsKey('lastName')) {
            data['lastName'] = names[0];
            debugPrint('Fallback: Found lastName from capitals: ${names[0]}');
          }
          if (!data.containsKey('firstName')) {
            data['firstName'] = names[1];
            debugPrint('Fallback: Found firstName from capitals: ${names[1]}');
          }
        }
      }
    }

    debugPrint('OCR Extracted Data: $data');
    return data.isNotEmpty ? data : null;
  }

  // Format MRZ date (YYMMDD) to YYYY-MM-DD
  static String _formatMRZDate(String dateStr) {
    if (dateStr.length != 6) return dateStr;

    try {
      final year = int.parse(dateStr.substring(0, 2));
      final month = dateStr.substring(2, 4);
      final day = dateStr.substring(4, 6);

      // Determine century
      final fullYear = year > 30 ? 1900 + year : 2000 + year;

      return '$fullYear-$month-$day';
    } catch (e) {
      return dateStr;
    }
  }

  // Convert various date formats to YYYY-MM-DD
  static String _convertDateFormat(String dateStr) {
    if (dateStr.isEmpty) return '';

    // Remove extra spaces and normalize separators
    final cleaned = dateStr
        .replaceAll(RegExp(r'\s+'), '')
        .replaceAll(RegExp(r'[.\-]'), '/');

    // Try different date format patterns
    final patterns = [
      RegExp(r'^(\d{1,2})/(\d{1,2})/(\d{4})$'), // DD/MM/YYYY or MM/DD/YYYY
      RegExp(r'^(\d{4})/(\d{1,2})/(\d{1,2})$'), // YYYY/MM/DD
      RegExp(r'^(\d{1,2})/(\d{1,2})/(\d{2})$'), // DD/MM/YY or MM/DD/YY
    ];

    for (final pattern in patterns) {
      final match = pattern.firstMatch(cleaned);
      if (match != null) {
        var part1 = match.group(1)!;
        var part2 = match.group(2)!;
        var part3 = match.group(3)!;

        // Convert 2-digit year to 4-digit
        if (part3.length == 2) {
          final yearNum = int.parse(part3);
          part3 = yearNum > 30 ? '19$part3' : '20$part3';
        }

        // Determine format
        if (pattern.pattern.contains(r'(\d{4})')) {
          // YYYY/MM/DD format
          return '$part1-${part2.padLeft(2, '0')}-${part3.padLeft(2, '0')}';
        } else if (int.parse(part1) > 12) {
          // DD/MM/YYYY format
          return '$part3-${part2.padLeft(2, '0')}-${part1.padLeft(2, '0')}';
        } else {
          // Assume MM/DD/YYYY format
          return '$part3-${part1.padLeft(2, '0')}-${part2.padLeft(2, '0')}';
        }
      }
    }

    return dateStr; // Return original if no pattern matches
  }
}
