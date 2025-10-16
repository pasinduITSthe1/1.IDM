# AUTOMATIC FIREWALL FIX
# This will open port 3000 for the hotel backend

Write-Host "========================================" -ForegroundColor Cyan
Write-Host " Hotel Backend - Firewall Configuration" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Check if running as administrator
$isAdmin = ([Security.Principal.WindowsPrincipal] [Security.Principal.WindowsIdentity]::GetCurrent()).IsInRole([Security.Principal.WindowsBuiltInRole]::Administrator)

if (-not $isAdmin) {
    Write-Host "❌ ERROR: This script must be run as Administrator!" -ForegroundColor Red
    Write-Host ""
    Write-Host "Please:" -ForegroundColor Yellow
    Write-Host "1. Right-click on this script" -ForegroundColor Yellow
    Write-Host "2. Select 'Run with PowerShell'" -ForegroundColor Yellow
    Write-Host "3. Click 'Yes' when prompted" -ForegroundColor Yellow
    Write-Host ""
    Read-Host "Press Enter to exit"
    exit 1
}

Write-Host "✅ Running as Administrator" -ForegroundColor Green
Write-Host ""

# Remove existing rule if it exists
Write-Host "🔄 Removing old firewall rule (if exists)..." -ForegroundColor Yellow
netsh advfirewall firewall delete rule name="Hotel Backend API" >$null 2>&1

# Add new firewall rule
Write-Host "🔄 Adding new firewall rule..." -ForegroundColor Yellow
$result = netsh advfirewall firewall add rule name="Hotel Backend API" dir=in action=allow protocol=TCP localport=3000

if ($LASTEXITCODE -eq 0) {
    Write-Host ""
    Write-Host "✅ SUCCESS! Firewall rule added!" -ForegroundColor Green
    Write-Host ""
    Write-Host "Port 3000 is now open for:" -ForegroundColor Cyan
    Write-Host "  - Your phone/device" -ForegroundColor Cyan
    Write-Host "  - Hotel staff app" -ForegroundColor Cyan
    Write-Host ""
    
    # Test the connection
    Write-Host "🔄 Testing connection..." -ForegroundColor Yellow
    Start-Sleep -Seconds 2
    
    try {
        $response = Invoke-WebRequest -Uri "http://10.0.1.24:3000/api/health" -TimeoutSec 5 -ErrorAction Stop
        Write-Host "✅ Backend is accessible on network!" -ForegroundColor Green
        Write-Host ""
        Write-Host "Response: $($response.Content)" -ForegroundColor Gray
    } catch {
        Write-Host "⚠️  Warning: Could not test connection" -ForegroundColor Yellow
        Write-Host "   Make sure backend server is running" -ForegroundColor Yellow
        Write-Host "   Run: cd hotel-backend; node server.js" -ForegroundColor Yellow
    }
    
    Write-Host ""
    Write-Host "========================================" -ForegroundColor Cyan
    Write-Host " NEXT STEPS:" -ForegroundColor Cyan
    Write-Host "========================================" -ForegroundColor Cyan
    Write-Host "1. In Flutter terminal, press 'R' (hot restart)" -ForegroundColor Yellow
    Write-Host "2. Try logging in with:" -ForegroundColor Yellow
    Write-Host "   Username: admin" -ForegroundColor White
    Write-Host "   Password: admin123" -ForegroundColor White
    Write-Host ""
    Write-Host "✅ It should work now!" -ForegroundColor Green
    
} else {
    Write-Host ""
    Write-Host "❌ ERROR: Failed to add firewall rule!" -ForegroundColor Red
    Write-Host ""
    Write-Host "Try:" -ForegroundColor Yellow
    Write-Host "1. Run this script as Administrator" -ForegroundColor Yellow
    Write-Host "2. Or manually disable firewall temporarily" -ForegroundColor Yellow
    Write-Host ""
}

Write-Host ""
Read-Host "Press Enter to exit"
