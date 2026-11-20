@echo off
setlocal
cd /d "%~dp0"
color 0A
echo ==============================================
echo       KASIR LARAVEL - SETUP WINDOWS
echo ==============================================
echo.
php -v >nul 2>&1
if errorlevel 1 (
  echo [ERROR] PHP tidak ditemukan di PATH.
  echo Pastikan PHP XAMPP tersedia dan tambahkan C:\xampp\php ke PATH.
  pause
  exit /b 1
)
php -m | findstr /I /C:"dom" >nul
if errorlevel 1 (
  echo [ERROR] Ekstensi PHP DOM/XML belum aktif.
  echo Buka C:\xampp\php\php.ini lalu aktifkan extension=dom atau extension=php_dom.dll sesuai versi PHP Anda.
  echo Setelah itu buka terminal baru.
  pause
  exit /b 1
)
if not exist ".env" copy /Y ".env.example" ".env" >nul
if not exist "vendor\autoload.php" (
  echo Menginstall dependency Composer...
  composer install
  if errorlevel 1 goto :fail
)
findstr /B /C:"APP_KEY=" .env >nul
php artisan key:generate
if errorlevel 1 goto :fail
php artisan migrate --seed
if errorlevel 1 goto :fail
echo.
echo ==============================================
echo SETUP SELESAI
echo ==============================================
echo Login: http://127.0.0.1:8000/login
echo Email : admin@gmail.com
echo Pass  : admin123
echo.
echo Jalankan: php artisan serve
pause
exit /b 0
:fail
echo.
echo [ERROR] Setup gagal. Periksa pesan di atas.
pause
exit /b 1
