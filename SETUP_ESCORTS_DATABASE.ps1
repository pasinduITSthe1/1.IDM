# Setup Escorts Database Tables
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Setting Up Escorts Database Tables" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

Write-Host "This will create the following tables:" -ForegroundColor Yellow
Write-Host "  1. guest_escorts" -ForegroundColor White
Write-Host "  2. escort_attachments" -ForegroundColor White
Write-Host ""

$confirm = Read-Host "Continue? (Y/N)"
if ($confirm -ne "Y" -and $confirm -ne "y") {
    Write-Host "Setup cancelled." -ForegroundColor Red
    Read-Host "Press Enter to exit"
    exit
}

Write-Host ""
Write-Host "[1/2] Connecting to MySQL..." -ForegroundColor Green
Write-Host "Please enter your MySQL root password when prompted." -ForegroundColor Yellow
Write-Host ""

# Get MySQL path from PATH or use default
$mysqlPath = "mysql"
if (Get-Command mysql -ErrorAction SilentlyContinue) {
    $mysqlPath = "mysql"
} elseif (Test-Path "C:\wamp64\bin\mysql\mysql8.0.39\bin\mysql.exe") {
    $mysqlPath = "C:\wamp64\bin\mysql\mysql8.0.39\bin\mysql.exe"
}

# Execute SQL file
Get-Content "database_escort_tables.sql" | & $mysqlPath -u root -p qloapps --default-character-set=utf8mb4

if ($LASTEXITCODE -eq 0) {
    Write-Host ""
    Write-Host "========================================" -ForegroundColor Green
    Write-Host "  ✅ SUCCESS!" -ForegroundColor Green
    Write-Host "========================================" -ForegroundColor Green
    Write-Host ""
    Write-Host "Database tables created successfully:" -ForegroundColor Green
    Write-Host "  ✓ guest_escorts" -ForegroundColor White
    Write-Host "  ✓ escort_attachments" -ForegroundColor White
    Write-Host ""
    Write-Host "You can now add escorts through the app!" -ForegroundColor Cyan
    Write-Host ""
} else {
    Write-Host ""
    Write-Host "========================================" -ForegroundColor Red
    Write-Host "  ❌ ERROR!" -ForegroundColor Red
    Write-Host "========================================" -ForegroundColor Red
    Write-Host ""
    Write-Host "Failed to create tables!" -ForegroundColor Red
    Write-Host "Make sure:" -ForegroundColor Yellow
    Write-Host "  - MySQL is running" -ForegroundColor White
    Write-Host "  - qloapps database exists" -ForegroundColor White
    Write-Host "  - Your password is correct" -ForegroundColor White
    Write-Host ""
}

Read-Host "Press Enter to exit"
