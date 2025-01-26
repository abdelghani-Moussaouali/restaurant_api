@echo off
composer install & copy .env.example .env & php artisan key:generate & php artisan migrate & php artisan db:seed & php artisan storage:link & start cmd /k "php artisan serve"
