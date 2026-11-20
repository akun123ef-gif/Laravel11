# Kasir Laravel

Aplikasi kasir Laravel 11 untuk XAMPP/Windows dengan Login Admin, Dashboard, Kategori, Produk, Stok, Transaksi, Pembayaran, Kembalian, Pending/Selesai, dan upload gambar produk.

## 1. Persyaratan
- PHP 8.2+
- Composer
- MySQL/MariaDB (XAMPP)
- PHP extension: `openssl`, `pdo_mysql`, `mbstring`, `fileinfo`, `tokenizer`, `xml/dom`

> Jika `php artisan` menampilkan `Class "DOMDocument" not found`, aktifkan ekstensi DOM/XML pada `C:\xampp\php\php.ini`, lalu buka terminal baru.

## 2. Database
Buat database MySQL bernama `yt_templating` melalui phpMyAdmin, atau ubah `DB_DATABASE` pada `.env` sesuai database Anda.

## 3. Instalasi
```powershell
composer install
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

## 4. Login

Ada dua role user: `admin` dan `kasir`.

| Role | URL | Email | Password | Hak Akses |
|------|-----|-------|----------|-----------|
| Admin | `http://127.0.0.1:8000/login` | `admin@gmail.com` | `admin123` | Dashboard, User, Kategori, Produk, Transaksi |
| Kasir | `http://127.0.0.1:8000/login` | `kasir@gmail.com` | `kasir123` | Hanya Dashboard dan Transaksi |

### Langkah login:
1. Buka browser ke `http://127.0.0.1:8000/login`
2. Masukkan email dan password sesuai tabel di atas
3. Klik tombol **Login**
4. Setelah login, kasir hanya akan melihat menu **Dashboard** dan **Transaksi** di sidebar. Menu User, Kategori, dan Produk disembunyikan untuk kasir.

## 5. Cetak Struk pada Transaksi

Setelah transaksi selesai (status **completed**), Anda dapat mencetak struk:

1. Masuk ke menu **Transaksi**
2. Pilih transaksi yang sudah selesai (badge **Selesai**)
3. Klik tombol **Cetak Struk** (ikon printer, hijau)
4. Struk akan dibuka di tab baru dan langsung siap dicetak (`Ctrl+P`)
5. Struk menampilkan: nomor nota, tanggal, kasir, daftar produk, total, tunai, dan kembalian

Jika transaksi masih **pending**, tombol cetak struk belum muncul karena transaksi belum final.

## 6. Jika `.env` error
Pastikan nama aplikasi memakai tanda kutip karena mengandung spasi:
```env
APP_NAME="Kasir Laravel"
```

Untuk instalasi lokal, session dan cache sudah memakai file sehingga tidak memerlukan tabel session/cache tambahan.

## 6. Warning mysqli
Jika muncul:
```text
Module "mysqli" is already loaded
```
berarti `mysqli` didaftarkan dua kali di `php.ini`. Cari `extension=mysqli` dan sisakan satu baris saja. Warning ini berasal dari konfigurasi PHP, bukan dari kode Laravel.
