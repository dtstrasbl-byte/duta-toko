# PT Duta Jaya Bakery (Duta Bakery)

> **Tugas Ujian Tengah Semester (UTS) — Pemrograman Web II**  
> **Nama Mahasiswa:** Duta Satria Sabil  
> **NPM:** 24312103  
> **Program Studi / Semester:** Informatika / Semester 5  

---

## 📌 Deskripsi Usaha
**PT Duta Jaya Bakery** (brand: *Duta Bakery*) merupakan usaha UMKM yang bergerak di bidang kuliner, khususnya produksi dan penjualan berbagai macam roti dan kue. Duta Bakery menyediakan produk berkualitas dengan cita rasa lezat, harga terjangkau, serta mengutamakan kebersihan dan kepuasan pelanggan. Melalui website ini, pelanggan dapat melihat katalog produk dan informasi setiap roti/kue dengan mudah, serta manajemen dapat mengelola katalog melalui panel admin.

Website dirancang dengan gaya **Minimalism** yang bersih, elegan, responsif, dan mudah digunakan.

---

## ✨ Fitur-Fitur Aplikasi

### 1. Halaman Publik (Pelanggan)
- **Beranda (Home):** Hero banner, profil usaha UMKM, statistik singkat, katalog unggulan, dan keunggulan produk.
- **Katalog Produk:** Daftar produk lengkap dari database dengan filter kategori, pencarian kata kunci, pengurutan harga/nama, serta pagination.
- **Detail Produk:** Foto produk, varian rasa, estimasi berat, harga, deskripsi lengkap, status stok, serta tombol pemesanan langsung via WhatsApp.
- **Tentang Kami:** Sejarah dan visi misi PT Duta Jaya Bakery.
- **Kontak & Lokasi:** Formulir kontak, alamat toko di Bandar Lampung, jam operasional, dan tautan sosial media.

### 2. Halaman Admin (CRUD & Manajemen)
- **Autentikasi Admin:** Proteksi rute admin menggunakan middleware `auth`, session handling, dan fitur remember me.
- **Dashboard Ringkasan:** Statistik total produk, total kategori, stok fisik, produk unggulan, peringatan stok rendah (< 10 pcs), serta aksi cepat.
- **CRUD Produk:**
  - Tambah produk dengan upload gambar ke `storage/app/public/products`.
  - Ubah spesifikasi produk, harga, stok, varian, dan opsi ganti foto.
  - Hapus produk beserta file gambar fisiknya.
- **CRUD Kategori:** Tambah, ubah, dan hapus kategori roti & kue (dilengkapi validasi relasi produk).
- **Validasi Sisi Server (Server-Side Validation):**
  - Minimal 3 aturan: `required`, `max` karakter, dan tipe data (`numeric`, `integer`, validasi file gambar `image|mimes:jpeg,png,webp,svg|max:2048`).

---

## 🔐 Kredensial Login Admin

| Parameter | Kredensial |
|---|---|
| **URL Login** | `http://127.0.0.1:8000/admin/login` |
| **Email** | `admin@dutabakery.com` |
| **Password** | `admin123` |

---

## 🚀 Panduan Menjalankan Project

### 1. Clone Repository
```bash
git clone https://github.com/dtstrasbl-byte/duta-toko.git
cd duta-toko
```

### 2. Install Dependensi PHP (Composer)
```bash
composer install
```

### 3. Konfigurasi Environment
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
*(Di Windows PowerShell: `Copy-Item .env.example .env`)*

Generate Application Key:
```bash
php artisan key:generate
```

### 4. Database & Seeder
Buat database SQLite dan jalankan migrasi beserta data contoh:
```bash
php artisan migrate:fresh --seed
```

### 5. Buat Storage Link (Symlink Gambar)
```bash
php artisan storage:link
```

### 6. Jalankan Server Lokal
```bash
php artisan serve
```
Buka peramban di: [http://127.0.0.1:8000](http://127.0.0.1:8000)

### 7. Menjalankan Unit & Feature Test
```bash
php artisan test
```
*(Seluruh 17 test pengujian fitur dan validasi server-side telah disiapkan dan lulus).*

---

## 🛠️ Teknologi yang Digunakan
- **Framework:** Laravel 11 / 12 (PHP 8.2+)
- **Database:** SQLite / MySQL
- **CSS Framework:** Bootstrap 5.3 & Bootstrap Icons
- **Desain UI:** Minimalism Style (Monokrom, Tipografi Ringan, Clean Whitespace)
- **Testing:** PHPUnit / Pest (17 Feature Tests)
