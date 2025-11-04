@echo off
echo ========================================
echo   Setting Up Escorts Database Tables
echo ========================================
echo.

echo This will create the following tables:
echo   1. guest_escorts
echo   2. escort_attachments
echo.

set /p confirm="Continue? (Y/N): "
if /i not "%confirm%"=="Y" (
    echo Setup cancelled.
    pause
    exit /b 0
)

echo.
echo [1/2] Connecting to MySQL...
echo Please enter your MySQL root password when prompted.
echo.

mysql -u root -p qloapps < database_escort_tables.sql

if errorlevel 1 (
    echo.
    echo ERROR: Failed to create tables!
    echo Make sure:
    echo   - MySQL is running
    echo   - qloapps database exists
    echo   - Your password is correct
    pause
    exit /b 1
)

echo.
echo ========================================
echo   ✅ SUCCESS!
echo ========================================
echo.
echo Database tables created successfully:
echo   ✓ guest_escorts
echo   ✓ escort_attachments
echo.
echo You can now add escorts through the app!
echo.
pause
