import 'dart:io';
import 'package:flutter/material.dart';
import 'package:camera/camera.dart';
import 'package:go_router/go_router.dart';
import 'package:image/image.dart' as img;
import '../utils/app_theme.dart';
import '../utils/production_mrz_scanner.dart'; // Production MRZ scanner
import '../utils/dual_ocr_engine.dart'; // Dual OCR Engine (ML Kit + Tesseract)

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
  double _currentZoom = 1.0;
  double _minZoom = 1.0;
  double _maxZoom = 8.0;

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

      // Get zoom limits
      _minZoom = await _cameraController!.getMinZoomLevel();
      _maxZoom = await _cameraController!.getMaxZoomLevel();

      if (mounted) {
        setState(() => _isCameraInitialized = true);
      }
    } catch (e) {
      setState(() => _errorMessage = 'Failed to initialize camera: $e');
    }
  }

  // Zoom control methods
  Future<void> _setZoom(double zoom) async {
    if (_cameraController == null || !_cameraController!.value.isInitialized) {
      return;
    }

    final clampedZoom = zoom.clamp(_minZoom, _maxZoom);
    await _cameraController!.setZoomLevel(clampedZoom);
    setState(() => _currentZoom = clampedZoom);
  }

  void _cycleZoom() {
    if (_currentZoom == 1.0) {
      _setZoom(2.0);
    } else if (_currentZoom == 2.0) {
      _setZoom(3.0);
    } else {
      _setZoom(1.0);
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
      setState(() => _progress = 0.5);

      // APK STRATEGY 1: Crop MRZ zone FIRST (bottom 30-40% of image)
      // This speeds up OCR by 33% and improves accuracy
      debugPrint('✂️ Cropping MRZ zone (APK strategy)...');
      final mrzCroppedPath = await _cropMRZZone(imagePath);

      if (!mounted) return;
      setState(() => _progress = 0.6);

      // Preprocess image for better OCR
      debugPrint('🔧 Preprocessing MRZ zone image...');
      final processedImagePath = await _preprocessImage(mrzCroppedPath);

      if (!mounted) return;
      setState(() => _progress = 0.7);

      // Perform OCR on BOTH original and processed images
      debugPrint('🔍 Performing OCR on processed image...');
      var extractedData = await _performOCR(processedImagePath);

      // If processed image failed, try original image
      if (extractedData.isEmpty) {
        debugPrint('⚠️ Processed image OCR failed, trying original...');
        setState(() => _progress = 0.85);
        extractedData = await _performOCR(imagePath);
      }

      if (!mounted) return;
      setState(() => _progress = 1.0);

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
            debugPrint('🔍 Data to be passed:');
            extractedData.forEach((key, value) {
              debugPrint('  📋 $key: $value');
            });
            debugPrint(
                '🔗 Navigation extra: ${{'scannedData': extractedData}}');
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

  /// APK STRATEGY: Crop MRZ zone (bottom 30-40%) before OCR
  /// This is CRITICAL for speed and accuracy
  Future<String> _cropMRZZone(String imagePath) async {
    try {
      debugPrint('📐 APK MRZ Zone Cropping...');

      final imageBytes = await File(imagePath).readAsBytes();
      var image = img.decodeImage(imageBytes);

      if (image == null) {
        debugPrint('❌ Failed to decode image for cropping');
        return imagePath;
      }

      final originalHeight = image.height;
      final originalWidth = image.width;
      debugPrint('Original: ${originalWidth}x${originalHeight}');

      // APK MOTION DETECTION: Check if image is blurry
      final isBlurry = _detectMotionBlur(image);
      if (isBlurry) {
        debugPrint('⚠️ MOTION DETECTED - Image too blurry!');
        throw Exception('Image is blurry. Please hold still and try again.');
      }
      debugPrint('✅ Motion check passed - Image is sharp');

      // APK crops bottom 30-40% of image (where MRZ is located)
      // MRZ is ALWAYS at the bottom of passports/IDs
      final cropPercentage = 0.35; // 35% from bottom
      final cropHeight = (originalHeight * cropPercentage).round();
      final cropY = originalHeight - cropHeight;

      debugPrint(
          'Cropping: bottom ${(cropPercentage * 100).toInt()}% (${cropHeight}px)');

      // Crop the MRZ zone
      image = img.copyCrop(
        image,
        x: 0,
        y: cropY,
        width: originalWidth,
        height: cropHeight,
      );

      debugPrint('✅ MRZ Zone cropped: ${image.width}x${image.height}');

      // Save cropped image
      final croppedPath = '${imagePath}_mrz_zone.jpg';
      await File(croppedPath).writeAsBytes(
        img.encodeJpg(image, quality: 95),
      );

      return croppedPath;
    } catch (e) {
      debugPrint('❌ MRZ zone cropping failed: $e');
      // If it's a blur error, rethrow it so user sees the message
      if (e.toString().contains('blurry')) {
        rethrow;
      }
      return imagePath; // Fallback to original
    }
  }

  /// APK MOTION DETECTION: Detect blur/motion using Laplacian variance
  /// (OpenCV approach - measures image sharpness)
  bool _detectMotionBlur(img.Image image) {
    debugPrint('🔍 Checking for motion blur...');

    // Sample center region (MRZ zone area)
    final sampleHeight = (image.height * 0.3).round();
    final sampleY = image.height - sampleHeight;
    final sampleRegion = img.copyCrop(
      image,
      x: 0,
      y: sampleY,
      width: image.width,
      height: sampleHeight,
    );

    // Calculate Laplacian variance (blur metric)
    // Lower variance = more blur
    double variance = 0;
    int count = 0;
    final step = 5; // Sample every 5th pixel for speed

    for (int y = 1; y < sampleRegion.height - 1; y += step) {
      for (int x = 1; x < sampleRegion.width - 1; x += step) {
        // Get pixel and neighbors
        final center = img.getLuminance(sampleRegion.getPixel(x, y));
        final top = img.getLuminance(sampleRegion.getPixel(x, y - 1));
        final bottom = img.getLuminance(sampleRegion.getPixel(x, y + 1));
        final left = img.getLuminance(sampleRegion.getPixel(x - 1, y));
        final right = img.getLuminance(sampleRegion.getPixel(x + 1, y));

        // Laplacian: center*4 - (top + bottom + left + right)
        final laplacian = (center * 4 - top - bottom - left - right).abs();
        variance += laplacian * laplacian;
        count++;
      }
    }

    variance = variance / count;
    debugPrint('📊 Blur variance: ${variance.toStringAsFixed(2)}');

    // APK threshold: variance < 100 = too blurry
    // Higher threshold = more strict blur detection
    final isBlurry = variance < 150; // Adjusted for mobile cameras

    if (isBlurry) {
      debugPrint('❌ Image variance too low - BLURRY!');
    } else {
      debugPrint('✅ Image variance good - SHARP!');
    }

    return isBlurry;
  }

  Future<String> _preprocessImage(String imagePath) async {
    try {
      debugPrint('🖼️ MRZ-optimized preprocessing: $imagePath');

      final imageBytes = await File(imagePath).readAsBytes();
      var image = img.decodeImage(imageBytes);

      if (image == null) {
        debugPrint('❌ Failed to decode image');
        return imagePath;
      }

      debugPrint('📐 Original size: ${image.width}x${image.height}');

      // PRODUCTION MRZ OPTIMIZATION: Ideal size for MRZ recognition
      // MRZ works best at specific resolutions - not too big, not too small
      final targetWidth = 1200;
      final targetHeight = (image.height * targetWidth / image.width).round();

      image = img.copyResize(image, width: targetWidth, height: targetHeight);
      debugPrint('📏 MRZ-optimized resize: ${image.width}x${image.height}');

      // STEP 1: Convert to grayscale for better OCR
      image = img.grayscale(image);
      debugPrint('🎨 Converted to grayscale');

      // STEP 2: APK-style contrast enhancement (OpenCV approach)
      // APK uses OpenCV's CLAHE (Contrast Limited Adaptive Histogram Equalization)
      // We simulate this with stronger contrast and brightness
      image = img.adjustColor(
        image,
        contrast: 3.0, // APK uses aggressive contrast for MRZ
        brightness: 1.15, // Slightly higher brightness
        saturation: 0.0, // Full desaturation (grayscale)
      );
      debugPrint('✨ APK-style contrast enhancement applied');

      // STEP 3: Noise reduction BEFORE sharpening (APK does this)
      // Light blur removes camera noise without losing text edges
      image = img.gaussianBlur(image, radius: 1);
      debugPrint('🧹 Pre-sharpening noise reduction');

      // STEP 4: Advanced sharpening - APK uses OpenCV's sharpen filter
      // This makes MRZ characters crystal clear
      image = img.convolution(
        image,
        filter: [
          -1, -1, -1,
          -1, 10, -1, // Stronger kernel (10 instead of 9)
          -1, -1, -1,
        ],
        div: 2, // Divide by 2 to prevent over-sharpening
      );
      debugPrint('🔪 APK-style advanced sharpening');

      // STEP 5: Adaptive binary thresholding (OpenCV approach)
      // This creates pure black/white image optimal for OCR
      image = _applyAPKThreshold(image);
      debugPrint('⚫ APK-style adaptive thresholding applied');

      // Save enhanced image with maximum quality for MRZ
      final enhancedPath = '${imagePath}_mrz_enhanced.jpg';
      await File(enhancedPath).writeAsBytes(
          img.encodeJpg(image, quality: 100)); // Maximum quality for MRZ

      debugPrint('✅ MRZ preprocessing complete');
      return enhancedPath;
    } catch (e) {
      debugPrint('❌ MRZ preprocessing failed: $e');
      return imagePath;
    }
  }

  /// APK-style adaptive thresholding (OpenCV approach)
  /// Creates pure black/white image optimal for Tesseract OCR
  img.Image _applyAPKThreshold(img.Image image) {
    debugPrint('🎯 APK adaptive thresholding...');

    // Calculate optimal threshold using Otsu's method (similar to OpenCV)
    final pixels = <int>[];
    for (int y = 0; y < image.height; y++) {
      for (int x = 0; x < image.width; x++) {
        final pixel = image.getPixel(x, y);
        pixels.add(img.getLuminance(pixel).toInt());
      }
    }

    // Calculate histogram
    final histogram = List.filled(256, 0);
    for (var p in pixels) {
      histogram[p]++;
    }

    // Otsu's method for optimal threshold
    final total = pixels.length;
    double sum = 0;
    for (int i = 0; i < 256; i++) {
      sum += i * histogram[i];
    }

    double sumB = 0;
    int wB = 0;
    int wF = 0;
    double varMax = 0;
    int threshold = 0;

    for (int i = 0; i < 256; i++) {
      wB += histogram[i];
      if (wB == 0) continue;

      wF = total - wB;
      if (wF == 0) break;

      sumB += i * histogram[i];
      final mB = sumB / wB;
      final mF = (sum - sumB) / wF;
      final varBetween = wB * wF * (mB - mF) * (mB - mF);

      if (varBetween > varMax) {
        varMax = varBetween;
        threshold = i;
      }
    }

    debugPrint('📊 APK Otsu threshold: $threshold (optimal)');

    // Apply binary threshold (like OpenCV's THRESH_BINARY)
    for (int y = 0; y < image.height; y++) {
      for (int x = 0; x < image.width; x++) {
        final pixel = image.getPixel(x, y);
        final luminance = img.getLuminance(pixel);
        final newValue = luminance > threshold ? 255 : 0;
        image.setPixel(x, y, img.ColorRgb8(newValue, newValue, newValue));
      }
    }

    return image;
  }

  Future<Map<String, dynamic>> _performOCR(String imagePath) async {
    try {
      debugPrint('🔍 Starting DUAL OCR processing (ML Kit + Tesseract)...');

      // USE DUAL OCR ENGINE - Combines ML Kit + Tesseract for best results
      final ocrResult = await DualOCREngine.extractWithAnalytics(imagePath);

      debugPrint('\n� Dual OCR Analytics:');
      debugPrint(ocrResult.toString());

      final text = ocrResult.text;

      if (text.isEmpty || text.length < 20) {
        debugPrint('❌ WARNING: No text detected by either OCR engine!');
        debugPrint('   This usually means:');
        debugPrint('   1. Image too dark/blurry');
        debugPrint('   2. Document not in frame');
        debugPrint('   3. MRZ not visible');
        return {};
      }

      // Show full text for debugging
      debugPrint('\n📄 Combined OCR Text (${text.length} chars):\n$text\n');

      // PRODUCTION MRZ EXTRACTION (Maximum Accuracy)
      debugPrint('\n🏭 Using Production MRZ Scanner...');

      // Primary extraction attempt with merged text
      var data = await ProductionMRZScanner.extractMRZData(text);

      if (data != null && data.isNotEmpty) {
        debugPrint('✅ Production MRZ extraction successful (merged text)');
      } else {
        debugPrint('⚠️ Merged text failed, trying ML Kit text only...');

        // Fallback 1: Try ML Kit text only
        data = await ProductionMRZScanner.extractMRZData(ocrResult.mlKitText);

        if (data == null || data.isEmpty) {
          debugPrint('🔄 ML Kit failed, trying Tesseract text only...');

          // Fallback 2: Try Tesseract text only
          data = await ProductionMRZScanner.extractMRZData(
              ocrResult.tesseractText);

          if (data == null || data.isEmpty) {
            // Fallback 3: Try bottom portion of best text
            debugPrint('🔄 Trying bottom lines from best OCR result...');
            final bestText =
                ocrResult.mlKitConfidence > ocrResult.tesseractConfidence
                    ? ocrResult.mlKitText
                    : ocrResult.tesseractText;
            final lines = bestText.split('\n');
            final bottomLines = lines.length >= 5
                ? lines.sublist(lines.length - 5).join('\n')
                : bestText;
            data = await ProductionMRZScanner.extractMRZData(bottomLines);
          }
        }
      }

      // Convert to non-nullable Map
      final extractedData = data ?? <String, dynamic>{};

      // Validate and clean
      if (extractedData.isNotEmpty) {
        final cleanedData = _validateAndCleanData(extractedData);
        debugPrint(
            '\n✅ Production MRZ Data Extracted (${cleanedData.length} fields):');
        cleanedData.forEach((key, value) {
          debugPrint('  $key: $value');
        });

        // Add OCR metadata
        cleanedData['ocrEngine'] = ocrResult.bestEngine;
        cleanedData['ocrConfidence'] = ocrResult.bestEngine == 'ML Kit'
            ? ocrResult.mlKitConfidence
            : ocrResult.tesseractConfidence;

        return cleanedData;
      } else {
        debugPrint(
            '\n❌ No MRZ data found - ensure document MRZ zone is clearly visible');
        debugPrint('Tried both ML Kit and Tesseract OCR engines');
        return {};
      }
    } catch (e, stackTrace) {
      debugPrint('❌ OCR processing error: $e');
      debugPrint('Stack trace: $stackTrace');
      return {};
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

                // MRZ Scanning Guide Box
                Positioned.fill(
                  child: CustomPaint(
                    painter: _MRZScanningGuidePainter(),
                  ),
                ),

                // MRZ Zone Indicator (Bottom Box)
                if (!_isProcessing)
                  Positioned(
                    bottom: 200,
                    left: 20,
                    right: 20,
                    child: Container(
                      height: 120,
                      decoration: BoxDecoration(
                        border: Border.all(
                          color: AppTheme.primaryOrange,
                          width: 3,
                        ),
                        borderRadius: BorderRadius.circular(12),
                      ),
                      child: Stack(
                        children: [
                          // Corner brackets
                          Positioned(
                            top: 0,
                            left: 0,
                            child: _buildCornerBracket(
                                alignment: Alignment.topLeft),
                          ),
                          Positioned(
                            top: 0,
                            right: 0,
                            child: _buildCornerBracket(
                                alignment: Alignment.topRight),
                          ),
                          Positioned(
                            bottom: 0,
                            left: 0,
                            child: _buildCornerBracket(
                                alignment: Alignment.bottomLeft),
                          ),
                          Positioned(
                            bottom: 0,
                            right: 0,
                            child: _buildCornerBracket(
                                alignment: Alignment.bottomRight),
                          ),
                          // Center label
                          Center(
                            child: Container(
                              padding: const EdgeInsets.symmetric(
                                  horizontal: 16, vertical: 8),
                              decoration: BoxDecoration(
                                color: AppTheme.primaryOrange,
                                borderRadius: BorderRadius.circular(20),
                              ),
                              child: const Text(
                                'Align MRZ Zone Here',
                                style: TextStyle(
                                  color: Colors.white,
                                  fontWeight: FontWeight.bold,
                                  fontSize: 14,
                                ),
                              ),
                            ),
                          ),
                        ],
                      ),
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
                        '🎯 Position document MRZ in the orange box\n'
                        '� MRZ = Bottom 2-3 lines with <<<< symbols\n'
                        '💡 Keep document flat and well-lit\n'
                        '✨ Focus on the MRZ zone for best results',
                        textAlign: TextAlign.center,
                        style: TextStyle(
                          color: Colors.white,
                          fontSize: 13,
                          height: 1.5,
                          fontWeight: FontWeight.w500,
                        ),
                      ),
                    ),
                  ),

                // Zoom Controls (Bottom Right)
                if (!_isProcessing)
                  Positioned(
                    bottom: 100,
                    right: 20,
                    child: Column(
                      children: [
                        // Flash toggle
                        GestureDetector(
                          onTap: () async {
                            if (_cameraController != null) {
                              final currentMode =
                                  _cameraController!.value.flashMode;
                              await _cameraController!.setFlashMode(
                                currentMode == FlashMode.off
                                    ? FlashMode.torch
                                    : FlashMode.off,
                              );
                              setState(() {});
                            }
                          },
                          child: Container(
                            width: 50,
                            height: 50,
                            decoration: BoxDecoration(
                              shape: BoxShape.circle,
                              color: Colors.black.withOpacity(0.6),
                              border: Border.all(color: Colors.white, width: 2),
                            ),
                            child: Icon(
                              _cameraController?.value.flashMode ==
                                      FlashMode.torch
                                  ? Icons.flash_on
                                  : Icons.flash_off,
                              color: Colors.white,
                              size: 24,
                            ),
                          ),
                        ),
                        const SizedBox(height: 12),
                        // Zoom control
                        GestureDetector(
                          onTap: _cycleZoom,
                          child: Container(
                            width: 50,
                            height: 50,
                            decoration: BoxDecoration(
                              shape: BoxShape.circle,
                              color: Colors.black.withOpacity(0.6),
                              border: Border.all(color: Colors.white, width: 2),
                            ),
                            child: Center(
                              child: Text(
                                '${_currentZoom.toStringAsFixed(1)}x',
                                style: const TextStyle(
                                  color: Colors.white,
                                  fontSize: 12,
                                  fontWeight: FontWeight.bold,
                                ),
                              ),
                            ),
                          ),
                        ),
                      ],
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

  // Build corner bracket widget for MRZ box
  Widget _buildCornerBracket({required Alignment alignment}) {
    final isTop =
        alignment == Alignment.topLeft || alignment == Alignment.topRight;
    final isLeft =
        alignment == Alignment.topLeft || alignment == Alignment.bottomLeft;

    return Container(
      width: 40,
      height: 40,
      decoration: BoxDecoration(
        border: Border(
          top: isTop
              ? BorderSide(color: AppTheme.primaryOrange, width: 4)
              : BorderSide.none,
          bottom: !isTop
              ? BorderSide(color: AppTheme.primaryOrange, width: 4)
              : BorderSide.none,
          left: isLeft
              ? BorderSide(color: AppTheme.primaryOrange, width: 4)
              : BorderSide.none,
          right: !isLeft
              ? BorderSide(color: AppTheme.primaryOrange, width: 4)
              : BorderSide.none,
        ),
      ),
    );
  }
}

/// MRZ Scanning Guide Painter - Shows darkened overlay with MRZ zone highlighted
class _MRZScanningGuidePainter extends CustomPainter {
  @override
  void paint(Canvas canvas, Size size) {
    // Dark overlay paint
    final overlayPaint = Paint()..color = Colors.black.withOpacity(0.6);

    // MRZ zone rectangle (bottom portion of screen)
    final mrzHeight = 140.0;
    final mrzTop = size.height - 320.0; // Position from bottom
    final mrzRect = Rect.fromLTWH(
      20,
      mrzTop,
      size.width - 40,
      mrzHeight,
    );

    // Draw dark overlay everywhere except MRZ zone
    final overlayPath = Path()
      ..addRect(Rect.fromLTWH(0, 0, size.width, size.height))
      ..addRRect(RRect.fromRectAndRadius(mrzRect, const Radius.circular(12)))
      ..fillType = PathFillType.evenOdd;

    canvas.drawPath(overlayPath, overlayPaint);

    // Draw MRZ zone border (orange highlight)
    final borderPaint = Paint()
      ..color = AppTheme.primaryOrange
      ..strokeWidth = 3
      ..style = PaintingStyle.stroke;

    canvas.drawRRect(
      RRect.fromRectAndRadius(mrzRect, const Radius.circular(12)),
      borderPaint,
    );

    // Draw corner highlights (optional visual enhancement)
    final cornerPaint = Paint()
      ..color = AppTheme.primaryOrange
      ..strokeWidth = 5
      ..style = PaintingStyle.stroke
      ..strokeCap = StrokeCap.round;

    const cornerSize = 30.0;

    // Top-left corner
    canvas.drawLine(
      Offset(mrzRect.left, mrzRect.top + cornerSize),
      Offset(mrzRect.left, mrzRect.top),
      cornerPaint,
    );
    canvas.drawLine(
      Offset(mrzRect.left, mrzRect.top),
      Offset(mrzRect.left + cornerSize, mrzRect.top),
      cornerPaint,
    );

    // Top-right corner
    canvas.drawLine(
      Offset(mrzRect.right - cornerSize, mrzRect.top),
      Offset(mrzRect.right, mrzRect.top),
      cornerPaint,
    );
    canvas.drawLine(
      Offset(mrzRect.right, mrzRect.top),
      Offset(mrzRect.right, mrzRect.top + cornerSize),
      cornerPaint,
    );

    // Bottom-left corner
    canvas.drawLine(
      Offset(mrzRect.left, mrzRect.bottom - cornerSize),
      Offset(mrzRect.left, mrzRect.bottom),
      cornerPaint,
    );
    canvas.drawLine(
      Offset(mrzRect.left, mrzRect.bottom),
      Offset(mrzRect.left + cornerSize, mrzRect.bottom),
      cornerPaint,
    );

    // Bottom-right corner
    canvas.drawLine(
      Offset(mrzRect.right - cornerSize, mrzRect.bottom),
      Offset(mrzRect.right, mrzRect.bottom),
      cornerPaint,
    );
    canvas.drawLine(
      Offset(mrzRect.right, mrzRect.bottom - cornerSize),
      Offset(mrzRect.right, mrzRect.bottom),
      cornerPaint,
    );
  }

  @override
  bool shouldRepaint(covariant CustomPainter oldDelegate) => false;
}
