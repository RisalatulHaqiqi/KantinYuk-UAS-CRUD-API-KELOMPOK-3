<?php
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bahan Makanan</title>
    <link rel="stylesheet" href="bahan.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Poppins:wght@600&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="tombol"><a href="beranda.php">Beranda</a></div>
    <div class="Menu1">
        <p>Bahan-bahan pangan</p><br>
    </div>
    <!-- Menu bahan pangan -->
    <?php
    $sqlm = mysqli_query($kon, "select * from stokbhn order by harga desc");
    while ($rg = mysqli_fetch_array($sqlm)) {
        echo ' <div class="card-slider1">
        <div class="cardmenu" style="margin-right: 10px;">
                <div class="bulat"><img src="./img/' . $rg['foto'] . '" alt=""></div>
                <p><b>' . $rg['nama'] . '</b></p>
               <p>Rp. ' . $rg['harga'] . '</p>
                <form action="keranjang.php" method="post">
                   <input type="hidden" name="menu" value="' . $rg['nama'] . ' (Rp. ' . $rg['harga'] . ') ">
                 <button type="submit" name="order_button">order</button> 
                </form>
            </div> </div>';
    }
    ?>
    <!--------------------------------------- Footer Section --------------------------------------->
    <footer class="footer_section">
        <div class="footer__container container grid">
            <div class="footer__content">
                <a href="beranda.php" class="footer__logo">
                    <i class="ri-leaf-line footer__logo-icon"></i> PeSaT
                </a>

                <h3 class="footer__title">
                    Subscribe to mendapatkan informasi yang terbaru<br> jangan lupa tekan yaa
                </h3>

                <div class="footer__subscribe">
                    <input type="email" placeholder="Enter your email" class="footer__input">

                    <button class="buttons button--flex footer__button">
                        Subscribe
                    </button>
                </div>
            </div>

            <div class="footer__content">
                <h3 class="footer__title">Kantor</h3>

                <ul class="footer__data">
                    <li class="footer__information">Padang</li>
                    <li class="footer__information">Bukittinggi</li>
                    <li class="footer__information">Pekanbaru</li>
                </ul>
            </div>

            <div class="footer__content">
                <h3 class="footer__title">Hubungi</h3>

                <ul class="footer__data">
                    <li class="footer__information">083801012326</li>

                    <div class="footer__social">
                        <a href="https://www.facebook.com/" class="footer__social-link">
                            <i class="ri-facebook-fill"></i>
                        </a>
                        <a href="https://www.instagram.com/" class="footer__social-link">
                            <i class="ri-instagram-line"></i>
                        </a>
                        <a href="https://twitter.com/" class="footer__social-link">
                            <i class="ri-twitter-fill"></i>
                        </a>
                    </div>
                </ul>
            </div>

            <div class="footer__content">
                <h3 class="footer__title">
                    Jangan Lupa Kunjungi kami yaa
                </h3>

                <div class="footer__cards">
                    <img src="img/whatsapp_2504957.png" alt="" class="footer__card">
                    <img src="img/facebook_2504903.png" alt="" class="footer__card">
                    <img src="img/instagram_2504918.png" alt="" class="footer__card">
                    <img src="img/twitter_5968830.png" alt="" class="footer__card">
                </div>
            </div>
        </div>

        <h3 class="footer__copy">ReyVrs</h3>
    </footer>
</body>

</html>