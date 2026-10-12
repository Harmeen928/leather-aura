LEATHER AURA (Laravel 12)

Windows: double-click setup.bat
Or manually:
  composer install
  copy .env.example .env        (if .env is missing)
  php artisan key:generate
  type nul > database\database.sqlite
  php artisan migrate --seed
  php artisan serve

Website : http://127.0.0.1:8000
Admin   : http://127.0.0.1:8000/admin
Login   : admin@leatheraura.pk / ChangeMe123   (change it in Settings right away)

From the admin panel you can add/edit/delete product pictures, change phone/address/email and view inquiries.
Uploaded pictures are stored in public/uploads/products/
