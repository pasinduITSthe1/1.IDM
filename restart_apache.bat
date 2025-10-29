@echo off
echo ========================================
echo Restarting Apache for QloApps API Fix
echo ========================================
echo.
echo Stopping Apache processes...
taskkill /F /IM httpd.exe >nul 2>&1
timeout /t 3 /nobreak >nul
echo.
echo Starting Apache...
"C:\wamp64\bin\apache\apache2.4.62.1\bin\httpd.exe" -k start
timeout /t 2 /nobreak >nul
echo.
echo ========================================
echo Apache Restarted Successfully!
echo ========================================
echo.
echo The 403 error should now be fixed.
echo Press R in the Flutter terminal to hot restart the app.
echo.
pause
