<?php
include("koneksi.php")
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Poppins:wght@600&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style2.css">
</head>

<body>
    <div class="tombol"><a href="beranda.php">Beranda</a></div>
    <div class="Menu1">
        <p>Menu dari kemitraan</p><br>
        <a class="buttonnn" href="login mitra.php">tambah</a>
    </div>
    <br>

    <?php
    $sqlm = mysqli_query($kon, "select * from menuseller order by nama desc");
    while ($rm = mysqli_fetch_array($sqlm)) {
        echo '<div class="slider-container1">
        <div class="card-slider11";>
            <div class="card1">
                <img src="./img/' . $rm['foto'] . '" alt="">
                <p>' . $rm['nama'] . '</p>
                <p>' . $rm['domisili'] . '</p>
                 <p>' . $rm['menu'] . '</p>
                <p>Rp.' . $rm['price'] . '</p>
                <form action="keranjang.php" method="post">
                 <input type="hidden" name="menu" value="' . $rm['menu'] . ' (Rp. ' . $rm['price'] . ')  ->  (' . $rm['nama'] . ') ">
                 <button type="submit" name="order_button">order</button>  
                <a href="userdel.php?nama=' . $rm['nama'] . '"><i class="bx bxs-trash-alt bx-tada" style="cursor: pointer; color:#6b14da; padding-left: 10px; font-size: x-large;"></i></a>
                </form>                
              
            </div>
        </div>
    </div>';
    }
    ?>
    <!-- Footer -->
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