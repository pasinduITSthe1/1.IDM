import 'dart:io';
import 'package:flutter/material.dart';
import 'package:camera/camera.dart';
import 'package:go_router/go_router.dart';
import 'package:google_mlkit_text_recognition/google_mlkit_text_recognition.dart';
import 'package:image/image.dart' as img;
import '../utils/app_theme.dart';
import '../utils/mrz_helper.dart'; // MRZ-ONLY extraction

class ScanDocumentScreen extends StatefulWidget {
  const ScanDocumentScreen({super.key});

  @override
  State<ScanDocumentScreen> createState() => _ScanDocumentScreenState();
}

class _ScanDocumentScreenState extends State<ScanDocumentScreen> {
  CameraController? _cameraController;
  List<CameraDescription>? _cameras;
  bool _isProcessing = false;
  bool _isCameraInitialized = false;
  String? _errorMessage;
  // String? _capturedImagePath; // Removed - no longer needed without crop step
  double _progress = 0.0;

  @override
  void initState() {
    super.initState();
    _initializeCamera();
  }

  Future<void> _initializeCamera() async {
    try {
      _cameras = await availableCameras();
      if (_cameras!.isEmpty) {
        setState(() => _errorMessage = 'No camera found on this device');
        return;
      }

      _cameraController = CameraController(
        _cameras![0],
        ResolutionPreset.veryHigh, // Higher resolution for better OCR
        enableAudio: false,
      );

      await _cameraController!.initialize();
      if (mounted) {
        setState(() => _isCameraInitialized = true);
      }
    } catch (e) {
      setState(() => _errorMessage = 'Failed to initialize camera: $e');
    }
  }

  @override
  void dispose() {
    _cameraController?.dispose();
    super.dispose();
  }

  // Step 1: Capture the photo
  Future<void> _capturePhoto() async {
    if (_cameraController == null || !_cameraController!.value.isInitialized) {
      return;
    }

    try {
      setState(() {
        _isProcessing = true;
        _progress = 0.2;
        _errorMessage = null;
      });

      // Capture image
      final XFile imageFile = await _cameraController!.takePicture();

      setState(() {
        _progress = 0.4;
      });

      debugPrint('📸 Photo captured: ${imageFile.path}');

      // Skip crop step - directly process the captured image for better performance
      await _processImage(imageFile.path);
    } catch (e) {
      setState(() {
        _errorMessage = 'Failed to capture photo: $e';
        _isProcessing = false;
        _progress = 0.0;
      });
    }
  }

  // Step 2: Crop the document area (DISABLED for better performance)
  // Skipping crop step reduces memory overhead and processing time
  /* Future<void> _cropAndProcess() async {
    if (_capturedImagePath == null) return;

    try {
      setState(() => _progress = 0.5);

      // Open image cropper (v8.x API)
      final croppedFile = await ImageCropper().cropImage(
        sourcePath: _capturedImagePath!,
        uiSettings: [
          AndroidUiSettings(
            toolbarTitle: 'Crop Document Area',
            toolbarColor: AppTheme.primaryOrange,
            toolbarWidgetColor: Colors.white,
            lockAspectRatio: false,
          ),
          IOSUiSettings(
            title: 'Crop Document Area',
          ),
        ],
      );

      if (croppedFile != null) {
        setState(() => _progress = 0.6);
        debugPrint('✂️ Document cropped: ${croppedFile.path}');
        
        // Process the cropped image
        await _processImage(croppedFile.path);
      } else {
        // User cancelled cropping
        setState(() {
          _isProcessing = false;
          _progress = 0.0;
          _capturedImagePath = null;
        });
        debugPrint('⚠️ Cropping cancelled by user');
      }
    } catch (e) {
      setState(() {
        _errorMessage = 'Failed to crop image: $e';
        _isProcessing = false;
        _progress = 0.0;
        _capturedImagePath = null;
      });
    }
  } */

  // Step 3: Process the cropped image
  Future<void> _processImage(String imagePath) async {
    try {
      if (!mounted) return;
      setState(() => _progress = 0.7);

      // Preprocess image for better OCR
      debugPrint('🔧 Preprocessing cropped image...');
      final processedImagePath = await _preprocessImage(imagePath);

      if (!mounted) return;
      setState(() => _progress = 0.8);

      // Perform OCR
      debugPrint('🔍 Performing OCR on processed image...');
      final extractedData = await _performOCR(processedImagePath);

      if (!mounted) return;
      setState(() => _progress = 1.0);

      if (extractedData.isNotEmpty) {
        debugPrint(
            '✅ Extracted ${extractedData.length} fields from cropped document');

        // Dispose camera before navigation to prevent crashes
        try {
          if (_cameraController != null &&
              _cameraController!.value.isInitialized) {
            debugPrint('📷 Disposing camera before navigation...');
            await _cameraController!.dispose();
            _cameraController = null;
          }
        } catch (e) {
          debugPrint('⚠️ Error disposing camera: $e');
        }

        // Reset processing state
        if (!mounted) return;
        setState(() {
          _isProcessing = false;
          _progress = 0.0;
        });

        // Small delay to ensure cleanup completes
        await Future.delayed(const Duration(milliseconds: 500));

        if (mounted) {
          // Navigate to registration with extracted data
          try {
            debugPrint(
                '🚀 Navigating to registration with ${extractedData.length} fields');
            context.push('/register', extra: {'scannedData': extractedData});
          } catch (navError) {
            debugPrint('❌ Navigation error: $navError');
            if (mounted) {
              setState(() {
                _errorMessage = 'Navigation failed. Please try again.';
              });
            }
          }
        }
      } else {
        debugPrint('⚠️ No data extracted from captured image');
        if (!mounted) return;
        setState(() {
          _errorMessage = _getErrorGuidance();
          _isProcessing = false;
          _progress = 0.0;
        });

        // Show a snackbar to inform the user
        if (mounted) {
          ScaffoldMessenger.of(context).showSnackBar(
            const SnackBar(
              content: Text(
                  'No data could be extracted. Please try again with better lighting.'),
              duration: Duration(seconds: 3),
            ),
          );
        }
      }
    } catch (e, stackTrace) {
      debugPrint('❌ Error processing captured image: $e');
      debugPrint('Stack trace: $stackTrace');
      if (!mounted) return;
      setState(() {
        _errorMessage = 'Processing failed: $e\nPlease try again.';
        _isProcessing = false;
        _progress = 0.0;
      });
    }
  }

  Future<String> _preprocessImage(String imagePath) async {
    try {
      debugPrint('🖼️ Preprocessing image: $imagePath');

      final imageBytes = await File(imagePath).readAsBytes();
      var image = img.decodeImage(imageBytes);

      if (image == null) {
        debugPrint('❌ Failed to decode image');
        return imagePath;
      }

      debugPrint('📐 Original size: ${image.width}x${image.height}');

      // Resize to smaller dimensions for better performance and memory usage
      if (image.width > 1200 || image.height > 1200) {
        image = img.copyResize(image, width: 1200);
        debugPrint('📏 Resized to: ${image.width}x${image.height}');
      } else if (image.width < 800 && image.height < 800) {
        image = img.copyResize(image, width: 800);
        debugPrint('📏 Upscaled to: ${image.width}x${image.height}');
      }

      // Convert to grayscale
      var enhanced = img.grayscale(image);
      debugPrint('🎨 Converted to grayscale');

      // Enhance contrast and brightness
      enhanced = img.adjustColor(
        enhanced,
        contrast: 2.0,
        brightness: 1.2,
      );
      debugPrint('✨ Enhanced contrast and brightness');

      // Apply sharpening
      enhanced = img.convolution(
        enhanced,
        filter: [
          -1,
          -1,
          -1,
          -1,
          9,
          -1,
          -1,
          -1,
          -1,
        ],
        div: 1,
      );
      debugPrint('🔪 Applied sharpening');

      // Adaptive threshold
      enhanced = _applyAdaptiveThreshold(enhanced);
      debugPrint('⚫ Applied adaptive thresholding');

      // Denoise
      enhanced = img.gaussianBlur(enhanced, radius: 1);
      debugPrint('🧹 Applied denoising');

      // Save enhanced image
      final enhancedPath = '${imagePath}_enhanced.jpg';
      await File(enhancedPath)
          .writeAsBytes(img.encodeJpg(enhanced, quality: 98));

      debugPrint('✅ Image preprocessing complete');
      return enhancedPath;
    } catch (e) {
      debugPrint('❌ Image preprocessing failed: $e');
      return imagePath;
    }
  }

  img.Image _applyAdaptiveThreshold(img.Image image) {
    // Calculate histogram
    final histogram = List<int>.filled(256, 0);
    for (int y = 0; y < image.height; y++) {
      for (int x = 0; x < image.width; x++) {
        final pixel = image.getPixel(x, y);
        histogram[pixel.r.toInt()]++;
      }
    }

    // Otsu's method
    int totalPixels = image.width * image.height;
    double sum = 0;
    for (int i = 0; i < 256; i++) {
      sum += i * histogram[i];
    }

    double sumB = 0;
    int wB = 0;
    int wF = 0;
    double maxVariance = 0;
    int threshold = 128;

    for (int i = 0; i < 256; i++) {
      wB += histogram[i];
      if (wB == 0) continue;

      wF = totalPixels - wB;
      if (wF == 0) break;

      sumB += i * histogram[i];
      double mB = sumB / wB;
      double mF = (sum - sumB) / wF;
      double variance = wB * wF * (mB - mF) * (mB - mF);

      if (variance > maxVariance) {
        maxVariance = variance;
        threshold = i;
      }
    }

    debugPrint('📈 Optimal threshold: $threshold');

    // Apply threshold
    final result = img.Image.from(image);
    for (int y = 0; y < result.height; y++) {
      for (int x = 0; x < result.width; x++) {
        final pixel = result.getPixel(x, y);
        final luminance = pixel.r.toInt();
        final newValue = luminance < threshold ? 0 : 255;
        result.setPixelRgba(x, y, newValue, newValue, newValue, 255);
      }
    }

    return result;
  }

  Future<Map<String, dynamic>> _performOCR(String imagePath) async {
    TextRecognizer? textRecognizer;
    try {
      debugPrint('🔍 Starting OCR processing...');

      final inputImage = InputImage.fromFilePath(imagePath);
      textRecognizer = TextRecognizer(script: TextRecognitionScript.latin);

      debugPrint('📸 Processing image with ML Kit...');
      final RecognizedText recognizedText =
          await textRecognizer.processImage(inputImage);

      final String text = recognizedText.text;
      final List<String> structuredLines = [];
      for (var block in recognizedText.blocks) {
        for (var line in block.lines) {
          structuredLines.add(line.text);
        }
      }

      debugPrint('📝 OCR Results:');
      debugPrint('  - Blocks: ${recognizedText.blocks.length}');
      debugPrint('  - Lines: ${structuredLines.length}');
      debugPrint('  - Total text length: ${text.length} characters');

      debugPrint('\n📋 First 15 lines:');
      for (int i = 0; i < structuredLines.length && i < 15; i++) {
        debugPrint('  $i: ${structuredLines[i]}');
      }

      // Close recognizer early to free resources
      await textRecognizer.close();
      textRecognizer = null;

      // MRZ-ONLY Extraction (Simplified)
      debugPrint('\n🔍 MRZ-ONLY Extraction...');
      
      // Extract MRZ from recognized text
      final data = await MRZHelper.extractFromMRZ(text);

      // Validate and clean
      if (data != null && data.isNotEmpty) {
        final cleanedData = _validateAndCleanData(data);
        debugPrint('\n✅ MRZ Data Extracted (${cleanedData.length} fields):');
        cleanedData.forEach((key, value) {
          debugPrint('  $key: $value');
        });
        return cleanedData;
      } else {
        debugPrint('\n❌ No MRZ found - ensure document MRZ zone is visible');
        return {};
      }
    } catch (e, stackTrace) {
      debugPrint('❌ OCR processing error: $e');
      debugPrint('Stack trace: $stackTrace');
      return {};
    } finally {
      // Ensure recognizer is always closed
      try {
        await textRecognizer?.close();
      } catch (e) {
        debugPrint('⚠️ Error closing text recognizer: $e');
      }
    }
  }

  Map<String, dynamic> _validateAndCleanData(Map<String, dynamic> data) {
    final cleaned = <String, dynamic>{};

    data.forEach((key, value) {
      if (value == null || value.toString().trim().isEmpty) return;

      var cleanValue = value.toString().trim();

      if (key == 'documentNumber') {
        cleanValue = cleanValue.replaceAll(RegExp(r'[^\w\-]'), '');
      }

      if (key == 'firstName' || key == 'lastName') {
        cleanValue = cleanValue.split(' ').map((word) {
          if (word.isEmpty) return '';
          return word[0].toUpperCase() + word.substring(1).toLowerCase();
        }).join(' ');
      }

      if (key == 'sex') {
        cleanValue = cleanValue.toUpperCase();
        if (cleanValue != 'M' && cleanValue != 'F') return;
      }

      if (key == 'nationality' || key == 'issuedCountry') {
        cleanValue = cleanValue.toUpperCase();
      }

      cleaned[key] = cleanValue;
    });

    return cleaned;
  }

  String _getErrorGuidance() {
    return '''Unable to extract data from the cropped document. 

📋 Tips for Better Results:
• Make sure the document text is clearly visible
• Include the entire document or MRZ zone in the crop
• Ensure good lighting (bright, even, no shadows)
• The document should be flat and in focus

🆔 For Passports & IDs:
• Include the bottom section with small text lines (MRZ zone)
• These lines look like: P<USA... or I<USA...

Would you like to try again or enter information manually?''';
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.black,
      appBar: AppBar(
        backgroundColor: Colors.transparent,
        leading: IconButton(
          icon: const Icon(Icons.arrow_back, color: Colors.white),
          onPressed: () => context.pop(),
        ),
        title: const Text(
          'Scan Document',
          style: TextStyle(color: Colors.white),
        ),
      ),
      body: _isCameraInitialized
          ? Stack(
              children: [
                // Camera Preview
                Positioned.fill(
                  child: CameraPreview(_cameraController!),
                ),

                // Corner Guides
                Positioned.fill(
                  child: CustomPaint(
                    painter: _CornerGuidesPainter(),
                  ),
                ),

                // Progress Indicator
                if (_isProcessing)
                  Positioned(
                    top: 20,
                    left: 20,
                    right: 20,
                    child: Column(
                      children: [
                        LinearProgressIndicator(
                          value: _progress,
                          backgroundColor: Colors.white.withOpacity(0.3),
                          valueColor: const AlwaysStoppedAnimation<Color>(
                              AppTheme.primaryOrange),
                        ),
                        const SizedBox(height: 8),
                        Container(
                          padding: const EdgeInsets.symmetric(
                              horizontal: 16, vertical: 8),
                          decoration: BoxDecoration(
                            color: Colors.black.withOpacity(0.7),
                            borderRadius: BorderRadius.circular(8),
                          ),
                          child: Text(
                            _getProgressText(),
                            style: const TextStyle(
                              color: Colors.white,
                              fontWeight: FontWeight.w600,
                            ),
                          ),
                        ),
                      ],
                    ),
                  ),

                // Error Message
                if (_errorMessage != null && !_isProcessing)
                  Positioned(
                    bottom: 140,
                    left: 20,
                    right: 20,
                    child: Container(
                      padding: const EdgeInsets.all(16),
                      decoration: BoxDecoration(
                        color: Colors.orange,
                        borderRadius: BorderRadius.circular(12),
                      ),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.stretch,
                        children: [
                          Text(
                            _errorMessage!,
                            style: const TextStyle(
                              color: Colors.white,
                              fontSize: 12,
                              height: 1.5,
                            ),
                          ),
                          const SizedBox(height: 12),
                          Row(
                            children: [
                              Expanded(
                                child: ElevatedButton(
                                  onPressed: () {
                                    setState(() => _errorMessage = null);
                                  },
                                  style: ElevatedButton.styleFrom(
                                    backgroundColor: Colors.white,
                                    foregroundColor: AppTheme.primaryOrange,
                                  ),
                                  child: const Text('Try Again'),
                                ),
                              ),
                              const SizedBox(width: 8),
                              Expanded(
                                child: ElevatedButton(
                                  onPressed: () {
                                    context.push('/register');
                                  },
                                  style: ElevatedButton.styleFrom(
                                    backgroundColor: Colors.white,
                                    foregroundColor: AppTheme.primaryOrange,
                                  ),
                                  child: const Text('Manual Entry'),
                                ),
                              ),
                            ],
                          ),
                        ],
                      ),
                    ),
                  ),

                // Instructions
                if (!_isProcessing)
                  Positioned(
                    top: 100,
                    left: 0,
                    right: 0,
                    child: Container(
                      margin: const EdgeInsets.symmetric(horizontal: 20),
                      padding: const EdgeInsets.all(16),
                      decoration: BoxDecoration(
                        color: Colors.black.withOpacity(0.7),
                        borderRadius: BorderRadius.circular(12),
                      ),
                      child: const Text(
                        '📸 Align the MRZ zone (bottom 2-3 lines)\n'
                        '🔍 MRZ contains all document details\n\n'
                        '� Ensure good lighting and flat document\n'
                        '� MRZ = Machine Readable Zone',
                        textAlign: TextAlign.center,
                        style: TextStyle(
                          color: Colors.white,
                          fontSize: 13,
                          height: 1.5,
                        ),
                      ),
                    ),
                  ),

                // Capture Button
                if (!_isProcessing)
                  Positioned(
                    bottom: 30,
                    left: 0,
                    right: 0,
                    child: Center(
                      child: Column(
                        children: [
                          GestureDetector(
                            onTap: _capturePhoto,
                            child: Container(
                              width: 70,
                              height: 70,
                              decoration: BoxDecoration(
                                shape: BoxShape.circle,
                                color: AppTheme.primaryOrange,
                                boxShadow: [
                                  BoxShadow(
                                    color:
                                        AppTheme.primaryOrange.withOpacity(0.5),
                                    blurRadius: 20,
                                    spreadRadius: 5,
                                  ),
                                ],
                              ),
                              child: const Icon(
                                Icons.camera,
                                color: Colors.white,
                                size: 32,
                              ),
                            ),
                          ),
                          const SizedBox(height: 12),
                          const Text(
                            'Tap to Capture',
                            style: TextStyle(
                              color: Colors.white,
                              fontSize: 14,
                              fontWeight: FontWeight.w600,
                            ),
                          ),
                        ],
                      ),
                    ),
                  ),
              ],
            )
          : Center(
              child: _errorMessage != null
                  ? Column(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        const Icon(Icons.error_outline,
                            size: 64, color: Colors.red),
                        const SizedBox(height: 16),
                        Text(
                          _errorMessage!,
                          style: const TextStyle(color: Colors.white),
                          textAlign: TextAlign.center,
                        ),
                      ],
                    )
                  : const CircularProgressIndicator(
                      valueColor:
                          AlwaysStoppedAnimation<Color>(AppTheme.primaryOrange),
                    ),
            ),
    );
  }

  String _getProgressText() {
    if (_progress < 0.5) {
      return 'Capturing photo... ${(_progress * 100).toInt()}%';
    } else if (_progress < 0.7) {
      return 'Preprocessing image...';
    } else if (_progress < 0.9) {
      return 'Extracting MRZ data... ${(_progress * 100).toInt()}%';
    } else {
      return 'Finalizing... ${(_progress * 100).toInt()}%';
    }
  }
}

class _CornerGuidesPainter extends CustomPainter {
  @override
  void paint(Canvas canvas, Size size) {
    final paint = Paint()
      ..color = AppTheme.primaryOrange
      ..strokeWidth = 4
      ..style = PaintingStyle.stroke;

    const cornerLength = 40.0;
    const margin = 40.0;

    // Top-left
    canvas.drawLine(
      const Offset(margin, margin),
      const Offset(margin + cornerLength, margin),
      paint,
    );
    canvas.drawLine(
      const Offset(margin, margin),
      const Offset(margin, margin + cornerLength),
      paint,
    );

    // Top-right
    canvas.drawLine(
      Offset(size.width - margin - cornerLength, margin),
      Offset(size.width - margin, margin),
      paint,
    );
    canvas.drawLine(
      Offset(size.width - margin, margin),
      Offset(size.width - margin, margin + cornerLength),
      paint,
    );

    // Bottom-left
    canvas.drawLine(
      Offset(margin, size.height - margin - cornerLength),
      Offset(margin, size.height - margin),
      paint,
    );
    canvas.drawLine(
      Offset(margin, size.height - margin),
      Offset(margin + cornerLength, size.height - margin),
      paint,
    );

    // Bottom-right
    canvas.drawLine(
      Offset(size.width - margin - cornerLength, size.height - margin),
      Offset(size.width - margin, size.height - margin),
      paint,
    );
    canvas.drawLine(
      Offset(size.width - margin, size.height - margin - cornerLength),
      Offset(size.width - margin, size.height - margin),
      paint,
    );
  }

  @override
  bool shouldRepaint(covariant CustomPainter oldDelegate) => false;
}
