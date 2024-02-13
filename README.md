```markdown
# Instalasi Laravel

Berikut adalah langkah-langkah untuk menginstal dan menjalankan Laravel di proyek Anda.

## Langkah 1: Install Dependencies

Jalankan perintah berikut untuk menginstal semua dependencies menggunakan Composer:

```bash
composer install
```

## Langkah 2: Konfigurasi .env

Duplikat file `.env.example` menjadi `.env` dan konfigurasi `APP_URL` dan detail koneksi database sesuai dengan kebutuhan Anda.

```bash
cp .env.example .env
```

## Langkah 3: Migrate Database

Jalankan perintah migrasi untuk membuat tabel-tabel database:

```bash
php artisan migrate
```

## Langkah 4: Jalankan Server

Terakhir, jalankan server Laravel menggunakan perintah:

```bash
php artisan serve
```

Server akan berjalan di [http://localhost:8000](http://localhost:8000) secara default.

Pastikan untuk memeriksa dokumentasi resmi Laravel untuk informasi lebih lanjut: [Laravel Documentation](https://laravel.com/docs).
