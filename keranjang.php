 <head>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="stylekeranjang.css">
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Lato&family=Poppins:wght@600&display=swap" rel="stylesheet">
     <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
 </head>

 <body>
     <div class="tombol">
         <a href="beranda.php">Beranda</a>
         <i class='bx bxs-sun bx-spin' id="dark-mode-toggle" style='color:#6616d0; font-size:x-large'></i>
     </div>

     <?php
        session_start(); // Start the session if not already started

        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if it's an order or delete action
            if (isset($_POST['order_button'])) {
                // Get the selected menu item from the form
                $selectedMenu = $_POST['menu'];

                // Initialize or update the shopping cart session variable
                if (!isset($_SESSION['shopping_cart'])) {
                    $_SESSION['shopping_cart'] = array();
                }

                // Add the selected menu item to the shopping cart
                $_SESSION['shopping_cart'][] = array(
                    'menu' => $selectedMenu,
                    'quantity' => 1, // You can set the initial quantity to 1
                );
            } elseif (isset($_POST['delete_button'])) {
                // Check if the item index to delete is set
                if (isset($_POST['delete_item'])) {
                    $keyToDelete = $_POST['delete_item'];

                    // Check if the key exists in the shopping cart
                    if (array_key_exists($keyToDelete, $_SESSION['shopping_cart'])) {
                        // Remove the item from the shopping cart based on its key
                        unset($_SESSION['shopping_cart'][$keyToDelete]);

                        // Reset array keys after deletion
                        $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
                    }
                }
            }
        }

        // Display the items in the shopping cart

        echo '<div style="text-align: center; font-family: Lato;"><h2>Keranjang Belanja</h2></div>';


        if (isset($_SESSION['shopping_cart']) && !empty($_SESSION['shopping_cart'])) {
            echo '<center><table border="1">
        <thead>
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>';

            foreach ($_SESSION['shopping_cart'] as $key => $item) {
                echo '<tr>
            <td>' . $item['menu'] . '</td>
            <td>' . $item['quantity'] . '</td>
           
            <td>
                <form action="keranjang.php" method="post">
                    <input type="hidden" name="delete_item" value="' . $key . '">
                    <button type="submit" name="delete_button">Delete</button>
                </form>
            </td>
          </tr>';
            }
            echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
            echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
            echo '<link href="https://fonts.googleapis.com/css2?family=Lato&family=Poppins:wght@600&display=swap" rel="stylesheet">';
            echo '</tbody></table>';
            echo '<style>
    body {
        background : #b6c4b6; }
    h2 {
        color: #333;
        font-family: Lato;
    }

    table {
        width: 80%;
        border-collapse: collapse;
        margin-top: 20px;
        font-family: Lato;
    }

    td {
        padding: 10px;
        border: 1px solid #6b14da;
        text-align: center;
        background : #ff8b0d;
        color: white;
        font-weight : bold;
    }

    th {
        background-color: #6b14da;
        color: white;
        padding: 10px;
    }

    td button {
        background-color: #dc3545;
        color: #fff;
        border: none;
        padding: 2px 10px;
        cursor: pointer;
        border-radius : 10px;
        font-weight : 800;
        margin-top: 10px;
    }

    td button:hover {
        background-color: #c82333;
    }

    p {
        color: #777;
         font-family: Lato;
    }
</style>';
            echo '</tbody></table></center>';
        } else {
            echo '<div style="text-align: center; font-family: Lato;"><p>Keranjang belanja kamu sekarang kosong</p></div>';
        }

        // Calculate the total quantity of items in the shopping cart
        $totalQuantity = 0;
        foreach ($_SESSION['shopping_cart'] as $item) {
            $totalQuantity += $item['quantity'];
        }

        // Display the total quantity
        echo '<div class="code">';
        echo '<p style="text-align: center; font-family: Lato; font-weight: 600;">Jumlah barang di keranjang : ' . $totalQuantity . '</p>';
        echo '</div>';
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
     <!-- JavaScript -->
     <script src="script.js"></script>
 </body>