import 'package:flutter/foundation.dart';
import 'package:google_mlkit_text_recognition/google_mlkit_text_recognition.dart';
import 'package:flutter_tesseract_ocr/flutter_tesseract_ocr.dart';

/// Dual OCR Engine - Combines Google ML Kit + Tesseract OCR
/// 
/// Strategy:
/// 1. Try Google ML Kit first (fast, good for most cases)
/// 2. If confidence is low or MRZ not found, fallback to Tesseract
/// 3. Merge results from both engines for best accuracy
class DualOCREngine {
  static bool _tesseractInitialized = false;

  /// Initialize Tesseract with required language data
  static Future<void> initialize() async {
    if (_tesseractInitialized) return;
    
    try {
      debugPrint('🔧 Initializing Tesseract OCR...');
      // Tesseract will download language data on first use
      _tesseractInitialized = true;
      debugPrint('✅ Tesseract OCR ready');
    } catch (e) {
      debugPrint('⚠️ Tesseract initialization warning: $e');
    }
  }

  /// Extract text using dual OCR engines
  static Future<String> extractText(String imagePath) async {
    try {
      debugPrint('🔍 Starting Dual OCR extraction...');
      
      // STEP 1: Try Google ML Kit first (faster)
      final mlKitText = await _extractWithMLKit(imagePath);
      debugPrint('📊 ML Kit extracted: ${mlKitText.length} characters');
      
      // If ML Kit got good results, use it
      if (_isGoodQuality(mlKitText)) {
        debugPrint('✅ Using ML Kit results (high quality)');
        return mlKitText;
      }
      
      // STEP 2: Try Tesseract for better accuracy
      debugPrint('🔄 ML Kit quality low, trying Tesseract...');
      final tesseractText = await _extractWithTesseract(imagePath);
      debugPrint('📊 Tesseract extracted: ${tesseractText.length} characters');
      
      // Compare and use best result
      if (_isGoodQuality(tesseractText) && 
          tesseractText.length > mlKitText.length) {
        debugPrint('✅ Using Tesseract results (better quality)');
        return tesseractText;
      }
      
      // STEP 3: Merge both results for maximum coverage
      debugPrint('🔀 Merging both OCR results...');
      final mergedText = _mergeResults(mlKitText, tesseractText);
      debugPrint('✅ Final merged text: ${mergedText.length} characters');
      
      return mergedText;
      
    } catch (e) {
      debugPrint('❌ Dual OCR error: $e');
      rethrow;
    }
  }

  /// Extract text using Google ML Kit
  static Future<String> _extractWithMLKit(String imagePath) async {
    try {
      final inputImage = InputImage.fromFilePath(imagePath);
      final textRecognizer = TextRecognizer(script: TextRecognitionScript.latin);
      
      final RecognizedText recognizedText = 
          await textRecognizer.processImage(inputImage);
      
      await textRecognizer.close();
      
      return recognizedText.text;
    } catch (e) {
      debugPrint('⚠️ ML Kit extraction failed: $e');
      return '';
    }
  }

  /// Extract text using Tesseract OCR (Multi-PSM fallback strategy like test app)
  static Future<String> _extractWithTesseract(String imagePath) async {
    try {
      await initialize();
      
      // Try multiple PSM modes for best MRZ detection (test app strategy)
      final psmModes = ['6', '7', '11']; // Block, line, sparse text
      String bestResult = '';
      
      for (final psm in psmModes) {
        try {
          debugPrint('🔍 Trying Tesseract with PSM $psm');
          
          final text = await FlutterTesseractOcr.extractText(
            imagePath,
            language: 'eng',
            args: {
              "psm": psm,  // Page segmentation mode
              "preserve_interword_spaces": "0",  // Remove extra spaces
              "tessedit_char_whitelist": "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789<",
            },
          );
          
          if (text.isNotEmpty && text.length > bestResult.length) {
            bestResult = text;
            debugPrint('✓ PSM $psm gave better result: ${text.length} chars');
          }
        } catch (e) {
          debugPrint('⚠️ Tesseract PSM $psm error: $e');
        }
      }
      
      return bestResult;
    } catch (e) {
      debugPrint('⚠️ Tesseract extraction failed: $e');
      return '';
    }
  }

  /// Check if OCR result is good quality (contains MRZ-like patterns)
  static bool _isGoodQuality(String text) {
    if (text.isEmpty || text.length < 50) return false;
    
    // Check for MRZ indicators
    final hasMRZPattern = RegExp(r'[A-Z0-9<]{30,}').hasMatch(text);
    final hasMultipleLines = text.split('\n').length >= 2;
    final hasUpperCase = RegExp(r'[A-Z]').hasMatch(text);
    
    return hasMRZPattern || (hasMultipleLines && hasUpperCase);
  }

  /// Merge results from both OCR engines intelligently
  static String _mergeResults(String mlKitText, String tesseractText) {
    if (mlKitText.isEmpty) return tesseractText;
    if (tesseractText.isEmpty) return mlKitText;
    
    // If one contains clear MRZ patterns, prefer it
    final mlKitHasMRZ = RegExp(r'[A-Z0-9<]{40,}').hasMatch(mlKitText);
    final tesseractHasMRZ = RegExp(r'[A-Z0-9<]{40,}').hasMatch(tesseractText);
    
    if (mlKitHasMRZ && !tesseractHasMRZ) return mlKitText;
    if (tesseractHasMRZ && !mlKitHasMRZ) return tesseractText;
    
    // Otherwise combine both (more text = better chance of finding MRZ)
    return '$mlKitText\n\n---TESSERACT---\n\n$tesseractText';
  }

  /// Extract text with detailed analytics
  static Future<OCRResult> extractWithAnalytics(String imagePath) async {
    final stopwatch = Stopwatch()..start();
    
    try {
      final mlKitText = await _extractWithMLKit(imagePath);
      final mlKitTime = stopwatch.elapsedMilliseconds;
      
      stopwatch.reset();
      final tesseractText = await _extractWithTesseract(imagePath);
      final tesseractTime = stopwatch.elapsedMilliseconds;
      
      final mergedText = _mergeResults(mlKitText, tesseractText);
      
      return OCRResult(
        text: mergedText,
        mlKitText: mlKitText,
        tesseractText: tesseractText,
        mlKitTime: mlKitTime,
        tesseractTime: tesseractTime,
        mlKitConfidence: _calculateConfidence(mlKitText),
        tesseractConfidence: _calculateConfidence(tesseractText),
      );
    } catch (e) {
      debugPrint('❌ Analytics extraction error: $e');
      rethrow;
    }
  }

  /// Calculate confidence score based on text quality
  static double _calculateConfidence(String text) {
    if (text.isEmpty) return 0.0;
    
    double score = 0.0;
    
    // Has MRZ pattern (40-44 chars in a row)
    if (RegExp(r'[A-Z0-9<]{40,44}').hasMatch(text)) score += 40;
    
    // Has multiple lines
    final lines = text.split('\n').where((l) => l.trim().isNotEmpty).length;
    score += (lines * 5).clamp(0, 20);
    
    // Has uppercase letters (MRZ is uppercase)
    final upperCount = RegExp(r'[A-Z]').allMatches(text).length;
    score += (upperCount * 0.1).clamp(0, 20);
    
    // Has numbers
    final numberCount = RegExp(r'[0-9]').allMatches(text).length;
    score += (numberCount * 0.1).clamp(0, 10);
    
    // Has < symbols (MRZ filler)
    final fillerCount = RegExp(r'<').allMatches(text).length;
    score += (fillerCount * 0.5).clamp(0, 10);
    
    return score.clamp(0, 100);
  }
}

/// OCR Result with analytics
class OCRResult {
  final String text;
  final String mlKitText;
  final String tesseractText;
  final int mlKitTime;
  final int tesseractTime;
  final double mlKitConfidence;
  final double tesseractConfidence;

  OCRResult({
    required this.text,
    required this.mlKitText,
    required this.tesseractText,
    required this.mlKitTime,
    required this.tesseractTime,
    required this.mlKitConfidence,
    required this.tesseractConfidence,
  });

  String get bestEngine {
    if (mlKitConfidence > tesseractConfidence) return 'ML Kit';
    if (tesseractConfidence > mlKitConfidence) return 'Tesseract';
    return 'Merged';
  }

  @override
  String toString() {
    return '''
OCR Result:
  Total text: ${text.length} chars
  Best engine: $bestEngine
  
  ML Kit:
    - ${mlKitText.length} chars
    - ${mlKitTime}ms
    - ${mlKitConfidence.toStringAsFixed(1)}% confidence
    
  Tesseract:
    - ${tesseractText.length} chars
    - ${tesseractTime}ms
    - ${tesseractConfidence.toStringAsFixed(1)}% confidence
''';
  }
}
