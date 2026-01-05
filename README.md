KantinYuk adalah aplikasi website pemesanan makanan dan minuman berbasis web yang dilengkapi dengan RESTful API. Aplikasi ini memungkinkan pengguna melihat menu, menambahkan item ke keranjang, memperbarui jumlah pesanan, hingga menghapus item dari keranjang. RESTful API disediakan agar pihak eksternal (mobile app, sistem kasir, aplikasi lain, atau tools testing) dapat mengakses dan mengelola data dari sistem KantinYuk. Proyek ini dikembangkan sebagai Project Akhir mata kuliah yang berkaitan dengan pengembangan web dan REST API.

Proyek ini dibuat untuk:

Menerapkan konsep CRUD (Create, Read, Update, Delete)
Mengimplementasikan RESTful API
Memungkinkan integrasi dengan pihak ketiga
Melatih pemahaman arsitektur web berbasis layanan (service-based architecture)
Teknologi yang Digunakan:

PHP Native
MySQL
HTML, CSS, JavaScript
RESTful API
Talend API Tester (pengujian endpoint API)
Apache (XAMPP / Laragon)
Fitur Aplikasi

Website Menampilkan daftar menu makanan & minuman (READ) Menambahkan item ke keranjang (CREATE) Mengubah jumlah item dalam keranjang (UPDATE) Menghapus item dari keranjang (DELETE) Menampilkan total harga pesanan (READ)
RESTful API (Keranjang) Menambahkan item ke keranjang Melihat isi keranjang Memperbarui jumlah item Menghapus item dari keranjang Mengosongkan keranjang API ini bisa langsung dipakai untuk:
Mobile application Sistem kasir Pengujian API Integrasi sistem lain
Cara Menjalankan Proyek

Clone repository ini
Pindahkan folder ke direktori server (htdocs atau www)
Import database MySQL
Atur koneksi database di file konfigurasi
Jalankan server Apache & MySQL
Akses melalui browser
Pengujian API Gunakan Talend API Tester dengan Endpoint API Base URL: http://localhost/kantinyuenpi/api/keranjang/api_Keranjang.php

Tim Pengembang:

Risalatul Haqiqi Fauziyah (2413030004)
Febrina Firdanatasya (2413030006)
Delilla Anandita (2413030029)
Nensa Aulia (2413030056)
