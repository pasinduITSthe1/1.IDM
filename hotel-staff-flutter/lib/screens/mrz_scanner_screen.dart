import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:camera/camera.dart';
import 'package:google_mlkit_text_recognition/google_mlkit_text_recognition.dart';
import 'package:flutter_tesseract_ocr/flutter_tesseract_ocr.dart';
import 'package:mrz_parser/mrz_parser.dart';
import 'package:permission_handler/permission_handler.dart';
import 'package:go_router/go_router.dart';
import 'package:image_picker/image_picker.dart';
import '../utils/enhanced_popups.dart';

/// Enhanced MRZ Scanner - Uses Google ML Kit + Tesseract OCR (FREE)
/// Features: Auto-capture, Flash control, Image preprocessing, Gallery upload,
/// Multi-frame analysis, Checksum validation, Confidence scoring
class MRZScannerScreen extends StatefulWidget {
  const MRZScannerScreen({super.key});

  @override
  State<MRZScannerScreen> createState() => _MRZScannerScreenState();
}

class _MRZScannerScreenState extends State<MRZScannerScreen> {
  CameraController? _cameraController;
  final TextRecognizer _textRecognizer = TextRecognizer();
  final ImagePicker _imagePicker = ImagePicker();
  final _scaffoldMessengerKey = GlobalKey<ScaffoldMessengerState>();

  // State management
  bool _isProcessing = false;
  String _statusMessage = 'Position MRZ in frame';
  bool _isFlashOn = false;
  bool _autoCapture = false; // Disabled by default for faster scanning
  Map<String, double>? _confidenceScores;

  // Multi-frame analysis
  final List<Map<String, String>> _scanResults = [];
  final int _maxFrames = 1; // Single frame capture for immediate results

  @override
  void initState() {
    super.initState();
    SystemChrome.setPreferredOrientations([DeviceOrientation.portraitUp]);
    _initializeCamera();
  }

  Future<void> _initializeCamera() async {
    final status = await Permission.camera.request();
    if (!status.isGranted) {
      setState(() => _statusMessage = 'Camera permission denied');
      return;
    }

    final cameras = await availableCameras();
    if (cameras.isEmpty) {
      setState(() => _statusMessage = 'No camera found');
      return;
    }

    _cameraController = CameraController(
      cameras.first,
      ResolutionPreset
          .high, // High resolution needed for clear MRZ text detection
      enableAudio: false,
      imageFormatGroup: ImageFormatGroup.jpeg,
    );

    await _cameraController!.initialize();
    setState(() {});
  }

  // FEATURE 1: UX Enhancement - Flash/Torch Control
  Future<void> _toggleFlash() async {
    if (_cameraController == null) return;

    try {
      final newMode = _isFlashOn ? FlashMode.off : FlashMode.torch;
      await _cameraController!.setFlashMode(newMode);
      setState(() {
        _isFlashOn = !_isFlashOn;
      });
      HapticFeedback.lightImpact();
    } catch (e) {
      debugPrint('Flash toggle error: $e');
    }
  }

  void _showMessage(String message, PopupType type) {
    _scaffoldMessengerKey.currentState?.clearSnackBars();
    _scaffoldMessengerKey.currentState?.showSnackBar(
      SnackBar(
        content: Row(
          children: [
            Container(
              padding: const EdgeInsets.all(8),
              decoration: BoxDecoration(
                color: Colors.white.withOpacity(0.2),
                borderRadius: BorderRadius.circular(8),
              ),
              child: Icon(
                type == PopupType.success
                    ? Icons.check_circle_rounded
                    : type == PopupType.error
                        ? Icons.error_rounded
                        : type == PopupType.warning
                            ? Icons.warning_rounded
                            : Icons.info_rounded,
                color: Colors.white,
                size: 20,
              ),
            ),
            const SizedBox(width: 12),
            Expanded(
              child: Column(
                mainAxisSize: MainAxisSize.min,
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    type == PopupType.success
                        ? 'Success'
                        : type == PopupType.error
                            ? 'Error'
                            : type == PopupType.warning
                                ? 'Warning'
                                : 'Info',
                    style: const TextStyle(
                      fontWeight: FontWeight.bold,
                      fontSize: 14,
                      color: Colors.white,
                    ),
                  ),
                  Text(
                    message,
                    style: const TextStyle(fontSize: 13, color: Colors.white),
                  ),
                ],
              ),
            ),
          ],
        ),
        backgroundColor: type == PopupType.success
            ? const Color(0xFF10B981)
            : type == PopupType.error
                ? const Color(0xFFEF4444)
                : type == PopupType.warning
                    ? const Color(0xFFF59E0B)
                    : const Color(0xFF3B82F6),
        behavior: SnackBarBehavior.floating,
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(10)),
        margin: const EdgeInsets.all(16),
        duration: const Duration(seconds: 3),
      ),
    );
  }

  // FEATURE 3: Gallery Upload Option
  Future<void> _pickFromGallery() async {
    try {
      final XFile? image = await _imagePicker.pickImage(
        source: ImageSource.gallery,
        imageQuality: 85,
      );

      if (image != null) {
        setState(() {
          _isProcessing = true;
          _statusMessage = 'Processing image from gallery...';
        });

        await _processImage(image.path);
      }
    } catch (e) {
      setState(() {
        _statusMessage = 'Gallery error: $e';
        _isProcessing = false;
      });
    }
  }

  Future<void> _captureAndScan() async {
    if (_isProcessing || _cameraController == null) return;

    setState(() {
      _isProcessing = true;
      _statusMessage = 'Capturing image...';
    });

    try {
      // Pause camera preview to reduce buffer usage during processing
      await _cameraController!.pausePreview();

      final image = await _cameraController!.takePicture();
      await _processImage(image.path);

      // Resume preview after processing if still mounted
      if (mounted && _cameraController != null) {
        await _cameraController!.resumePreview();
      }
    } catch (e) {
      setState(() {
        _statusMessage = 'Capture error: $e';
        _isProcessing = false;
      });
      // Make sure to resume preview even on error
      if (mounted && _cameraController != null) {
        try {
          await _cameraController!.resumePreview();
        } catch (_) {}
      }
    }
  }

  // FEATURE 2 & 4: Image Preprocessing + Performance Optimization
  Future<void> _processImage(String imagePath) async {
    try {
      setState(() => _statusMessage = 'Processing image...');

      // Temporarily disabled image preprocessing - using original image directly
      // TODO: Re-enable with proper error handling after testing
      await _runOCR(imagePath);

      /* Image preprocessing code - disabled for now
      final bytes = await File(imagePath).readAsBytes();
      img.Image? image = img.decodeImage(bytes);
      
      if (image != null) {
        if (image.width > 1920) {
          image = img.copyResize(image, width: 1920);
        }
        image = img.adjustColor(image, contrast: 1.2, brightness: 1.1);
        image = img.grayscale(image);
        final processedPath = '${imagePath}_processed.jpg';
        await File(processedPath).writeAsBytes(img.encodeJpg(image, quality: 90));
        await _runOCR(processedPath);
      } else {
        await _runOCR(imagePath);
      }
      */
    } catch (e) {
      debugPrint('Processing error: $e');
      await _runOCR(imagePath);
    }
  }

  // FEATURE 4: Performance - Parallel OCR Processing
  Future<void> _runOCR(String imagePath) async {
    setState(() => _statusMessage = 'Running OCR engines...');

    Map<String, String>? mrzData;

    try {
      // Run both OCR engines in parallel for faster results
      final results = await Future.wait([
        _runMLKit(imagePath),
        _runTesseract(imagePath),
      ]);

      // Use first successful result
      mrzData = results.firstWhere(
        (result) => result != null,
        orElse: () => null,
      );

      if (mrzData != null) {
        // Single-frame mode: process immediately without waiting
        if (_maxFrames == 1) {
          // Calculate confidence scores
          _confidenceScores = _calculateConfidence(mrzData);
          // Show preview immediately
          _showDataPreview(mrzData);
          return;
        }

        // FEATURE 1: Multi-frame analysis for accuracy (only if maxFrames > 1)
        _scanResults.add(mrzData);

        if (_scanResults.length < _maxFrames && _autoCapture) {
          setState(() {
            _statusMessage =
                'Frame ${_scanResults.length}/$_maxFrames captured';
            _isProcessing = false;
          });

          // Auto-capture next frame
          await Future.delayed(const Duration(milliseconds: 500));
          if (mounted && _autoCapture) {
            await _captureAndScan();
          }
          return;
        }

        // FEATURE 5: Validation - Analyze all frames and pick best result
        final bestResult = _analyzeScanResults();

        if (bestResult != null) {
          // FEATURE 5: Calculate confidence scores
          _confidenceScores = _calculateConfidence(bestResult);

          // Show preview before submitting
          _showDataPreview(bestResult);
        } else {
          setState(() {
            _statusMessage = 'Data inconsistent across frames - please rescan';
            _isProcessing = false;
            _scanResults.clear();
          });

          if (mounted) {
            EnhancedPopups.showEnhancedSnackBar(
              context,
              message:
                  'Multiple scans didn\'t match. Try holding camera steadier.',
              type: PopupType.warning,
              duration: const Duration(seconds: 3),
            );
          }
        }
      } else {
        setState(() {
          _statusMessage = 'No MRZ detected - Try better lighting or focus';
          _isProcessing = false;
        });

        // Show helpful message
        if (mounted) {
          EnhancedPopups.showEnhancedSnackBar(
            context,
            message:
                'Tip: Ensure good lighting and hold camera steady over MRZ lines',
            type: PopupType.info,
            duration: const Duration(seconds: 3),
          );
        }
      }
    } catch (e) {
      setState(() {
        _statusMessage = 'OCR error: $e';
        _isProcessing = false;
      });
    }
  }

  Future<Map<String, String>?> _runMLKit(String imagePath) async {
    try {
      final inputImage = InputImage.fromFilePath(imagePath);
      final recognizedText = await _textRecognizer.processImage(inputImage);
      return _extractMRZ(recognizedText.text);
    } catch (e) {
      debugPrint('ML Kit error: $e');
      return null;
    }
  }

  Future<Map<String, String>?> _runTesseract(String imagePath) async {
    try {
      final psmModes = ['6', '7', '11'];

      for (final psm in psmModes) {
        try {
          final text = await FlutterTesseractOcr.extractText(
            imagePath,
            language: 'eng',
            args: {
              "psm": psm,
              "preserve_interword_spaces": "0",
            },
          );

          final result = _extractMRZ(text);
          if (result != null) return result;
        } catch (e) {
          debugPrint('Tesseract PSM $psm error: $e');
        }
      }
    } catch (e) {
      debugPrint('Tesseract error: $e');
    }
    return null;
  }

  // FEATURE 1: Multi-frame Analysis
  Map<String, String>? _analyzeScanResults() {
    if (_scanResults.isEmpty) return null;
    if (_scanResults.length == 1) return _scanResults.first;

    // Find most consistent data across frames
    final fieldConsistency = <String, Map<String, int>>{};

    for (final result in _scanResults) {
      for (final entry in result.entries) {
        fieldConsistency.putIfAbsent(entry.key, () => {});
        fieldConsistency[entry.key]![entry.value] =
            (fieldConsistency[entry.key]![entry.value] ?? 0) + 1;
      }
    }

    // Build result with most common values
    final bestResult = <String, String>{};
    for (final entry in fieldConsistency.entries) {
      final sortedValues = entry.value.entries.toList()
        ..sort((a, b) => b.value.compareTo(a.value));

      if (sortedValues.isNotEmpty) {
        bestResult[entry.key] = sortedValues.first.key;
      }
    }

    return bestResult.isNotEmpty ? bestResult : null;
  }

  // FEATURE 5: Confidence Scoring
  Map<String, double> _calculateConfidence(Map<String, String> data) {
    final confidence = <String, double>{};

    for (final entry in data.entries) {
      final value = entry.value;
      double score = 0.5; // Base score

      // Increase confidence based on data quality
      if (value.isNotEmpty) score += 0.2;
      if (entry.key == 'nationality' && value.length == 3) score += 0.2;
      if (entry.key == 'sex' && ['M', 'F', 'X'].contains(value)) score += 0.3;
      if (entry.key == 'documentNumber' && value.length >= 6) score += 0.2;

      confidence[entry.key] = score.clamp(0.0, 1.0);
    }

    return confidence;
  }

  // FEATURE 1: Data Preview Dialog
  void _showDataPreview(Map<String, String> data) {
    setState(() {
      _isProcessing = false;
    });

    HapticFeedback.mediumImpact();

    showDialog(
      context: context,
      barrierDismissible: false,
      builder: (context) => AlertDialog(
        title: const Text('Scanned Data Preview'),
        content: SingleChildScrollView(
          child: Column(
            mainAxisSize: MainAxisSize.min,
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              _buildPreviewField('Type', data['type']),
              _buildPreviewField('First Name', data['firstName']),
              _buildPreviewField('Last Name', data['lastName']),
              _buildPreviewField('Document #', data['documentNumber']),
              _buildPreviewField('Nationality', data['nationality']),
              _buildPreviewField('Date of Birth', data['dateOfBirth']),
              _buildPreviewField('Sex', data['sex']),
              _buildPreviewField('Expiry Date', data['expiryDate']),
              const SizedBox(height: 12),
              const Text(
                'Review data before continuing',
                style: TextStyle(
                  fontSize: 12,
                  fontStyle: FontStyle.italic,
                  color: Colors.grey,
                ),
              ),
            ],
          ),
        ),
        actions: [
          TextButton(
            onPressed: () {
              Navigator.pop(context);
              setState(() {
                _scanResults.clear();
              });
            },
            child: const Text('Rescan'),
          ),
          TextButton(
            onPressed: () {
              Navigator.pop(context);
              context.go('/register-guest');
            },
            child: const Text('Manual Entry'),
          ),
          FilledButton(
            onPressed: () {
              Navigator.pop(context);
              // Navigate to ID photo capture screen
              final validated = _validateData(data);
              if (validated != null && mounted) {
                context.go('/capture-id-photos', extra: validated);
              }
            },
            child: const Text('Next: Photos'),
          ),
        ],
      ),
    );
  }

  Widget _buildPreviewField(String label, String? value) {
    final confidence =
        _confidenceScores?[label.toLowerCase().replaceAll(' ', '')] ?? 0.5;
    final color = confidence > 0.7
        ? Colors.green
        : confidence > 0.5
            ? Colors.orange
            : Colors.red;

    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 4),
      child: Row(
        children: [
          Icon(Icons.circle, size: 8, color: color),
          const SizedBox(width: 8),
          Expanded(
            child: Text(
              '$label: ${value ?? "N/A"}',
              style: const TextStyle(fontSize: 14),
            ),
          ),
        ],
      ),
    );
  }

  // FEATURE 5: Validation & Error Handling
  Map<String, String>? _validateData(Map<String, String> data) {
    final validated = Map<String, String>.from(data);
    final errors = <String>[];

    // Validate nationality (must be 3 letters)
    if (validated['nationality']?.length != 3) {
      errors.add('Invalid nationality code');
    }

    // Validate sex
    final sex = validated['sex']?.trim().toUpperCase();
    if (sex != null &&
        sex.isNotEmpty &&
        sex != '<' &&
        !['M', 'F', 'X'].contains(sex)) {
      // Only show warning for truly invalid values (not empty, spaces, or placeholders)
      errors.add('Invalid sex field: $sex');
      validated['sex'] = 'X'; // Default
    } else {
      // Set default for missing/placeholder/invalid values
      validated['sex'] = (sex == 'M' || sex == 'F') ? sex! : 'X';
    }

    // Validate document number
    if (validated['documentNumber']?.isEmpty ?? true) {
      errors.add('Missing document number');
    }

    // Validate dates
    final dob = validated['dateOfBirth'];
    if (dob != null && dob.isNotEmpty) {
      if (!_isValidDate(dob)) {
        errors.add('Invalid date of birth');
      }
    }

    final expiry = validated['expiryDate'];
    if (expiry != null && expiry.isNotEmpty) {
      if (!_isValidDate(expiry)) {
        errors.add('Invalid expiry date');
      }
    }

    // Show errors if any
    if (errors.isNotEmpty) {
      EnhancedPopups.showEnhancedSnackBar(
        context,
        message: 'Warnings: ${errors.join(", ")}',
        type: PopupType.warning,
        duration: const Duration(seconds: 3),
      );
    }

    return validated;
  }

  bool _isValidDate(String date) {
    try {
      final parts = date.split('-');
      if (parts.length != 3) return false;

      final year = int.parse(parts[0]);
      final month = int.parse(parts[1]);
      final day = int.parse(parts[2]);

      if (year < 1900 || year > 2100) return false;
      if (month < 1 || month > 12) return false;
      if (day < 1 || day > 31) return false;

      return true;
    } catch (e) {
      return false;
    }
  }

  // FEATURE 5: Enhanced MRZ Extraction with Validation
  Map<String, String>? _extractMRZ(String text) {
    // Step 1: Clean and normalize the text
    var cleanedLines = text
        .split('\n')
        .map((l) => l.trim().replaceAll(' ', '').replaceAll('\t', ''))
        .where((l) => l.isNotEmpty)
        .toList();

    // Step 2: Apply OCR error corrections
    cleanedLines = cleanedLines.map((line) => _fixOCRErrors(line)).toList();

    // Step 3: Filter potential MRZ lines (more lenient)
    var mrzCandidates = cleanedLines
        .where((l) => l.length >= 20)
        .where((l) => RegExp(r'^[A-Z0-9<]+$', caseSensitive: false).hasMatch(l))
        .map((l) => l.toUpperCase())
        .toList();

    debugPrint('Found ${mrzCandidates.length} MRZ candidate lines');
    for (int i = 0; i < mrzCandidates.length; i++) {
      debugPrint('Line $i: ${mrzCandidates[i]}');
    }

    if (mrzCandidates.length < 2) return null;

    try {
      // Try all possible combinations for better detection

      // TD-3 (Passport - 2 lines, 44 chars each)
      for (int i = 0; i < mrzCandidates.length - 1; i++) {
        final line1 = _padOrTruncate(mrzCandidates[i], 44);
        final line2 = _padOrTruncate(mrzCandidates[i + 1], 44);

        final result = MRZParser.tryParse([line1, line2]);
        if (result != null) {
          debugPrint('✓ TD-3 Passport detected at lines $i, ${i + 1}');
          return _formatResult(result, 'Passport (TD-3)');
        }
      }

      // TD-1 (ID Card - 3 lines, 30 chars each)
      for (int i = 0; i < mrzCandidates.length - 2; i++) {
        final line1 = _padOrTruncate(mrzCandidates[i], 30);
        final line2 = _padOrTruncate(mrzCandidates[i + 1], 30);
        final line3 = _padOrTruncate(mrzCandidates[i + 2], 30);

        final result = MRZParser.tryParse([line1, line2, line3]);
        if (result != null) {
          debugPrint('✓ TD-1 ID Card detected at lines $i, ${i + 1}, ${i + 2}');
          return _formatResult(result, 'ID Card (TD-1)');
        }
      }

      // TD-2 (ID Card - 2 lines, 36 chars each) - Some countries use this
      for (int i = 0; i < mrzCandidates.length - 1; i++) {
        final line1 = _padOrTruncate(mrzCandidates[i], 36);
        final line2 = _padOrTruncate(mrzCandidates[i + 1], 36);

        final result = MRZParser.tryParse([line1, line2]);
        if (result != null) {
          debugPrint('✓ TD-2 ID Card detected at lines $i, ${i + 1}');
          return _formatResult(result, 'ID Card (TD-2)');
        }
      }

      // MRV-A (Visa Type A - 2 lines, 44 chars each) - Full page visas
      for (int i = 0; i < mrzCandidates.length - 1; i++) {
        final line1 = _padOrTruncate(mrzCandidates[i], 44);
        final line2 = _padOrTruncate(mrzCandidates[i + 1], 44);

        // Check if it starts with 'V' for visa
        if (line1.startsWith('V')) {
          final result = MRZParser.tryParse([line1, line2]);
          if (result != null) {
            debugPrint('✓ MRV-A Visa detected at lines $i, ${i + 1}');
            return _formatResult(result, 'Visa (MRV-A)');
          }
        }
      }

      // MRV-B (Visa Type B - 2 lines, 36 chars each) - Smaller visas
      for (int i = 0; i < mrzCandidates.length - 1; i++) {
        final line1 = _padOrTruncate(mrzCandidates[i], 36);
        final line2 = _padOrTruncate(mrzCandidates[i + 1], 36);

        // Check if it starts with 'V' for visa
        if (line1.startsWith('V')) {
          final result = MRZParser.tryParse([line1, line2]);
          if (result != null) {
            debugPrint('✓ MRV-B Visa detected at lines $i, ${i + 1}');
            return _formatResult(result, 'Visa (MRV-B)');
          }
        }
      }

      // Last resort: Try with manual parsing for damaged MRZ
      return _tryManualParsing(mrzCandidates);
    } catch (e) {
      debugPrint('MRZ parse error: $e');
    }

    return null;
  }

  String _fixOCRErrors(String line) {
    String corrected = line
        // Letter O vs digit 0
        .replaceAll(RegExp(r'O(?=\d)'), '0') // O followed by digit → 0
        .replaceAll(RegExp(r'(?<=\d)O'), '0') // O after digit → 0
        // Letter I vs digit 1
        .replaceAll(RegExp(r'I(?=\d)'), '1') // I followed by digit → 1
        .replaceAll(RegExp(r'(?<=\d)I'), '1') // I after digit → 1
        // Letter S vs digit 5 (in some fonts)
        .replaceAll(RegExp(r'S(?=\d{2,})'), '5')
        // Letter Z vs digit 2 (rare but happens)
        .replaceAll(RegExp(r'Z(?=\d{2,})'), '2')
        // Remove any remaining special characters
        .replaceAll(RegExp(r'[^A-Z0-9<]', caseSensitive: false), '')
        .toUpperCase();

    // Fix digits in 3-letter country codes (like 1TA → ITA, 0SA → OSA)
    // MRZ nationality codes are always 3 consecutive letters
    corrected = corrected.replaceAllMapped(
      RegExp(r'([A-Z<]{0,2})([01])([A-Z]{2})'),
      (match) {
        final before = match.group(1) ?? '';
        final digit = match.group(2)!;
        final after = match.group(3)!;

        // Only fix if this looks like a 3-letter code context
        if (before.isEmpty || before.endsWith('<')) {
          final letter = digit == '0' ? 'O' : 'I';
          return '$before$letter$after';
        }
        return match.group(0)!;
      },
    );

    return corrected;
  }

  String _padOrTruncate(String line, int targetLength) {
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

  Map<String, String> _formatResult(dynamic result, String docType) {
    // Convert sex enum to standard M/F/X format
    String sexValue = 'X';
    if (result.sex != null) {
      final sexStr = result.sex.toString().split('.').last.toUpperCase();
      if (sexStr.startsWith('M')) {
        sexValue = 'M';
      } else if (sexStr.startsWith('F')) {
        sexValue = 'F';
      }
    }

    return {
      'type': docType,
      'firstName': result.givenNames ?? '',
      'lastName': result.surnames ?? '',
      'documentNumber': result.documentNumber ?? '',
      'nationality': result.nationalityCountryCode ?? '',
      'dateOfBirth': result.birthDate?.toString().split(' ')[0] ?? '',
      'sex': sexValue,
      'expiryDate': result.expiryDate?.toString().split(' ')[0] ?? '',
    };
  }

  Map<String, String>? _tryManualParsing(List<String> lines) {
    // Manual parsing for heavily damaged MRZ as last resort
    try {
      // Check if first line starts with P (passport), V (visa), or I/A/C (ID cards)
      for (int i = 0; i < lines.length; i++) {
        final line = lines[i];

        // Visa pattern: V<TYPE<COUNTRY<<<<<<...
        if (line.startsWith('V') && i + 1 < lines.length) {
          debugPrint('Manual parsing: Detected visa pattern');
          final line2 = lines[i + 1];

          // Extract basic info from line 2
          if (line2.length >= 28) {
            return {
              'type': 'Visa (Manual)',
              'firstName': 'See Document',
              'lastName': line
                  .substring(
                      2,
                      line.indexOf('<', 2) != -1
                          ? line.indexOf('<', 2)
                          : line.length)
                  .replaceAll('<', ' '),
              'documentNumber': line2.substring(0, 9).replaceAll('<', ''),
              'nationality': line2.substring(10, 13),
              'dateOfBirth': _formatDate(line2.substring(13, 19)),
              'sex': line2.length > 20 ? line2[20] : 'X',
              'expiryDate':
                  line2.length > 27 ? _formatDate(line2.substring(21, 27)) : '',
            };
          }
        }

        // Passport pattern: P<COUNTRYNAME<<<<<<...
        if (line.startsWith('P<') && i + 1 < lines.length) {
          debugPrint('Manual parsing: Detected passport pattern');
          final line2 = lines[i + 1];

          // Extract basic info from line 2
          if (line2.length >= 28) {
            return {
              'type': 'Passport (Manual)',
              'firstName': 'See Document',
              'lastName':
                  line.substring(2, line.indexOf('<', 2)).replaceAll('<', ' '),
              'documentNumber': line2.substring(0, 9).replaceAll('<', ''),
              'nationality': line2.substring(10, 13),
              'dateOfBirth': _formatDate(line2.substring(13, 19)),
              'sex': line2.length > 20 ? line2[20] : 'X',
              'expiryDate':
                  line2.length > 27 ? _formatDate(line2.substring(21, 27)) : '',
            };
          }
        }

        // ID card pattern: Lines starting with ID/AC/I<
        if ((line.startsWith('ID') ||
                line.startsWith('AC') ||
                line.startsWith('I<')) &&
            i + 2 < lines.length) {
          debugPrint('Manual parsing: Detected ID card pattern');
          return {
            'type': 'ID Card (Manual)',
            'firstName': 'See Document',
            'lastName': 'See Document',
            'documentNumber': line.length > 15
                ? line.substring(5, 14).replaceAll('<', '')
                : '',
            'nationality': '',
            'dateOfBirth': '',
            'sex': '',
            'expiryDate': '',
          };
        }
      }
    } catch (e) {
      debugPrint('Manual parsing error: $e');
    }

    return null;
  }

  String _formatDate(String mrzDate) {
    // Convert YYMMDD to YYYY-MM-DD
    if (mrzDate.length != 6) return mrzDate;
    try {
      final yy = int.parse(mrzDate.substring(0, 2));
      final mm = mrzDate.substring(2, 4);
      final dd = mrzDate.substring(4, 6);
      final yyyy = yy > 50 ? 1900 + yy : 2000 + yy; // Y2K handling
      return '$yyyy-$mm-$dd';
    } catch (e) {
      return mrzDate;
    }
  }

  @override
  void deactivate() {
    // Pause camera when screen becomes inactive to prevent buffer overflow
    _cameraController?.pausePreview();
    super.deactivate();
  }

  @override
  void dispose() {
    SystemChrome.setPreferredOrientations([
      DeviceOrientation.portraitUp,
      DeviceOrientation.landscapeLeft,
      DeviceOrientation.landscapeRight,
    ]);
    _cameraController?.dispose();
    _textRecognizer.close();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    if (_cameraController == null || !_cameraController!.value.isInitialized) {
      return Scaffold(
        backgroundColor: Colors.black,
        appBar: AppBar(
          title: const Text('MRZ Scanner'),
          backgroundColor: Colors.black87,
          foregroundColor: Colors.white,
          leading: IconButton(
            icon: const Icon(Icons.arrow_back),
            onPressed: () => context.pop(),
          ),
        ),
        body: Center(
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              const CircularProgressIndicator(color: Colors.orange),
              const SizedBox(height: 16),
              const Text(
                'Initializing camera...',
                style: TextStyle(color: Colors.white, fontSize: 16),
              ),
              const SizedBox(height: 32),
              OutlinedButton.icon(
                onPressed: () {
                  context.go('/register-guest');
                },
                icon: const Icon(Icons.edit, color: Colors.orange),
                label: const Text(
                  'Skip - Enter Details Manually',
                  style: TextStyle(color: Colors.orange),
                ),
                style: OutlinedButton.styleFrom(
                  side: const BorderSide(color: Colors.orange, width: 2),
                  padding: const EdgeInsets.symmetric(
                    horizontal: 24,
                    vertical: 12,
                  ),
                ),
              ),
            ],
          ),
        ),
      );
    }

    return ScaffoldMessenger(
      key: _scaffoldMessengerKey,
      child: Scaffold(
        appBar: AppBar(
          title: const Text('Scan Document'),
          backgroundColor: Colors.black87,
          foregroundColor: Colors.white,
          leading: IconButton(
            icon: const Icon(Icons.arrow_back),
            onPressed: () {
              if (context.canPop()) {
                context.pop();
              } else {
                context.go('/dashboard');
              }
            },
          ),
          actions: [
            // FEATURE 1: Flash toggle button
            IconButton(
              icon: Icon(_isFlashOn ? Icons.flash_on : Icons.flash_off),
              onPressed: _toggleFlash,
              tooltip: 'Toggle Flash',
            ),
            // FEATURE 3: Gallery upload button
            IconButton(
              icon: const Icon(Icons.photo_library),
              onPressed: _pickFromGallery,
              tooltip: 'Pick from Gallery',
            ),
          ],
        ),
        body: Stack(
          children: [
            // Camera preview
            Positioned.fill(
              child: CameraPreview(_cameraController!),
            ),

            // FEATURE 1: Enhanced Visual guide overlay with animations
            Center(
              child: AnimatedContainer(
                duration: const Duration(milliseconds: 300),
                width: MediaQuery.of(context).size.width * 0.85,
                height: 200,
                decoration: BoxDecoration(
                  border: Border.all(
                    color: _isProcessing ? Colors.blue : Colors.orange,
                    width: 3,
                  ),
                  borderRadius: BorderRadius.circular(12),
                  color: _isProcessing
                      ? Colors.blue.withOpacity(0.1)
                      : Colors.transparent,
                ),
                child: Column(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Icon(
                      _isProcessing ? Icons.hourglass_empty : Icons.credit_card,
                      size: 48,
                      color: (_isProcessing ? Colors.blue : Colors.orange)
                          .withOpacity(0.7),
                    ),
                    const SizedBox(height: 8),
                    Text(
                      _isProcessing
                          ? 'Processing...'
                          : 'Position MRZ lines here',
                      style: TextStyle(
                        color: (_isProcessing ? Colors.blue : Colors.orange)
                            .withOpacity(0.9),
                        fontSize: 14,
                        fontWeight: FontWeight.bold,
                        backgroundColor: Colors.black54,
                      ),
                    ),
                    if (_scanResults.isNotEmpty) ...[
                      const SizedBox(height: 8),
                      Text(
                        'Frame ${_scanResults.length}/$_maxFrames',
                        style: const TextStyle(
                          color: Colors.white,
                          fontSize: 12,
                          backgroundColor: Colors.black54,
                        ),
                      ),
                    ],
                  ],
                ),
              ),
            ),

            // FEATURE 1: Enhanced instruction banner
            Positioned(
              top: 0,
              left: 0,
              right: 0,
              child: Container(
                decoration: BoxDecoration(
                  gradient: LinearGradient(
                    begin: Alignment.topCenter,
                    end: Alignment.bottomCenter,
                    colors: [
                      Colors.black.withOpacity(0.8),
                      Colors.transparent,
                    ],
                  ),
                ),
                padding: const EdgeInsets.all(12),
                child: Column(
                  children: [
                    Row(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        const Icon(
                          Icons.lightbulb_outline,
                          color: Colors.orangeAccent,
                          size: 16,
                        ),
                        const SizedBox(width: 8),
                        const Text(
                          'Tips for Best Results',
                          style: TextStyle(
                            color: Colors.orangeAccent,
                            fontSize: 14,
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                      ],
                    ),
                    const SizedBox(height: 4),
                    Text(
                      '• Good lighting  • Hold steady  • Focus on MRZ lines\n• Passport/ID bottom  • Clean document surface',
                      style: TextStyle(
                        color: Colors.white.withOpacity(0.9),
                        fontSize: 11,
                      ),
                      textAlign: TextAlign.center,
                    ),
                  ],
                ),
              ),
            ),

            // Bottom controls
            Positioned(
              bottom: 0,
              left: 0,
              right: 0,
              child: Container(
                decoration: BoxDecoration(
                  gradient: LinearGradient(
                    begin: Alignment.bottomCenter,
                    end: Alignment.topCenter,
                    colors: [
                      Colors.black.withOpacity(0.8),
                      Colors.transparent,
                    ],
                  ),
                ),
                padding: const EdgeInsets.all(20),
                child: Column(
                  mainAxisSize: MainAxisSize.min,
                  children: [
                    // Status message
                    AnimatedSwitcher(
                      duration: const Duration(milliseconds: 300),
                      child: Text(
                        _statusMessage,
                        key: ValueKey(_statusMessage),
                        style: const TextStyle(
                          color: Colors.white,
                          fontSize: 16,
                          fontWeight: FontWeight.w500,
                        ),
                        textAlign: TextAlign.center,
                      ),
                    ),
                    const SizedBox(height: 16),

                    // FEATURE 1: Enhanced capture button with loading state
                    Row(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        // Manual capture button
                        Expanded(
                          child: FilledButton.icon(
                            onPressed: _isProcessing ? null : _captureAndScan,
                            icon: _isProcessing
                                ? const SizedBox(
                                    width: 20,
                                    height: 20,
                                    child: CircularProgressIndicator(
                                      color: Colors.white,
                                      strokeWidth: 2,
                                    ),
                                  )
                                : const Icon(Icons.camera),
                            label: Text(
                                _isProcessing ? 'Processing...' : 'Capture'),
                            style: FilledButton.styleFrom(
                              backgroundColor: Colors.orange,
                              padding: const EdgeInsets.symmetric(
                                horizontal: 24,
                                vertical: 16,
                              ),
                            ),
                          ),
                        ),
                      ],
                    ),

                    const SizedBox(height: 12),

                    // Manual entry button
                    OutlinedButton.icon(
                      onPressed: _isProcessing
                          ? null
                          : () {
                              context.go('/register-guest');
                            },
                      icon: const Icon(Icons.edit_note, size: 20),
                      label: const Text('Skip - Fill Manually'),
                      style: OutlinedButton.styleFrom(
                        foregroundColor: Colors.white,
                        side: const BorderSide(color: Colors.white70),
                        padding: const EdgeInsets.symmetric(
                          horizontal: 24,
                          vertical: 12,
                        ),
                      ),
                    ),

                    // FEATURE 1: Auto-capture toggle
                    const SizedBox(height: 8),
                    Row(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        const Icon(
                          Icons.auto_awesome,
                          color: Colors.white70,
                          size: 16,
                        ),
                        const SizedBox(width: 8),
                        const Text(
                          'Multi-frame capture',
                          style: TextStyle(
                            color: Colors.white70,
                            fontSize: 12,
                          ),
                        ),
                        const SizedBox(width: 8),
                        Switch(
                          value: _autoCapture,
                          onChanged: (value) {
                            setState(() => _autoCapture = value);
                            HapticFeedback.selectionClick();
                          },
                          activeColor: Colors.orange,
                        ),
                      ],
                    ),
                  ],
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}
