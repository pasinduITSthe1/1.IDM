@echo off
echo ============================================
echo   COMPLETE FIREWALL FIX FOR HOTEL APP
echo ============================================
echo.

REM Check for admin rights
net session >nul 2>&1
if %errorLevel% neq 0 (
    echo ERROR: This script requires Administrator privileges!
    echo.
    echo Please right-click this file and select "Run as administrator"
    echo.
    pause
    exit /b 1
)

echo [1/5] Removing any existing rules...
netsh advfirewall firewall delete rule name="Hotel Backend - Port 3000" >nul 2>&1
netsh advfirewall firewall delete rule name="Node.js - Hotel Backend" >nul 2>&1

echo [2/5] Adding INBOUND rule for port 3000...
netsh advfirewall firewall add rule name="Hotel Backend - Port 3000" dir=in action=allow protocol=TCP localport=3000 enable=yes

echo [3/5] Adding OUTBOUND rule for port 3000...
netsh advfirewall firewall add rule name="Hotel Backend - Port 3000" dir=out action=allow protocol=TCP localport=3000 enable=yes

echo [4/5] Adding rule for Node.js executable...
for /f "delims=" %%i in ('where node') do set NODE_PATH=%%i
if defined NODE_PATH (
    netsh advfirewall firewall add rule name="Node.js - Hotel Backend" dir=in action=allow program="%NODE_PATH%" enable=yes
    echo    Node.js path: %NODE_PATH%
) else (
    echo    Warning: Node.js executable not found in PATH
)

echo [5/5] Verifying firewall rules...
echo.
echo === INBOUND RULES ===
netsh advfirewall firewall show rule name="Hotel Backend - Port 3000" dir=in
echo.
echo === OUTBOUND RULES ===
netsh advfirewall firewall show rule name="Hotel Backend - Port 3000" dir=out
echo.

echo ============================================
echo   FIREWALL CONFIGURATION COMPLETE!
echo ============================================
echo.
echo Next steps:
echo 1. Restart your Flutter app (press R in terminal)
echo 2. Try to register a guest again
echo 3. Check console for success messages
echo.
pause
