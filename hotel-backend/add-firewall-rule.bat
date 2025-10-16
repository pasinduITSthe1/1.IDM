@echo off
echo ========================================
echo  Hotel Backend API - Firewall Setup
echo ========================================
echo.
echo This will add a firewall rule to allow
echo Node.js backend on port 3000
echo.
echo Please run this script as Administrator!
echo.
pause

netsh advfirewall firewall delete rule name="Hotel Backend API" >nul 2>&1
netsh advfirewall firewall add rule name="Hotel Backend API" dir=in action=allow protocol=TCP localport=3000

if %errorlevel% == 0 (
    echo.
    echo ✅ Firewall rule added successfully!
    echo.
    echo Backend API is now accessible from your phone.
    echo.
) else (
    echo.
    echo ❌ Failed to add firewall rule!
    echo.
    echo Please run this script as Administrator:
    echo 1. Right-click this file
    echo 2. Select "Run as administrator"
    echo.
)

pause
