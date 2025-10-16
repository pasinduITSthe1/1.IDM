# App Icon Setup Script for Hotel Staff Flutter App
# This script automates the app icon generation process

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Hotel Staff App - Icon Setup" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Check if icon file exists
$iconPath = "assets/icons/app_icon.png"

if (-Not (Test-Path $iconPath)) {
    Write-Host "❌ Icon file not found at: $iconPath" -ForegroundColor Red
    Write-Host ""
    Write-Host "Please save your 1.IDM icon image as:" -ForegroundColor Yellow
    Write-Host "  assets/icons/app_icon.png" -ForegroundColor White
    Write-Host ""
    Write-Host "Requirements:" -ForegroundColor Yellow
    Write-Host "  • PNG format" -ForegroundColor White
    Write-Host "  • Square dimensions (1024x1024 recommended)" -ForegroundColor White
    Write-Host "  • High quality" -ForegroundColor White
    Write-Host ""
    
    # Check if assets/icons directory exists, if not create it
    if (-Not (Test-Path "assets/icons")) {
        Write-Host "Creating assets/icons directory..." -ForegroundColor Yellow
        New-Item -ItemType Directory -Path "assets/icons" -Force | Out-Null
        Write-Host "✅ Directory created!" -ForegroundColor Green
        Write-Host ""
    }
    
    Read-Host "Press Enter to exit"
    exit 1
}

Write-Host "✅ Icon file found!" -ForegroundColor Green
Write-Host ""

# Step 1: Get Flutter dependencies
Write-Host "Step 1: Installing dependencies..." -ForegroundColor Cyan
flutter pub get

if ($LASTEXITCODE -ne 0) {
    Write-Host "❌ Failed to install dependencies" -ForegroundColor Red
    Read-Host "Press Enter to exit"
    exit 1
}

Write-Host "✅ Dependencies installed!" -ForegroundColor Green
Write-Host ""

# Step 2: Generate app icons
Write-Host "Step 2: Generating app icons..." -ForegroundColor Cyan
Write-Host "This will create icons for Android and iOS..." -ForegroundColor Yellow
Write-Host ""

flutter pub run flutter_launcher_icons

if ($LASTEXITCODE -ne 0) {
    Write-Host "❌ Failed to generate icons" -ForegroundColor Red
    Read-Host "Press Enter to exit"
    exit 1
}

Write-Host ""
Write-Host "✅ App icons generated successfully!" -ForegroundColor Green
Write-Host ""

# Step 3: Verify generated files
Write-Host "Step 3: Verifying generated files..." -ForegroundColor Cyan

$androidIconsExist = Test-Path "android/app/src/main/res/mipmap-hdpi/ic_launcher.png"

if ($androidIconsExist) {
    Write-Host "✅ Android icons generated successfully!" -ForegroundColor Green
    
    # Count icon files
    $iconCount = (Get-ChildItem -Path "android/app/src/main/res/mipmap-*" -Filter "ic_launcher.png" -Recurse).Count
    Write-Host "   Generated $iconCount icon sizes" -ForegroundColor Gray
    
    # Check adaptive icons
    $adaptiveIconsExist = Test-Path "android/app/src/main/res/mipmap-anydpi-v26/ic_launcher.xml"
    if ($adaptiveIconsExist) {
        Write-Host "   Adaptive icons created ✓" -ForegroundColor Gray
    }
} else {
    Write-Host "⚠️  Android icons not found" -ForegroundColor Yellow
}

Write-Host ""
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Setup Complete!" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "Next Steps:" -ForegroundColor Yellow
Write-Host "1. Run your app to test the new icon:" -ForegroundColor White
Write-Host "   flutter run" -ForegroundColor Cyan
Write-Host ""
Write-Host "2. If the icon doesn't appear, clean and rebuild:" -ForegroundColor White
Write-Host "   flutter clean" -ForegroundColor Cyan
Write-Host "   flutter pub get" -ForegroundColor Cyan
Write-Host "   flutter run" -ForegroundColor Cyan
Write-Host ""
Write-Host "3. For Android, you may need to uninstall the app first" -ForegroundColor White
Write-Host ""

Read-Host "Press Enter to exit"
