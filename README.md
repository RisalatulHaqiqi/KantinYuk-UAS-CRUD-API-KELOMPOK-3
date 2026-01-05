UAS-CRUD-API-KELOMPOK-3

KantinYuk adalah aplikasi website pemesanan makanan dan minuman berbasis web yang dilengkapi dengan RESTful API. Aplikasi ini memungkinkan pengguna melihat menu, menambahkan item ke keranjang, memperbarui jumlah pesanan, hingga menghapus item dari keranjang. RESTful API disediakan agar pihak eksternal (mobile app, sistem kasir, aplikasi lain, atau tools testing) dapat mengakses dan mengelola data dari sistem KantinYuk. Proyek ini dikembangkan sebagai Project Akhir mata kuliah yang berkaitan dengan pengembangan web dan REST API.

Proyek ini dibuat untuk:

1. Menerapkan konsep CRUD (Create, Read, Update, Delete)
2. Mengimplementasikan RESTful API
3. Memungkinkan integrasi dengan pihak ketiga
4. Melatih pemahaman arsitektur web berbasis layanan (service-based architecture)

Teknologi yang Digunakan:
1. PHP Native
2. MySQL
3. HTML, CSS, JavaScript
4. RESTful API
5. Talend API Tester (pengujian endpoint API)
6. Apache (XAMPP / Laragon)

Fitur Aplikasi
1. Website Menampilkan daftar menu makanan & minuman (READ) Menambahkan item ke keranjang (CREATE) Mengubah jumlah item dalam keranjang (UPDATE) Menghapus item dari keranjang (DELETE) Menampilkan total harga pesanan (READ)
2. RESTful API (Keranjang) Menambahkan item ke keranjang Melihat isi keranjang Memperbarui jumlah item Menghapus item dari keranjang Mengosongkan keranjang API ini bisa langsung dipakai untuk:
3. Mobile application Sistem kasir Pengujian API Integrasi sistem lain
Cara Menjalankan Proyek

Clone repository ini
1. Pindahkan folder ke direktori server (htdocs atau www)
2. Import database MySQL
3. Atur koneksi database di file konfigurasi
4. Jalankan server Apache & MySQL
5. Akses melalui browser
6, Pengujian API Gunakan Talend API Tester dengan Endpoint API Base URL: http://localhost/kantinyuenpi/api/keranjang/api_Keranjang.php

Tim Pengembang:

1. Risalatul Haqiqi Fauziyah (2413030004)
2. Febrina Firdanatasya (2413030006)
3. Delilla Anandita (2413030029)
4. Nensa Aulia (2413030056)
