@echo off
echo ========================================
echo   Starting Hotel Backend Server
echo   with Escorts API Support
echo ========================================
echo.

cd hotel-backend

echo [1/3] Checking Node.js...
node --version
if errorlevel 1 (
    echo ERROR: Node.js is not installed!
    echo Please install Node.js from https://nodejs.org/
    pause
    exit /b 1
)

echo.
echo [2/3] Installing dependencies...
call npm install

echo.
echo [3/3] Starting server on port 3000...
echo.
echo ========================================
echo  Escorts API will be available at:
echo  http://localhost:3000/api/escorts
echo ========================================
echo.

node server.js

pause
