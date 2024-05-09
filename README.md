*PHP VERSION : PHP 8.2.9*

*APACHE VERSION : MySQL Ver 2.4.54*

*DB VERSION : MySQL Ver 8.0.30*

*Framework : Laravel 10.0*

---

Instalasi : 

1. Ketikkan perintah `composer install` atau `composer update` untuk menginstall seluruh dependency
2. Ketikkan `cp env.example .env`  di command lalu edit .env, pada bagian nama database sesuaikan dengan nama db lokal
3. Lalu ketikkan `php artisan migrate:fresh --seed`
4. Jika sudah ketikkan `php artisan key:generate` di command
5. Lalu jalankan projek dengan `php artisan serve` di command

Akun :
```
AKUN ADMIN :
Email : admin@gmail.com
Password : password

AKUN Validator :
Email : validator@gmail.com
Password : password

Untuk lebih lengkapnya lihat di file "DatabaseSeeder.php"
```

Tugas Admin :
Dapat mengelola user, kendaraan, membuat permohonan dan mencetak laporan

Tugas Validator :
Persetujuan permohonan kendaraan

Thanks to :
1. Starter template https://github.com/aleckrh/laravel-sb-admin-2