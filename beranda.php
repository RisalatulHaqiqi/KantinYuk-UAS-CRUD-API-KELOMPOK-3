<?php
include("koneksi.php")
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="beranda.css">
    <title>Beranda</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Poppins:wght@600&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


</head>

<body>
    <div class="containerr">
        <header>
            <nav class="navbar">
                <div class="logo">KantinYuk</div>
                <ul class="nav-list">
                    <li><a href="keranjang/keranjang.php">Keranjang</a></li>
                    <li><a href="loginn.php">Login</a></li>
                    <li><i class='bx bxs-sun bx-spin' id="dark-mode-toggle" style='color:#6616d0; font-size:x-large'></i></li>
                </ul>
                <ul class="nav-list1">
                    <li> <i class='bx bxs-cart-alt' onclick="window.location.href='keranjang.php'" style='color:#6616d0; font-size:x-large'></i></li>
                    <li><i class='bx bxs-user-circle' onclick="window.location.href='loginn.php'" style='color:#6616d0; font-size:x-large'></i></li>
                    <li><i class='bx bxs-sun bx-spin' id="dark-mode-toggle" style='color:#6616d0; font-size:x-large'></i></li>

                </ul>
            </nav>

        </header>
        <div class="text-in-image">
            <img src="./img/Makanan-Khas-Daerah-tiap-Provinsi-di-Indonesia-Serta-Daerah-Asalnya.jpg" alt="">
            <div class="kalimat">
                <p>Selamat datang di Aplikasi KantinYuk </p>
                <a class="button" href="#menu">Lihat Menu</a>
            </div>
        </div>

        <div class="Menu" id="menu">
        </div>
<!-- Kategori Section dengan Background Polos -->
<section class="Kategori-section">
  <div class="Kategori-container">
    <div class="Kategori-title">
      <h2>Kategori Menu</h2>
      <p>Pilih kategori yang ingin Anda jelajahi</p>
    </div>
    
    <div class="Kategori-grid">
      <!-- Kategori Makanan -->
      <div class="Kategori-card">
        <div class="Kategori-icon">🍔</div>
        <h3>Makanan</h3>
        <p>Berbagai pilihan makanan lezat dan bergizi untuk memenuhi kebutuhan nutrisi Anda.</p>
        <a href="menu.php" class="Kategori-button">Lihat Menu</a>
      </div>
      
      <!-- Kategori Minuman -->
      <div class="Kategori-card">
        <div class="Kategori-icon">🥤</div>
        <h3>Minuman</h3>
        <p>Minuman segar dan sehat untuk menemani santapan Anda setiap hari.</p>
        <a href="minuman.php" class="Kategori-button">Lihat Menu</a>
      </div>
    </div>
  </div>
</section>     


 <!--------------------------------------- Footer Section --------------------------------------->
<footer class="footer_section">
    <div class="footer__container container grid">
        <!-- Kolom 1: Logo KantinYuk -->
        <div class="footer__content">
    <a href="beranda.php" class="footer__logo">
        KantinYuk
    </a>
    <p class="footer__tagline">
        Di antara tumpukan tugas dan deadline yang mengejar, ada perut yang butuh dimanja agar tetap sabar.
    </p>
</div>

        <!-- Kolom 2: Lokasi -->
        <div class="footer__content">
            <h3 class="footer__title">Lokasi</h3>
            <ul class="footer__data">
                <li class="footer__information">YuenpiKediri</li>
            </ul>
        </div>

        <!-- Kolom 3: Hubungi -->
        <div class="footer__content">
            <h3 class="footer__title">Hubungi</h3>
            <ul class="footer__data">
                <li class="footer__information">+62 354771503</li>
            </ul>
        </div>

        <!-- Kolom 4: Jangan Lupa Kunjungi kami yaa -->
        <div class="footer__content">
            <h3 class="footer__title">Jangan Lupa Kunjungi kami yaa</h3>
<div class="footer__cards">
    <a href="https://wa.me/62354771503" target="_blank" aria-label="WhatsApp">
        <img src="./img/whatsapp_2504957.png" alt="WhatsApp" class="footer__card">
    </a>

    <a href="https://www.facebook.com/un.pgri/" target="_blank" aria-label="Facebook">
        <img src="./img/facebook_2504903.png" alt="Facebook" class="footer__card">
    </a>

    <a href="https://www.instagram.com/unp.kediri/" target="_blank" aria-label="Instagram">
        <img src="./img/instagram_2504918.png" alt="Instagram" class="footer__card">
    </a>

    <a href="https://twitter.com/" target="_blank" aria-label="Twitter">
        <img src="./img/twitter_5968830.png" alt="Twitter" class="footer__card">
    </a>
</div>

        </div>
    </div>

    <h3 class="footer__copy">RFDN</h3>
</footer>
</div>
<!-- JavaScript -->
<script src="script.js"></script>
</body>
</html>