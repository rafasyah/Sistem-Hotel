# Aplikasi Pemesanan Kamar Hotel Sederhana
**Uji Kompetensi Sertifikasi BNSP - Skema Junior Web Developer (FR.SKEMA-02-07 / FR.IA.02)**

---

## 📌 Deskripsi Proyek
Aplikasi berbasis web untuk sistem reservasi / pemesanan kamar hotel sederhana yang dibangun sesuai dengan spesifikasi dan instrumen demonstrasi praktik **FR.IA.02 Tugas Praktik Demonstrasi - Junior Web Developer (LSP Telematika / Informatika)**.

Sistem ini melayani pemilihan kamar hotel, simulasi perhitungan tarif pemesanan otomatis dengan ketentuan diskon dan layanan breakfast, validasi input formulir secara menyeluruh, penyimpanan data transaksi ke database, serta penyajian bukti pemesanan / nota resume transaksi.

---

## 🚀 Fitur Aplikasi (Berdasarkan Spesifikasi Dokumen BNSP)

1. **Menu Navigasi Utama:**
   - **Produk:** Menampilkan 3 jenis kamar (**Standar**, **Deluxe**, **Executif / Family**) lengkap dengan foto dan video tur interaktif.
   - **Daftar Harga:** Tabel transparan tarif kamar per malam, kapasitas, fasilitas, serta informasi penawaran khusus diskon.
   - **Tentang Kami:** Uraian profil hotel, alamat lengkap, nomor kontak/telepon, serta alamat email reservasi.
   - **Pesan Kamar:** Formulir pemesanan kamar hotel sesuai struktur antarmuka dialog BNSP.
   - **Data Pesanan:** Rekapitulasi tabel riwayat seluruh data pemesanan yang tersimpan di sistem.

2. **Form Pemesanan & Aturan Validasi:**
   - **Nama Pemesan:** Wajib diisi dengan nama lengkap pemesan.
   - **Jenis Kelamin:** Pilihan radio button *Laki-laki* atau *Perempuan*.
   - **Nomor Identitas:** Wajib 16 digit angka (NIK/KTP). Jika tidak valid, muncul pesan kesalahan: `isian salah..data harus 16 digit`.
   - **Tipe Kamar:** Pilihan *Standar* (Rp 500.000), *Deluxe* (Rp 1.000.000), atau *Family / Executif* (Rp 1.500.000).
   - **Harga:** Terisi otomatis sesuai tarif tipe kamar yang dipilih.
   - **Tanggal Pesan:** Format tanggal (dd/mm/yyyy).
   - **Durasi Menginap:** Wajib diisi angka. Jika bukan angka, muncul pesan: `harus isi angka`.
   - **Termasuk Breakfast:** Checkbox dicentang berarti *Ya* (tambahan biaya Rp 80.000).
   - **Total Bayar:** Terisi otomatis saat pengguna menekan tombol **[Hitung Total Bayar]**.
     - **Ketentuan Diskon:** Jika lama menginap **3 hari atau lebih** (`durasi >= 3`), mendapatkan **diskon 10%** dari subtotal kamar.
     - **Ketentuan Breakfast:** Tambahan tarif sarapan **Rp 80.000 / hari** jika dicentang.
     - **Simulasi Presisi Contoh Kasus Resmi BNSP (Hal. 2 & 3):**
       - Kamar Standar: Rp 500.000 × 3 hari = Subtotal Rp 1.500.000
       - Diskon 10%: − Rp 150.000
       - Breakfast: 3 hari × Rp 80.000 = + Rp 240.000
       - **Total Bayar: Rp 1.590.000** (Tepat dan identik dengan lembar soal demonstrasi)
   - **Aksi Tombol:**
     - `[Hitung Total Bayar]`: Melakukan kalkulasi subtotal, diskon, dan total bayar.
     - `[Simpan]`: Menyimpan data ke database dan menampilkan bukti pemesanan resume.
     - `[Cancel]`: Mengosongkan formulir pemesanan kembali ke kondisi awal.

3. **Penyajian Bukti Pemesanan (Resume Transaksi):**
   - Menampilkan resume transaksi dalam format presisi dokumen BNSP butir C.2.b:
     ```text
     Nama Pemesan      : Andri Santosa
     Nomor Identitas   : 3275091210770004
     Jenis Kelamin     : Laki-laki
     Tipe Kamar        : Standar
     Durasi Penginapan : 3 Hari
     Discount          : 10%
     Total Bayar       : 1.590.000
     ```
   - Dilengkapi fitur cetak nota (*print*) langsung ke format printer atau PDF.

---

## 📁 Struktur Hirarki Direktori & Sumber Daya Pemrograman

```text
pretest_bnsp/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── PesananController.php   # Controller logika bisnis, kalkulasi diskon & CRUD
│   └── Models/
│       └── pesanan.php                 # Model Eloquent data pemesanan kamar hotel
│
├── bootstrap/
│   └── app.php                         # Inisialisasi framework Laravel
│
├── config/                             # Konfigurasi sistem (database, app, session)
│
├── database/
│   ├── migrations/                     # Skema migrasi tabel database 'pesanans'
│   │   ├── 2026_07_21_014628_create_pesanans_table.php
│   │   ├── 2026_07_21_021947_add_tanggal_pesan_to_pesanans_table.php
│   │   └── 2026_07_21_030000_add_discount_to_pesanans_table.php
│   └── seeders/                        # Data awal seeder pesanan untuk demonstrasi
│
├── public/                             # File statis publik (aset gambar, favicon, index.php)
│
├── resources/
│   └── views/
│       ├── welcome.blade.php           # Halaman utama (Hero, Produk, Harga, Tentang Kami, Form & Rekap)
│       └── pesanan/
│           ├── create.blade.php        # Form pemesanan standalone format BNSP Halaman 2
│           ├── show.blade.php          # Tampilan bukti pemesanan format BNSP Halaman 3 (b)
│           ├── edit.blade.php          # Form pembaharuan data pemesanan
│           └── index.blade.php         # Halaman tabel riwayat transaksi & modal invoice
│
├── routes/
│   └── web.php                         # Konfigurasi rute URL aplikasi
│
├── tests/
│   └── Feature/
│       └── HotelBookingTest.php        # Unit & Feature Test otomatis seluruh KUK BNSP
│
├── .env                                # Konfigurasi environment (SQLite/MySQL)
├── composer.json                       # Konfigurasi dependensi package PHP
└── README.md                           # Dokumentasi teknis proyek
```

---

## 🛠️ Persyaratan Lingkungan & Cara Menjalankan

### Persyaratan Minimum:
- **PHP:** Versi 8.2 / 8.3 / 8.4 / 8.5
- **Web Server:** XAMPP / Laragon / Built-in PHP CLI Server
- **Database:** SQLite (default bawaan) atau MySQL

### Langkah Menjalankan Aplikasi:

1. **Migrasi Database:**
   ```bash
   php artisan migrate
   ```

2. **Jalankan Server Lokal:**
   ```bash
   php artisan serve
   ```

3. **Akses di Browser:**
   Buka peramban web dan arahkan ke alamat:
   ```text
   http://127.0.0.1:8000
   ```

4. **Menjalankan Pengujian Otomatis (PHPUnit):**
   ```bash
   php artisan test
   ```
   *Seluruh 9 feature test pengujian validasi, formula hitung total, dan alur aplikasi dinyatakan 100% lulus.*
