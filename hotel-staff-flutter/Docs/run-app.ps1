# Flutter Hotel Staff App - Run Script
# This script runs the Flutter app on your connected Android device

Write-Host "🏨 ITSthe1 Hotel Staff App - Flutter" -ForegroundColor Cyan
Write-Host "=====================================" -ForegroundColor Cyan
Write-Host ""

# Change to project directory
Set-Location -Path $PSScriptRoot

Write-Host "📱 Checking for connected devices..." -ForegroundColor Yellow
flutter devices

Write-Host ""
Write-Host "🚀 Launching app on Android device..." -ForegroundColor Green
Write-Host ""
Write-Host "⏳ First build may take 5-10 minutes (downloading NDK & dependencies)" -ForegroundColor Magenta
Write-Host "   Subsequent builds will be much faster!" -ForegroundColor Magenta
Write-Host ""

# Run the app
flutter run -d CPH2211

Write-Host ""
Write-Host "✅ App execution completed!" -ForegroundColor Green
