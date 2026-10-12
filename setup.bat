@echo off
cd /d "%~dp0"
call composer install
if not exist .env copy .env.example .env
call php artisan key:generate
if not exist database\database.sqlite type nul > database\database.sqlite
call php artisan migrate --force --seed
echo.
echo ===== Website: http://127.0.0.1:8000 =====
echo ===== Admin:   http://127.0.0.1:8000/admin =====
echo ===== Login:   admin@leatheraura.pk / ChangeMe123  (change it in Settings after logging in) =====
echo.
start http://127.0.0.1:8000/admin
php artisan serve
