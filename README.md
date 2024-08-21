<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Uruchomienie

1. composer install
2. ustawienie odpowiednich uprawnień na katalogu storage/
3. cp .env.example .env - skonfigurowanie połączenia z bazą danych
4. php artisan key:generate - wygenerowanie klucza
5. php artisan migrate - utworzenie tabel w bazie danych
6. php artisan db:seed --class=ProductSeeder
7. npm install && npm run build