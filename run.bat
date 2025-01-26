@echo off
start "Server" /min cmd /k "php artisan serve --host=192.168.56.1 --port=8888"
@REM start "Development" /min cmd /k "npm run dev"
