import 'dart:io';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:camera/camera.dart';
import 'package:permission_handler/permission_handler.dart';
import 'package:go_router/go_router.dart';
import 'package:image/image.dart' as img;
import '../utils/id_photo_storage.dart';
import '../utils/app_theme.dart';

/// ID Photo Capture Screen - Captures cropped photos of documents
/// Smart detection: Passport (1 photo) vs ID Card (2 photos)
/// Only captures the highlighted frame area, not full screen
class IDPhotoCaptureScreen extends StatefulWidget {
  final Map<String, String> mrzData;

  const IDPhotoCaptureScreen({
    super.key,
    required this.mrzData,
  });

  @override
  State<IDPhotoCaptureScreen> createState() => _IDPhotoCaptureScreenState();
}

class _IDPhotoCaptureScreenState extends State<IDPhotoCaptureScreen> {
  CameraController? _cameraController;
  bool _isCapturing = false;
  String? _frontPhotoPath;
  String? _backPhotoPath;
  bool _isFlashOn = false;

  // Document type detection
  bool _isPassport = false;
  int _requiredPhotos = 2; // Default: ID card needs 2 photos

  // Current capture stage
  CaptureStage _currentStage = CaptureStage.front;

  @override
  void initState() {
    super.initState();
    SystemChrome.setPreferredOrientations([DeviceOrientation.portraitUp]);
    _detectDocumentType();
    _requestPermissionsAndInit();
  }

  /// Detect if document is a passport or ID card
  void _detectDocumentType() {
    final docType = widget.mrzData['type']?.toLowerCase() ?? '';
    _isPassport = docType.contains('passport');
    _requiredPhotos = _isPassport ? 1 : 2; // Passport: 1 photo, ID: 2 photos

    debugPrint('Document type: ${_isPassport ? "Passport" : "ID Card"}');
    debugPrint('Required photos: $_requiredPhotos');
  }

  Future<void> _requestPermissionsAndInit() async {
    // Request camera permission
    final cameraStatus = await Permission.camera.request();
    if (!cameraStatus.isGranted) {
      if (mounted) {
        _showError('Camera permission is required');
      }
      return;
    }

    // Request storage permission
    final storageGranted = await IDPhotoStorage.requestPermissions();
    if (!storageGranted) {
      if (mounted) {
        _showError('Storage permission is required');
      }
      return;
    }

    await _initializeCamera();
  }

  Future<void> _initializeCamera() async {
    final cameras = await availableCameras();
    if (cameras.isEmpty) {
      _showError('No camera found');
      return;
    }

    _cameraController = CameraController(
      cameras.first,
      ResolutionPreset.high,
      enableAudio: false,
      imageFormatGroup: ImageFormatGroup.jpeg,
    );

    try {
      await _cameraController!.initialize();
      if (mounted) setState(() {});
    } catch (e) {
      _showError('Camera initialization failed: $e');
    }
  }

  Future<void> _capturePhoto() async {
    if (_cameraController == null || !_cameraController!.value.isInitialized) {
      return;
    }

    if (_isCapturing) return;

    setState(() => _isCapturing = true);

    try {
      // Capture full image
      final image = await _cameraController!.takePicture();

      // Crop to frame area only
      final croppedPath = await _cropToFrame(image.path);

      if (croppedPath == null) {
        _showError('Failed to crop image');
        setState(() => _isCapturing = false);
        return;
      }

      if (_currentStage == CaptureStage.front) {
        setState(() {
          _frontPhotoPath = croppedPath;

          // For passports, skip to preview (only need 1 photo)
          if (_isPassport) {
            _currentStage = CaptureStage.preview;
          } else {
            _currentStage = CaptureStage.back;
          }
        });

        // Haptic feedback
        HapticFeedback.mediumImpact();

        // Show success message
        if (mounted) {
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(
              content: Text(_isPassport
                  ? '✓ Passport photo captured'
                  : '✓ Front photo captured'),
              duration: const Duration(seconds: 1),
              backgroundColor: Colors.green,
            ),
          );
        }

        // If passport, save immediately
        if (_isPassport) {
          await _saveAndPreview();
        }
      } else if (_currentStage == CaptureStage.back) {
        setState(() {
          _backPhotoPath = croppedPath;
          _currentStage = CaptureStage.preview;
        });

        HapticFeedback.mediumImpact();

        // Navigate to preview
        await _saveAndPreview();
      }
    } catch (e) {
      _showError('Failed to capture photo: $e');
    } finally {
      setState(() => _isCapturing = false);
    }
  }

  /// Crop image to frame area only
  Future<String?> _cropToFrame(String imagePath) async {
    try {
      // Read image
      final bytes = await File(imagePath).readAsBytes();
      final originalImage = img.decodeImage(bytes);

      if (originalImage == null) return null;

      // Calculate frame dimensions relative to image size
      final imageWidth = originalImage.width;
      final imageHeight = originalImage.height;

      // Frame dimensions (matching UI)
      double frameWidthRatio = 0.85;
      double frameHeightRatio;

      if (_isPassport) {
        // Passport ratio: ~88mm × 125mm ≈ 0.704 (taller)
        frameHeightRatio = frameWidthRatio * 1.42;
      } else {
        // ID card ratio: 85.6mm × 53.98mm ≈ 1.59 (wider)
        frameHeightRatio = frameWidthRatio * 0.63;
      }

      // Calculate crop dimensions
      final cropWidth = (imageWidth * frameWidthRatio).toInt();
      final cropHeight = (imageHeight * frameHeightRatio).toInt();

      // Center crop
      final cropX = ((imageWidth - cropWidth) / 2).toInt();
      final cropY = ((imageHeight - cropHeight) / 2).toInt();

      // Crop image
      final croppedImage = img.copyCrop(
        originalImage,
        x: cropX,
        y: cropY,
        width: cropWidth,
        height: cropHeight,
      );

      // Save cropped image
      final croppedPath = imagePath.replaceAll('.jpg', '_cropped.jpg');
      await File(croppedPath)
          .writeAsBytes(img.encodeJpg(croppedImage, quality: 95));

      // Delete original
      await File(imagePath).delete();

      debugPrint(
          'Image cropped: ${cropWidth}x${cropHeight} from ${imageWidth}x${imageHeight}');

      return croppedPath;
    } catch (e) {
      debugPrint('Crop error: $e');
      return imagePath; // Return original if crop fails
    }
  }

  Future<void> _saveAndPreview() async {
    if (_frontPhotoPath == null) return;

    // For ID cards, both photos are required
    if (!_isPassport && _backPhotoPath == null) return;

    try {
      // Generate guest ID from document number or use timestamp
      final guestId = widget.mrzData['documentNumber']
              ?.replaceAll(RegExp(r'[^a-zA-Z0-9]'), '') ??
          DateTime.now().millisecondsSinceEpoch.toString();

      // Save photos to IDM folder
      await IDPhotoStorage.saveFrontPhoto(guestId, _frontPhotoPath!);

      // Save back photo only for ID cards
      if (!_isPassport && _backPhotoPath != null) {
        await IDPhotoStorage.saveBackPhoto(guestId, _backPhotoPath!);
      }

      if (mounted) {
        // Add photo paths to MRZ data
        final dataWithPhotos = Map<String, String>.from(widget.mrzData);
        dataWithPhotos['frontPhotoPath'] = _frontPhotoPath!;

        if (!_isPassport && _backPhotoPath != null) {
          dataWithPhotos['backPhotoPath'] = _backPhotoPath!;
        }

        dataWithPhotos['guestId'] = guestId;
        dataWithPhotos['isPassport'] = _isPassport.toString();

        // Navigate to registration with all data
        context.go('/register-guest', extra: dataWithPhotos);
      }
    } catch (e) {
      _showError('Failed to save photos: $e');
    }
  }

  Future<void> _toggleFlash() async {
    if (_cameraController == null) return;

    final newMode = _isFlashOn ? FlashMode.off : FlashMode.torch;
    await _cameraController!.setFlashMode(newMode);
    setState(() => _isFlashOn = !_isFlashOn);
    HapticFeedback.lightImpact();
  }

  void _retakeFrontPhoto() {
    HapticFeedback.lightImpact();
    setState(() {
      _frontPhotoPath = null;
      _backPhotoPath = null;
      _currentStage = CaptureStage.front;
    });
  }

  void _showError(String message) {
    if (mounted) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text(message),
          backgroundColor: Colors.red,
          duration: const Duration(seconds: 3),
        ),
      );
    }
  }

  @override
  void dispose() {
    SystemChrome.setPreferredOrientations(DeviceOrientation.values);
    _cameraController?.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    if (_cameraController == null || !_cameraController!.value.isInitialized) {
      return Scaffold(
        backgroundColor: Colors.black,
        body: Center(
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              const CircularProgressIndicator(color: Colors.white),
              const SizedBox(height: 16),
              Text(
                'Initializing camera...',
                style: TextStyle(color: Colors.white.withOpacity(0.7)),
              ),
            ],
          ),
        ),
      );
    }

    return Scaffold(
      backgroundColor: Colors.black,
      body: Stack(
        fit: StackFit.expand,
        children: [
          // Camera Preview
          CameraPreview(_cameraController!),

          // ID Card Overlay Guide
          _buildCardOverlay(),

          // Top Bar
          Positioned(
            top: 0,
            left: 0,
            right: 0,
            child: SafeArea(
              child: _buildTopBar(),
            ),
          ),

          // Instruction Banner
          Positioned(
            top: MediaQuery.of(context).padding.top + 60,
            left: 0,
            right: 0,
            child: _buildInstructionBanner(),
          ),

          // Bottom Controls
          Positioned(
            bottom: 0,
            left: 0,
            right: 0,
            child: SafeArea(
              child: _buildBottomControls(),
            ),
          ),

          // Photo Thumbnails (if captured)
          if (_frontPhotoPath != null)
            Positioned(
              bottom: 120,
              left: 16,
              child:
                  _buildThumbnail('Front', _frontPhotoPath!, _retakeFrontPhoto),
            ),
        ],
      ),
    );
  }

  Widget _buildTopBar() {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 12),
      decoration: BoxDecoration(
        gradient: LinearGradient(
          begin: Alignment.topCenter,
          end: Alignment.bottomCenter,
          colors: [
            Colors.black.withOpacity(0.7),
            Colors.transparent,
          ],
        ),
      ),
      child: Row(
        children: [
          // Back Button
          IconButton(
            onPressed: () => context.pop(),
            icon: const Icon(Icons.arrow_back, color: Colors.white, size: 28),
          ),
          const SizedBox(width: 8),
          // Title
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                const Text(
                  'Capture ID Photos',
                  style: TextStyle(
                    color: Colors.white,
                    fontSize: 18,
                    fontWeight: FontWeight.bold,
                  ),
                ),
                Text(
                  widget.mrzData['documentNumber'] ?? 'Unknown ID',
                  style: TextStyle(
                    color: Colors.white.withOpacity(0.7),
                    fontSize: 12,
                  ),
                ),
              ],
            ),
          ),
          // Flash Toggle
          IconButton(
            onPressed: _toggleFlash,
            icon: Icon(
              _isFlashOn ? Icons.flash_on : Icons.flash_off,
              color: _isFlashOn ? AppTheme.primaryOrange : Colors.white,
              size: 28,
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildInstructionBanner() {
    String instruction;
    String subtitle;

    if (_isPassport) {
      instruction = '📖 Position passport photo page';
      subtitle = 'Align the page with MRZ at bottom';
    } else {
      if (_currentStage == CaptureStage.front) {
        instruction = '📸 Position FRONT side of ID card';
        subtitle = 'Align card with the frame below';
      } else {
        instruction = '📸 Position BACK side of ID card';
        subtitle = 'Flip card and align with frame';
      }
    }

    return Container(
      margin: const EdgeInsets.symmetric(horizontal: 24),
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        gradient: AppTheme.orangeGradient,
        borderRadius: BorderRadius.circular(12),
        boxShadow: [
          BoxShadow(
            color: AppTheme.primaryOrange.withOpacity(0.3),
            blurRadius: 12,
            offset: const Offset(0, 4),
          ),
        ],
      ),
      child: Row(
        children: [
          Icon(
            _isPassport ? Icons.menu_book : Icons.credit_card,
            color: Colors.white,
            size: 24,
          ),
          const SizedBox(width: 12),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  instruction,
                  style: const TextStyle(
                    color: Colors.white,
                    fontSize: 16,
                    fontWeight: FontWeight.bold,
                  ),
                ),
                const SizedBox(height: 4),
                Text(
                  subtitle,
                  style: TextStyle(
                    color: Colors.white.withOpacity(0.9),
                    fontSize: 12,
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildCardOverlay() {
    final screenWidth = MediaQuery.of(context).size.width;
    final frameWidth = screenWidth * 0.85;

    // Calculate height based on document type
    final double frameHeight;
    if (_isPassport) {
      // Passport ratio: 88mm × 125mm ≈ 0.704 (portrait, taller)
      frameHeight = frameWidth * 1.42;
    } else {
      // ID card ratio: 85.6mm × 53.98mm ≈ 1.59 (landscape, wider)
      frameHeight = frameWidth * 0.63;
    }

    return Center(
      child: Container(
        width: frameWidth,
        height: frameHeight,
        decoration: BoxDecoration(
          border: Border.all(
            color: _currentStage == CaptureStage.front
                ? AppTheme.primaryOrange
                : Colors.blueAccent,
            width: 3,
          ),
          borderRadius: BorderRadius.circular(12),
          boxShadow: [
            BoxShadow(
              color: (_currentStage == CaptureStage.front
                      ? AppTheme.primaryOrange
                      : Colors.blueAccent)
                  .withOpacity(0.5),
              blurRadius: 20,
              spreadRadius: 2,
            ),
          ],
        ),
        child: Stack(
          children: [
            // Corner markers
            ...List.generate(4, (index) {
              final isTop = index < 2;
              final isLeft = index % 2 == 0;
              return Positioned(
                top: isTop ? 0 : null,
                bottom: isTop ? null : 0,
                left: isLeft ? 0 : null,
                right: isLeft ? null : 0,
                child: Container(
                  width: 24,
                  height: 24,
                  decoration: BoxDecoration(
                    color: Colors.white,
                    borderRadius: BorderRadius.only(
                      topLeft: isTop && isLeft
                          ? const Radius.circular(8)
                          : Radius.zero,
                      topRight: isTop && !isLeft
                          ? const Radius.circular(8)
                          : Radius.zero,
                      bottomLeft: !isTop && isLeft
                          ? const Radius.circular(8)
                          : Radius.zero,
                      bottomRight: !isTop && !isLeft
                          ? const Radius.circular(8)
                          : Radius.zero,
                    ),
                  ),
                ),
              );
            }),
          ],
        ),
      ),
    );
  }

  Widget _buildBottomControls() {
    return Container(
      padding: const EdgeInsets.all(24),
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
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceEvenly,
        children: [
          // Retake button (only show for ID cards in back photo stage)
          if (_currentStage == CaptureStage.back && !_isPassport)
            _buildControlButton(
              icon: Icons.refresh,
              label: 'Retake Front',
              onPressed: _retakeFrontPhoto,
            )
          else
            const SizedBox(width: 80),

          // Capture Button
          GestureDetector(
            onTap: _isCapturing ? null : _capturePhoto,
            child: Container(
              width: 80,
              height: 80,
              decoration: BoxDecoration(
                shape: BoxShape.circle,
                border: Border.all(color: Colors.white, width: 4),
                boxShadow: [
                  BoxShadow(
                    color: AppTheme.primaryOrange.withOpacity(0.5),
                    blurRadius: 20,
                    spreadRadius: 2,
                  ),
                ],
              ),
              child: Container(
                margin: const EdgeInsets.all(6),
                decoration: BoxDecoration(
                  shape: BoxShape.circle,
                  gradient: AppTheme.orangeGradient,
                ),
                child: _isCapturing
                    ? const Center(
                        child: CircularProgressIndicator(
                          color: Colors.white,
                          strokeWidth: 3,
                        ),
                      )
                    : const Icon(Icons.camera, color: Colors.white, size: 36),
              ),
            ),
          ),

          // Gallery button placeholder
          const SizedBox(width: 80),
        ],
      ),
    );
  }

  Widget _buildControlButton({
    required IconData icon,
    required String label,
    required VoidCallback onPressed,
  }) {
    return Column(
      mainAxisSize: MainAxisSize.min,
      children: [
        IconButton(
          onPressed: onPressed,
          icon: Icon(icon, color: Colors.white, size: 28),
          style: IconButton.styleFrom(
            backgroundColor: Colors.white.withOpacity(0.2),
            padding: const EdgeInsets.all(12),
          ),
        ),
        const SizedBox(height: 4),
        Text(
          label,
          style: const TextStyle(color: Colors.white, fontSize: 12),
        ),
      ],
    );
  }

  Widget _buildThumbnail(String label, String path, VoidCallback onRetake) {
    return GestureDetector(
      onTap: onRetake,
      child: Container(
        width: 80,
        decoration: BoxDecoration(
          borderRadius: BorderRadius.circular(8),
          border: Border.all(color: Colors.white, width: 2),
          boxShadow: [
            BoxShadow(
              color: Colors.black.withOpacity(0.5),
              blurRadius: 8,
            ),
          ],
        ),
        child: Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            ClipRRect(
              borderRadius:
                  const BorderRadius.vertical(top: Radius.circular(6)),
              child: Image.file(
                File(path),
                width: 76,
                height: 50,
                fit: BoxFit.cover,
              ),
            ),
            Container(
              width: 76,
              padding: const EdgeInsets.symmetric(vertical: 4),
              decoration: const BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.vertical(bottom: Radius.circular(6)),
              ),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  Text(
                    label,
                    style: const TextStyle(
                      fontSize: 10,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  const SizedBox(width: 4),
                  const Icon(Icons.check_circle, color: Colors.green, size: 12),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}

enum CaptureStage {
  front,
  back,
  preview,
}
