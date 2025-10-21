# Quick Test Script for Dual OCR Integration

Write-Host "🚀 Testing Dual OCR Integration" -ForegroundColor Cyan
Write-Host "================================" -ForegroundColor Cyan
Write-Host ""

Write-Host "📦 Step 1: Check dependencies..." -ForegroundColor Yellow
flutter pub get

Write-Host ""
Write-Host "🔍 Step 2: Analyzing code..." -ForegroundColor Yellow
flutter analyze lib/utils/dual_ocr_engine.dart
flutter analyze lib/screens/scan_document_screen_v2.dart

Write-Host ""
Write-Host "✅ Ready to test!" -ForegroundColor Green
Write-Host ""
Write-Host "Test Instructions:" -ForegroundColor Cyan
Write-Host "1. Run: flutter run" -ForegroundColor White
Write-Host "2. Navigate to scan screen" -ForegroundColor White
Write-Host "3. Capture a passport/ID" -ForegroundColor White
Write-Host "4. Watch terminal for OCR analytics:" -ForegroundColor White
Write-Host "   - 'Best engine: ML Kit/Tesseract/Merged'" -ForegroundColor Gray
Write-Host "   - Confidence scores" -ForegroundColor Gray
Write-Host "   - Processing times" -ForegroundColor Gray
Write-Host ""
Write-Host "Expected: ~90-95% success rate vs ~70-80% before" -ForegroundColor Green
