# Add ITSthe1 Logo to Flutter App
# This script helps you add the logo to the correct location

Write-Host "🎨 ITSthe1 Logo Setup Script" -ForegroundColor Cyan
Write-Host "================================" -ForegroundColor Cyan
Write-Host ""

$targetPath = "c:\wamp64\www\1.IDM\hotel-staff-flutter\assets\images\logo.png"
$targetDir = "c:\wamp64\www\1.IDM\hotel-staff-flutter\assets\images"

# Ensure directory exists
if (-not (Test-Path $targetDir)) {
    Write-Host "📁 Creating assets/images directory..." -ForegroundColor Yellow
    New-Item -ItemType Directory -Path $targetDir -Force | Out-Null
    Write-Host "✅ Directory created!" -ForegroundColor Green
} else {
    Write-Host "✅ Directory already exists!" -ForegroundColor Green
}

Write-Host ""
Write-Host "📍 Logo should be placed at:" -ForegroundColor Yellow
Write-Host "   $targetPath" -ForegroundColor White
Write-Host ""

# Check if logo already exists
if (Test-Path $targetPath) {
    Write-Host "✅ Logo file found!" -ForegroundColor Green
    $fileInfo = Get-Item $targetPath
    Write-Host "   Size: $($fileInfo.Length) bytes" -ForegroundColor Gray
    Write-Host "   Modified: $($fileInfo.LastWriteTime)" -ForegroundColor Gray
    Write-Host ""
    Write-Host "🔄 To update, replace the file and run:" -ForegroundColor Cyan
    Write-Host "   flutter run" -ForegroundColor White
} else {
    Write-Host "⏳ Logo file NOT found!" -ForegroundColor Red
    Write-Host ""
    Write-Host "📥 To add the logo:" -ForegroundColor Yellow
    Write-Host ""
    Write-Host "Option 1: Copy from another location" -ForegroundColor Cyan
    Write-Host "   Copy-Item 'YOUR_LOGO_PATH\logo.png' '$targetPath'" -ForegroundColor White
    Write-Host ""
    Write-Host "Option 2: Manual copy" -ForegroundColor Cyan
    Write-Host "   1. Save the ITSthe1 logo as logo.png" -ForegroundColor White
    Write-Host "   2. Copy to: $targetDir" -ForegroundColor White
    Write-Host ""
    Write-Host "Option 3: Use File Explorer" -ForegroundColor Cyan
    Write-Host "   Opening folder in Explorer..." -ForegroundColor White
    
    # Open folder in Explorer
    if (Test-Path $targetDir) {
        explorer $targetDir
        Write-Host "   ✅ Folder opened! Drop your logo.png file there." -ForegroundColor Green
    }
}

Write-Host ""
Write-Host "═══════════════════════════════════════════" -ForegroundColor Cyan
Write-Host "After adding the logo:" -ForegroundColor Yellow
Write-Host "1. Press 'r' in Flutter terminal (hot reload)" -ForegroundColor White
Write-Host "2. Or run: flutter run" -ForegroundColor White
Write-Host "═══════════════════════════════════════════" -ForegroundColor Cyan
Write-Host ""

# Ask if user wants to copy from a specific location
Write-Host "Do you have the logo file ready to copy? (Y/N): " -ForegroundColor Yellow -NoNewline
$response = Read-Host

if ($response -eq 'Y' -or $response -eq 'y') {
    Write-Host ""
    Write-Host "Enter the full path to your logo file: " -ForegroundColor Yellow -NoNewline
    $sourcePath = Read-Host
    
    if (Test-Path $sourcePath) {
        try {
            Copy-Item $sourcePath $targetPath -Force
            Write-Host "✅ Logo copied successfully!" -ForegroundColor Green
            Write-Host "🚀 Now run: flutter run" -ForegroundColor Cyan
        } catch {
            Write-Host "❌ Error copying file: $_" -ForegroundColor Red
        }
    } else {
        Write-Host "❌ File not found at: $sourcePath" -ForegroundColor Red
    }
}

Write-Host ""
Write-Host "Press any key to exit..."
$null = $Host.UI.RawUI.ReadKey("NoEcho,IncludeKeyDown")
