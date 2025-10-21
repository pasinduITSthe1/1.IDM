import 'package:flutter/material.dart';
import 'package:camera/camera.dart';
import 'package:google_mlkit_text_recognition/google_mlkit_text_recognition.dart';
import 'package:flutter_tesseract_ocr/flutter_tesseract_ocr.dart';
import 'package:mrz_parser/mrz_parser.dart';
import 'package:permission_handler/permission_handler.dart';
import 'result_screen.dart';

class MRZScannerScreen extends StatefulWidget {
  const MRZScannerScreen({super.key});

  @override
  State<MRZScannerScreen> createState() => _MRZScannerScreenState();
}

class _MRZScannerScreenState extends State<MRZScannerScreen> {
  CameraController? _cameraController;
  final TextRecognizer _textRecognizer = TextRecognizer();
  bool _isProcessing = false;
  String _statusMessage = 'Position MRZ in frame';

  @override
  void initState() {
    super.initState();
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
      ResolutionPreset.high,
      enableAudio: false,
    );

    await _cameraController!.initialize();
    setState(() {});
  }

  Future<void> _captureAndScan() async {
    if (_isProcessing || _cameraController == null) return;

    setState(() {
      _isProcessing = true;
      _statusMessage = 'Scanning with ML Kit...';
    });

    try {
      final image = await _cameraController!.takePicture();
      
      // PRIMARY: Try ML Kit first
      final inputImage = InputImage.fromFilePath(image.path);
      final recognizedText = await _textRecognizer.processImage(inputImage);
      var mrzData = _extractMRZ(recognizedText.text);
      
      // FALLBACK: If ML Kit fails, try Tesseract with multiple modes
      if (mrzData == null) {
        setState(() {
          _statusMessage = 'Trying Tesseract OCR...';
        });
        
        // Try different PSM modes for better accuracy
        final psmModes = ['6', '7', '11']; // Block, line, sparse text
        
        for (final psm in psmModes) {
          try {
            debugPrint('Trying Tesseract with PSM $psm');
            final tesseractText = await FlutterTesseractOcr.extractText(
              image.path,
              language: 'eng',
              args: {
                "psm": psm,
                "preserve_interword_spaces": "0",
              },
            );
            
            mrzData = _extractMRZ(tesseractText);
            if (mrzData != null) {
              debugPrint('✓ Tesseract succeeded with PSM $psm');
              break;
            }
          } catch (e) {
            debugPrint('Tesseract PSM $psm error: $e');
          }
        }
      }
      
      if (mrzData != null && mounted) {
        Navigator.pushReplacement(
          context,
          MaterialPageRoute(
            builder: (context) => ResultScreen(mrzData: mrzData!),
          ),
        );
      } else {
        setState(() {
          _statusMessage = 'No MRZ found - try again';
          _isProcessing = false;
        });
      }
    } catch (e) {
      setState(() {
        _statusMessage = 'Error: $e';
        _isProcessing = false;
      });
    }
  }

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
          debugPrint('✓ TD-3 Passport detected at lines $i, ${i+1}');
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
          debugPrint('✓ TD-1 ID Card detected at lines $i, ${i+1}, ${i+2}');
          return _formatResult(result, 'ID Card (TD-1)');
        }
      }

      // TD-2 (ID Card - 2 lines, 36 chars each) - Some countries use this
      for (int i = 0; i < mrzCandidates.length - 1; i++) {
        final line1 = _padOrTruncate(mrzCandidates[i], 36);
        final line2 = _padOrTruncate(mrzCandidates[i + 1], 36);
        
        final result = MRZParser.tryParse([line1, line2]);
        if (result != null) {
          debugPrint('✓ TD-2 ID Card detected at lines $i, ${i+1}');
          return _formatResult(result, 'ID Card (TD-2)');
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
    // Common OCR mistakes in MRZ
    return line
        // Letter O vs digit 0
        .replaceAll(RegExp(r'O(?=\d)'), '0')  // O followed by digit → 0
        .replaceAll(RegExp(r'(?<=\d)O'), '0')  // O after digit → 0
        // Letter I vs digit 1
        .replaceAll(RegExp(r'I(?=\d)'), '1')  // I followed by digit → 1
        .replaceAll(RegExp(r'(?<=\d)I'), '1')  // I after digit → 1
        // Letter S vs digit 5 (in some fonts)
        .replaceAll(RegExp(r'S(?=\d{2,})'), '5')
        // Letter Z vs digit 2 (rare but happens)
        .replaceAll(RegExp(r'Z(?=\d{2,})'), '2')
        // Remove any remaining special characters
        .replaceAll(RegExp(r'[^A-Z0-9<]', caseSensitive: false), '')
        .toUpperCase();
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
    return {
      'type': docType,
      'firstName': result.givenNames ?? 'N/A',
      'lastName': result.surnames ?? 'N/A',
      'documentNumber': result.documentNumber ?? 'N/A',
      'nationality': result.nationalityCountryCode ?? 'N/A',
      'dateOfBirth': result.birthDate?.toString().split(' ')[0] ?? 'N/A',
      'sex': result.sex?.toString().split('.').last ?? 'N/A',
      'expiryDate': result.expiryDate?.toString().split(' ')[0] ?? 'N/A',
    };
  }

  Map<String, String>? _tryManualParsing(List<String> lines) {
    // Manual parsing for heavily damaged MRZ as last resort
    try {
      // Check if first line starts with P (passport) or I/A/C (ID cards)
      for (int i = 0; i < lines.length; i++) {
        final line = lines[i];
        
        // Passport pattern: P<COUNTRYNAME<<<<<<...
        if (line.startsWith('P<') && i + 1 < lines.length) {
          debugPrint('Manual parsing: Detected passport pattern');
          final line2 = lines[i + 1];
          
          // Extract basic info from line 2
          if (line2.length >= 28) {
            return {
              'type': 'Passport (Manual)',
              'firstName': 'See Document',
              'lastName': line.substring(2, line.indexOf('<', 2)).replaceAll('<', ' '),
              'documentNumber': line2.substring(0, 9).replaceAll('<', ''),
              'nationality': line2.substring(10, 13),
              'dateOfBirth': _formatDate(line2.substring(13, 19)),
              'sex': line2.length > 20 ? line2[20] : 'X',
              'expiryDate': line2.length > 27 ? _formatDate(line2.substring(21, 27)) : 'N/A',
            };
          }
        }
        
        // ID card pattern: Lines starting with ID/AC/I<
        if ((line.startsWith('ID') || line.startsWith('AC') || line.startsWith('I<')) 
            && i + 2 < lines.length) {
          debugPrint('Manual parsing: Detected ID card pattern');
          return {
            'type': 'ID Card (Manual)',
            'firstName': 'See Document',
            'lastName': 'See Document',
            'documentNumber': line.length > 15 ? line.substring(5, 14).replaceAll('<', '') : 'N/A',
            'nationality': 'N/A',
            'dateOfBirth': 'N/A',
            'sex': 'N/A',
            'expiryDate': 'N/A',
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
  void dispose() {
    _cameraController?.dispose();
    _textRecognizer.close();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    if (_cameraController == null || !_cameraController!.value.isInitialized) {
      return Scaffold(
        appBar: AppBar(title: const Text('MRZ Scanner')),
        body: const Center(child: CircularProgressIndicator()),
      );
    }

    return Scaffold(
      appBar: AppBar(
        title: const Text('Scan Document'),
        backgroundColor: Colors.black87,
        foregroundColor: Colors.white,
      ),
      body: Stack(
        children: [
          CameraPreview(_cameraController!),
          
          // Visual guide overlay
          Center(
            child: Container(
              width: MediaQuery.of(context).size.width * 0.85,
              height: 200,
              decoration: BoxDecoration(
                border: Border.all(color: Colors.greenAccent, width: 3),
                borderRadius: BorderRadius.circular(12),
              ),
              child: Column(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  Icon(
                    Icons.credit_card,
                    size: 48,
                    color: Colors.greenAccent.withOpacity(0.7),
                  ),
                  const SizedBox(height: 8),
                  Text(
                    'Position MRZ lines here',
                    style: TextStyle(
                      color: Colors.greenAccent.withOpacity(0.9),
                      fontSize: 14,
                      fontWeight: FontWeight.bold,
                      backgroundColor: Colors.black54,
                    ),
                  ),
                ],
              ),
            ),
          ),
          
          // Top instruction banner
          Positioned(
            top: 0,
            left: 0,
            right: 0,
            child: Container(
              color: Colors.black87,
              padding: const EdgeInsets.all(12),
              child: Column(
                children: [
                  const Text(
                    'Tips for Best Results:',
                    style: TextStyle(
                      color: Colors.yellowAccent,
                      fontSize: 14,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  const SizedBox(height: 4),
                  Text(
                    '• Good lighting  • Hold steady  • Focus on MRZ lines',
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
          
          Positioned(
            bottom: 0,
            left: 0,
            right: 0,
            child: Container(
              color: Colors.black87,
              padding: const EdgeInsets.all(20),
              child: Column(
                children: [
                  Text(
                    _statusMessage,
                    style: const TextStyle(
                      color: Colors.white,
                      fontSize: 16,
                    ),
                    textAlign: TextAlign.center,
                  ),
                  const SizedBox(height: 16),
                  FilledButton.icon(
                    onPressed: _isProcessing ? null : _captureAndScan,
                    icon: const Icon(Icons.camera),
                    label: Text(_isProcessing ? 'Processing...' : 'Capture & Scan'),
                    style: FilledButton.styleFrom(
                      padding: const EdgeInsets.symmetric(
                        horizontal: 32,
                        vertical: 16,
                      ),
                    ),
                  ),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }
}
