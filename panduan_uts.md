# PANDUAN UTS

## Pembuatan Website Dinamis UMKM Menggunakan Laravel

### A. Tugas Utama

Membuat website dinamis menggunakan Laravel untuk usaha mikro, kecil,
dan menengah (UMKM), dengan ketentuan berikut:

1.  **Membuat nama PT** yang disesuaikan dengan huruf pertama nama
    masing-masing.
2.  **Membuat logo** sebagai identitas usaha.
3.  **Menjelaskan deskripsi usaha** pada website.

### B. Ketentuan Wajib

1.  **Project Laravel baru**
    -   Membuat project Laravel baru.
    -   Project harus dapat dijalankan menggunakan perintah
        `php artisan serve` tanpa error.
2.  **Database dan migration**
    -   Membuat database.
    -   Membuat migration untuk minimal 2 tabel yang saling berelasi.
    -   Contoh tabel: kategori dan produk, atau layanan dan testimoni.
3.  **Model dan relasi Eloquent**
    -   Membuat Model untuk tabel yang digunakan.
    -   Menerapkan relasi Eloquent antarmodel.
    -   Melakukan pengambilan data melalui Controller.
4.  **Halaman dinamis**
    -   **Halaman publik:** menampilkan daftar produk atau layanan yang
        datanya berasal dari database, serta halaman detail untuk setiap
        item.
    -   **Halaman admin:** menyediakan fitur CRUD sederhana, yaitu
        tambah, ubah, hapus, dan daftar data.
5.  **Upload foto atau gambar produk**
    -   Menyediakan fitur upload foto atau gambar untuk produk.
    -   File gambar disimpan di `storage/public`.
6.  **Validasi form di sisi server**
    -   Menerapkan minimal 3 aturan validasi.
    -   Aturan mencakup:
        -   Data wajib diisi.
        -   Batas maksimal karakter.
        -   Tipe data yang sesuai.
7.  **Tampilan responsif**
    -   Membuat tampilan website yang responsif.
    -   Teknologi yang dapat digunakan: Bootstrap, Tailwind CSS, atau
        CSS sendiri.
8.  **Seeder**
    -   Membuat seeder berisi minimal 5 data contoh.
    -   Data contoh digunakan agar halaman publik tidak kosong.

------------------------------------------------------------------------

**Catatan:** Seluruh ketentuan wajib di atas harus diterapkan dan diuji
pada project Laravel.
