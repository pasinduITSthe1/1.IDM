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
      debugPrint('🖼️ Preprocessing image: $imagePath');

      // Read and decode image
      final imageBytes = await File(imagePath).readAsBytes();
      var image = img.decodeImage(imageBytes);

      if (image == null) {
        debugPrint('❌ Failed to decode image');
        return imagePath;
      }

      debugPrint('📐 Original size: ${image.width}x${image.height}');

      // Resize to optimal dimensions for OCR (improves accuracy and speed)
      // Higher resolution helps with MRZ zones which have small text
      if (image.width > 2400 || image.height > 2400) {
        image = img.copyResize(image, width: 2400);
        debugPrint('📏 Resized to: ${image.width}x${image.height}');
      } else if (image.width < 1200 && image.height < 1200) {
        // Upscale if too small
        image = img.copyResize(image, width: 1600);
        debugPrint('📏 Upscaled to: ${image.width}x${image.height}');
      }

      // Convert to grayscale for better text recognition
      var enhanced = img.grayscale(image);
      debugPrint('🎨 Converted to grayscale');

      // Enhance contrast and brightness for better text separation
      // Higher values work better for MRZ zones
      enhanced = img.adjustColor(
        enhanced,
        contrast: 2.0, // Increased for sharper text
        brightness: 1.2, // Slight brightness boost
      );
      debugPrint('✨ Applied contrast and brightness enhancement');

      // Apply sharpening to make text edges more defined
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
      debugPrint('🔪 Applied sharpening filter');

      // Apply adaptive threshold for crisp black/white text
      // This is crucial for MRZ recognition
      enhanced = _applyAdaptiveThreshold(enhanced);
      debugPrint('⚫ Applied adaptive thresholding');

      // Denoise to remove artifacts
      enhanced = img.gaussianBlur(enhanced, radius: 1);
      debugPrint('🧹 Applied denoising');

      // Save enhanced image with high quality
      final enhancedPath = '${imagePath}_enhanced.jpg';
      await File(enhancedPath)
          .writeAsBytes(img.encodeJpg(enhanced, quality: 98));

      debugPrint('✅ Image preprocessing complete: $enhancedPath');
      return enhancedPath;
    } catch (e) {
      debugPrint('❌ Image preprocessing failed: $e');
      return imagePath; // Return original on failure
    }
  }

  // Apply adaptive threshold to improve text clarity
  // Uses Otsu's method approximation for better results
  img.Image _applyAdaptiveThreshold(img.Image image) {
    debugPrint('📊 Calculating threshold...');

    // Calculate histogram
    final histogram = List<int>.filled(256, 0);
    for (int y = 0; y < image.height; y++) {
      for (int x = 0; x < image.width; x++) {
        final pixel = image.getPixel(x, y);
        histogram[pixel.r.toInt()]++;
      }
    }

    // Calculate optimal threshold using Otsu's method (simplified)
    int totalPixels = image.width * image.height;
    double sum = 0;
    for (int i = 0; i < 256; i++) {
      sum += i * histogram[i];
    }

    double sumB = 0;
    int wB = 0;
    int wF = 0;
    double maxVariance = 0;
    int threshold = 128; // Default

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
    try {
      debugPrint('🔍 Starting OCR processing...');

      final inputImage = InputImage.fromFilePath(imagePath);
      final textRecognizer =
          TextRecognizer(script: TextRecognitionScript.latin);

      final RecognizedText recognizedText =
          await textRecognizer.processImage(inputImage);

      // Get full text
      final String text = recognizedText.text;

      // Get structured text (preserves line breaks better for MRZ)
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

      // Print first few lines for debugging
      debugPrint('\n📋 First 10 lines:');
      for (int i = 0; i < structuredLines.length && i < 10; i++) {
        debugPrint('  $i: ${structuredLines[i]}');
      }

      // Close recognizer
      textRecognizer.close();

      Map<String, dynamic>? data;

      // Strategy 1: Try MRZ extraction first (most accurate for passports/IDs)
      debugPrint('\n🔍 Strategy 1: MRZ extraction from full text...');
      data = OCRHelper.extractMRZ(text);

      // Strategy 2: Try MRZ with structured lines (better line preservation)
      if (data == null || data.length < 3) {
        debugPrint('\n🔍 Strategy 2: MRZ extraction from structured lines...');
        final structuredText = structuredLines.join('\n');
        data = OCRHelper.extractMRZ(structuredText);
      }

      // Strategy 3: Try MRZ with cleaned lines (remove noise)
      if (data == null || data.length < 3) {
        debugPrint('\n🔍 Strategy 3: MRZ extraction with cleaned lines...');
        final cleanedLines = structuredLines
            .map((l) => l.replaceAll(RegExp(r'[^A-Z0-9<\s]'), ''))
            .where((l) => l.trim().isNotEmpty)
            .join('\n');
        data = OCRHelper.extractMRZ(cleanedLines);
      }

      // Strategy 4: Fallback to general OCR pattern matching
      if (data == null || data.length < 3) {
        debugPrint('\n🔍 Strategy 4: OCR pattern matching...');
        final ocrData = OCRHelper.extractDataFromOCR(text);

        if (ocrData != null && ocrData.isNotEmpty) {
          // Merge with existing data if any
          if (data != null && data.isNotEmpty) {
            ocrData.forEach((key, value) {
              if (!data!.containsKey(key) ||
                  data[key] == null ||
                  data[key].toString().isEmpty) {
                data[key] = value;
              }
            });
            debugPrint('✅ Merged MRZ and OCR data');
          } else {
            data = ocrData;
            debugPrint('✅ Used OCR data');
          }
        }
      }

      // Strategy 5: Try OCR on structured lines separately
      if (data == null || data.length < 2) {
        debugPrint(
            '\n🔍 Strategy 5: OCR pattern matching on structured lines...');
        final structuredText = structuredLines.join('\n');
        final ocrData = OCRHelper.extractDataFromOCR(structuredText);

        if (ocrData != null && ocrData.length > (data?.length ?? 0)) {
          data = ocrData;
          debugPrint('✅ Better result from structured text');
        }
      }

      // Validate and clean the data
      if (data != null && data.isNotEmpty) {
        data = _validateAndCleanData(data);
        debugPrint('\n✅ Final Extracted Data (${data.length} fields):');
        data.forEach((key, value) {
          debugPrint('  $key: $value');
        });
      } else {
        debugPrint('\n❌ No data could be extracted');
      }

      return data ?? {};
    } catch (e) {
      debugPrint('❌ OCR processing error: $e');
      return {};
    }
  }

  // Validate and clean extracted data
  Map<String, dynamic> _validateAndCleanData(Map<String, dynamic> data) {
    final cleaned = <String, dynamic>{};

    data.forEach((key, value) {
      if (value == null || value.toString().trim().isEmpty) return;

      var cleanValue = value.toString().trim();

      // Clean up specific fields
      if (key == 'documentNumber') {
        // Remove any remaining special characters except hyphens
        cleanValue = cleanValue.replaceAll(RegExp(r'[^\w\-]'), '');
      }

      if (key == 'firstName' || key == 'lastName') {
        // Capitalize properly
        cleanValue = cleanValue.split(' ').map((word) {
          if (word.isEmpty) return '';
          return word[0].toUpperCase() + word.substring(1).toLowerCase();
        }).join(' ');
      }

      if (key == 'sex') {
        // Ensure only M or F
        cleanValue = cleanValue.toUpperCase();
        if (cleanValue != 'M' && cleanValue != 'F') return;
      }

      if (key == 'nationality' || key == 'issuedCountry') {
        // Uppercase country codes
        cleanValue = cleanValue.toUpperCase();
      }

      cleaned[key] = cleanValue;
    });

    return cleaned;
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
