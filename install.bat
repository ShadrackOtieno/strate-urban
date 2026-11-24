@echo off
cd /d "%~dp0"
echo.
echo === Kilele Properties installer ===
php -v | findstr /C:"PHP 8" >nul || (echo PHP 8.2 or newer is required. Check "php -v" and your PATH. & pause & exit /b 1)
echo.
echo [1/4] Installing PHP packages (needs internet, takes a few minutes)...
call composer install --no-interaction
if errorlevel 1 (echo Composer install failed. & pause & exit /b 1)
echo.
echo [2/4] Building the database (make sure MySQL is running and the database in .env exists)...
php artisan config:clear
php artisan migrate:fresh --seed --force
if errorlevel 1 (echo Database setup failed. Read the message above. & pause & exit /b 1)
echo.
echo [3/4] Linking uploads folder...
php artisan storage:link
echo.
echo [4/4] Starting the site at http://127.0.0.1:8000  (back office: /admin)
echo Press Ctrl+C to stop.
php artisan serve
