import 'dart:io';
import 'package:flutter/material.dart';
import 'package:camera/camera.dart';
import 'package:go_router/go_router.dart';
import 'package:google_mlkit_text_recognition/google_mlkit_text_recognition.dart';
import 'package:image/image.dart' as img;
import '../utils/app_theme.dart';
import '../utils/ocr_helper.dart';

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
        ResolutionPreset.high,
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

  Future<void> _captureAndProcess() async {
    if (_isProcessing ||
        _cameraController == null ||
        !_cameraController!.value.isInitialized) {
      return;
    }

    setState(() {
      _isProcessing = true;
      _progress = 0.1;
      _errorMessage = null;
    });

    try {
      // Capture image
      final XFile imageFile = await _cameraController!.takePicture();
      setState(() => _progress = 0.3);

      // Preprocess image
      final processedImagePath = await _preprocessImage(imageFile.path);
      setState(() => _progress = 0.5);

      // Perform OCR
      final extractedData = await _performOCR(processedImagePath);
      setState(() => _progress = 0.9);

      if (extractedData.isNotEmpty) {
        setState(() => _progress = 1.0);
        if (mounted) {
          context.push('/register', extra: {'scannedData': extractedData});
        }
      } else {
        setState(() {
          _errorMessage = _getErrorGuidance();
          _progress = 0.0;
        });
      }
    } catch (e) {
      setState(() {
        _errorMessage =
            'Scanning failed: $e\nPlease try again with better lighting.';
        _progress = 0.0;
      });
    } finally {
      setState(() => _isProcessing = false);
    }
  }

  Future<String> _preprocessImage(String imagePath) async {
    try {
      // Read and decode image
      final imageBytes = await File(imagePath).readAsBytes();
      var image = img.decodeImage(imageBytes);

      if (image == null) return imagePath;

      // Resize if too large (improves processing speed and quality)
      if (image.width > 1920 || image.height > 1920) {
        image = img.copyResize(image, width: 1920);
      }

      // Convert to grayscale for better text recognition
      var enhanced = img.grayscale(image);

      // Increase contrast significantly for better text separation
      enhanced = img.adjustColor(
        enhanced,
        contrast: 1.8,
        brightness: 1.15,
      );

      // Apply sharpening to make text edges clearer
      enhanced = img.adjustColor(
        enhanced,
        contrast: 1.2,
      );

      // Optional: Apply threshold for very clear black/white text
      // This helps with low contrast documents
      enhanced = _applyAdaptiveThreshold(enhanced);

      // Save enhanced image
      final enhancedPath = '${imagePath}_enhanced.jpg';
      await File(enhancedPath)
          .writeAsBytes(img.encodeJpg(enhanced, quality: 95));

      debugPrint('Image preprocessed: ${image.width}x${image.height}');
      return enhancedPath;
    } catch (e) {
      debugPrint('Image preprocessing failed: $e');
      return imagePath; // Return original on failure
    }
  }

  // Apply adaptive threshold to improve text clarity
  img.Image _applyAdaptiveThreshold(img.Image image) {
    final threshold = img.Image.from(image);
    
    for (int y = 0; y < threshold.height; y++) {
      for (int x = 0; x < threshold.width; x++) {
        final pixel = threshold.getPixel(x, y);
        final luminance = pixel.r;
        
        // If pixel is darker than threshold, make it black; otherwise white
        // This creates high contrast for text
        final newValue = luminance < 128 ? 0 : 255;
        threshold.setPixelRgba(x, y, newValue, newValue, newValue, 255);
      }
    }
    
    return threshold;
  }

  Future<Map<String, dynamic>> _performOCR(String imagePath) async {
    try {
      final inputImage = InputImage.fromFilePath(imagePath);
      final textRecognizer =
          TextRecognizer(script: TextRecognitionScript.latin);

      final RecognizedText recognizedText =
          await textRecognizer.processImage(inputImage);
      
      // Get full text
      final String text = recognizedText.text;
      
      // Also get structured blocks for better analysis
      final List<String> structuredText = [];
      for (var block in recognizedText.blocks) {
        for (var line in block.lines) {
          structuredText.add(line.text);
        }
      }

      debugPrint('📝 OCR Text Result (${recognizedText.blocks.length} blocks):');
      debugPrint(text);
      debugPrint('\n📋 Structured Lines (${structuredText.length}):');
      debugPrint(structuredText.join('\n'));

      // Close recognizer
      textRecognizer.close();

      Map<String, dynamic>? data;

      // Try MRZ detection first (most reliable for passports/IDs)
      data = OCRHelper.extractMRZ(text);
      
      if (data != null && data.isNotEmpty) {
        debugPrint('✅ Data extracted via MRZ');
      } else {
        // Try with structured text
        final structuredFullText = structuredText.join('\n');
        data = OCRHelper.extractMRZ(structuredFullText);
        
        if (data != null && data.isNotEmpty) {
          debugPrint('✅ Data extracted via MRZ (structured)');
        }
      }

      // Fallback to general OCR patterns
      if (data == null || data.isEmpty || data.length < 3) {
        debugPrint('⚠️ MRZ extraction failed or incomplete, trying OCR patterns...');
        final ocrData = OCRHelper.extractDataFromOCR(text);
        
        if (ocrData != null && ocrData.isNotEmpty) {
          // Merge MRZ data with OCR data (OCR data fills in missing fields)
          if (data != null && data.isNotEmpty) {
            ocrData.forEach((key, value) {
              if (!data!.containsKey(key) || data[key] == null || data[key].toString().isEmpty) {
                data[key] = value;
              }
            });
          } else {
            data = ocrData;
          }
          debugPrint('✅ Data extracted/enhanced via OCR patterns');
        }
      }

      debugPrint('✅ Final Extracted Data: $data');
      return data ?? {};
    } catch (e) {
      debugPrint('❌ OCR processing error: $e');
      return {};
    }
  }

  String _getErrorGuidance() {
    return '''Unable to automatically extract data from this document. For better results:

📋 Document Positioning:
• Lay the document flat on a table (avoid holding by hand)
• Fill the camera frame with the document (get closer)
• Keep the document straight (not rotated or tilted)

💡 Lighting & Quality:
• Use bright, even lighting (avoid shadows or glare)
• Ensure all text is sharp and clearly readable
• Clean the camera lens if image appears blurry

🆔 Document Types:
• For ID Cards: Make sure all text fields are visible
• For Passports: Include the machine-readable zone (MRZ) at the bottom
• Avoid damaged or worn documents when possible

📱 Technical Tips:
• Hold the phone steady for 2-3 seconds
• Try landscape orientation for wider documents
• If scanning fails repeatedly, you can manually enter the information

Would you like to try scanning again or proceed with manual entry?''';
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
                        Text(
                          'Processing... ${(_progress * 100).toInt()}%',
                          style: const TextStyle(
                            color: Colors.white,
                            fontWeight: FontWeight.w600,
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
                Positioned(
                  top: 100,
                  left: 0,
                  right: 0,
                  child: Container(
                    margin: const EdgeInsets.symmetric(horizontal: 20),
                    padding: const EdgeInsets.all(16),
                    decoration: BoxDecoration(
                      color: Colors.black.withOpacity(0.6),
                      borderRadius: BorderRadius.circular(12),
                    ),
                    child: const Text(
                      '📸 Position the ID/Passport within the frame\n'
                      '💡 Ensure good lighting and clear text\n'
                      '📱 Hold steady and tap the button',
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
                Positioned(
                  bottom: 30,
                  left: 0,
                  right: 0,
                  child: Center(
                    child: GestureDetector(
                      onTap: _isProcessing ? null : _captureAndProcess,
                      child: Container(
                        width: 70,
                        height: 70,
                        decoration: BoxDecoration(
                          shape: BoxShape.circle,
                          color: _isProcessing
                              ? Colors.grey
                              : AppTheme.primaryOrange,
                          boxShadow: [
                            BoxShadow(
                              color: AppTheme.primaryOrange.withOpacity(0.5),
                              blurRadius: 20,
                              spreadRadius: 5,
                            ),
                          ],
                        ),
                        child: Icon(
                          _isProcessing ? Icons.hourglass_empty : Icons.camera,
                          color: Colors.white,
                          size: 32,
                        ),
                      ),
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
