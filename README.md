# Restaurant App

## Requirement PHP 7 ke atas

Untuk menjalankan proyek Laravel dengan lancar, pastikan sistem Anda memenuhi persyaratan berikut:

1. **PHP 7** atau versi lebih tinggi: Laravel memerlukan PHP 7.3.0 atau yang lebih baru. Pastikan Anda telah menginstal versi PHP yang sesuai pada sistem Anda.

2. **Composer**: Laravel menggunakan Composer untuk mengelola dependensi proyek. Pastikan Anda telah menginstal Composer dan dapat menjalankannya dari baris perintah.

3. **Web Server**: Anda memerlukan web server seperti Apache atau Nginx untuk menjalankan proyek Laravel. Jika Anda ingin menggunakan server pengembangan bawaan, Anda dapat menggunakan perintah `php artisan serve` untuk menjalankannya.

4. **Database**: Pastikan Anda telah menginstal dan mengkonfigurasi database yang didukung oleh Laravel, seperti MySQL, PostgreSQL, SQLite, atau SQL Server.

5. **Ekstensi PHP**: Beberapa ekstensi PHP diperlukan oleh Laravel untuk berfungsi dengan baik, seperti `mbstring`, `dom`, `json`, dan lainnya. Pastikan ekstensi yang dibutuhkan telah diaktifkan di file konfigurasi php.ini Anda.

## Step Instalasi pada Proyek Laravel

Berikut adalah langkah-langkah untuk menginstal dan menjalankan proyek Laravel:

1. **Clone Proyek dari Repositori**

   ```bash
   git clone https://url-repositori/proyek-laravel.git
   cd proyek-laravel```

2.  **Install Dependensi**
   Jalankan perintah berikut untuk menginstal semua dependensi yang diperlukan oleh proyek Laravel menggunakan Composer:
    ```composer install```
    
4.  **Konfigurasi Environment**
    Salin file .env.example menjadi .env:
    ```cp .env.example .env```
    Kemudian, atur konfigurasi lingkungan, seperti pengaturan database, sesuai dengan lingkungan Anda.
    
5.  **Generate Kunci Aplikasi**
    Setiap instalasi Laravel memerlukan kunci aplikasi yang unik. Jalankan perintah berikut untuk menghasilkan kunci aplikasi:
    ```php artisan key:generate```
    
7.  **Migrasi Database**
    Jalankan migrasi database untuk membuat tabel yang diperlukan oleh proyek:
    ```php artisan migrate```
    
8.  **Jalankan Server Pengembangan**
    Untuk menjalankan server pengembangan bawaan Laravel, gunakan perintah:
    ```php artisan serve```
