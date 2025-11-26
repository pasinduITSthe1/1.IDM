@echo off
echo Clearing PrestaShop/QloApps Cache...
echo.

REM Clear Smarty cache
echo Clearing Smarty compiled templates...
rmdir /s /q "cache\smarty\compile" 2>nul
rmdir /s /q "cache\smarty\cache" 2>nul
mkdir "cache\smarty\compile"
mkdir "cache\smarty\cache"

REM Clear class index
echo Clearing class index...
del "cache\class_index.php" 2>nul

REM Clear admin cache
echo Clearing admin cache...
rmdir /s /q "admin134miqa0b\autoupgrade\backup" 2>nul

REM Set proper permissions (for Windows, create the folders if they don't exist)
echo Recreating cache directories...
if not exist "cache\smarty\compile" mkdir "cache\smarty\compile"
if not exist "cache\smarty\cache" mkdir "cache\smarty\cache"

echo.
echo Cache cleared successfully!
echo Please refresh your browser and try again.
echo.
pause
