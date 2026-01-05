<?php
session_start();
include "../admin/koneksi.php";

// Menghitung total item keranjang untuk header (opsional)
$total_cart_items = 0;
if (isset($_SESSION['keranjang'])) {
    foreach ($_SESSION['keranjang'] as $item) {
        $total_cart_items += (isset($item['jumlah']) ? $item['jumlah'] : 0);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - KantinYuk</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        /* Desain Background & Layout Utama */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            margin: 0;
        }

        /* Header Modern */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 25px;
            background: white;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        /* Judul Seksi */
        .section-title {
            background: rgba(255, 255, 255, 0.9);
            padding: 15px 20px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 25px 0 15px 0;
            backdrop-filter: blur(5px);
        }

        /* Tombol Tambah Data */
        .button-add {
            text-decoration: none;
            background: #2ecc71;
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            transition: 0.3s;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .button-add:hover { background: #27ae60; transform: scale(1.05); }

        /* Grid Kartu */
        .menu-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        /* Desain Kartu */
        .menu-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        .menu-card:hover { transform: translateY(-8px); }

        .menu-image {
            width: 100%;
            height: 170px;
            object-fit: cover;
        }

        .menu-content { padding: 18px; }
        .menu-name { font-size: 17px; font-weight: 700; color: #2c3e50; margin-bottom: 5px; }
        .menu-price { color: #e74c3c; font-weight: 800; font-size: 19px; margin-bottom: 15px; }

        /* Area Tombol Edit & Hapus */
        .action-area {
            display: flex;
            gap: 10px;
        }

        .btn-edit {
            flex: 2;
            background: #3498db;
            color: white;
            padding: 10px;
            border-radius: 10px;
            text-align: center;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            transition: 0.3s;
        }
        .btn-edit:hover { background: #2980b9; }

        .btn-delete {
            flex: 1;
            background: #ff7675;
            color: white;
            padding: 10px;
            border-radius: 10px;
            text-align: center;
            text-decoration: none;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn-delete:hover { background: #d63031; }

    </style>
</head>

<body>

    <div class="header">
        <div class="logo">
            <h1 style="font-size: 22px; margin:0; color: #2c3e50;">
                <i class='bx bxs-dashboard' style="color: #667eea;"></i> Admin KantinYuk
            </h1>
        </div>
        <div style="display: flex; gap: 15px; align-items: center;">
            <a href="beranda.php" style="text-decoration:none; color:#764ba2; font-weight:600;">
                <i class='bx bx-log-out-circle'></i> Keluar
            </a>
        </div>
    </div>

    <div class="section-title">
        <h3 style="margin:0; font-size: 18px;">🍔 Daftar Makanan</h3>
        <a class="button-add" href="useraddmakanan.php">
            <i class='bx bx-plus-circle'></i> Tambah Makanan
        </a>
    </div>

    <div class="menu-container">
        <?php
        $sqlm = mysqli_query($kon, "SELECT * FROM stokmakn ORDER BY nama ASC");
        while ($rm = mysqli_fetch_array($sqlm)) {
        ?>
            <div class="menu-card">
                <img src="./img/<?php echo $rm['foto']; ?>" class="menu-image" alt="foto makanan">
                <div class="menu-content">
                    <div class="menu-name"><?php echo $rm['nama']; ?></div>
                    <div class="menu-price">Rp <?php echo number_format($rm['harga'], 0, ',', '.'); ?></div>
                    <div class="action-area">
                        <a href="usereditmakanan.php?id=<?php echo $rm['nama']; ?>" class="btn-edit">
                            <i class='bx bx-edit-alt'></i> Edit
                        </a>
                        <a href="userdel.php?nama=<?php echo $rm['nama']; ?>" class="btn-delete" onclick="return confirm('Hapus makanan ini?')">
                            <i class='bx bx-trash'></i>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="section-title">
        <h3 style="margin:0; font-size: 18px;">🥤 Daftar Minuman</h3>
        <a class="button-add" href="useraddminuman.php">
            <i class='bx bx-plus-circle'></i> Tambah Minuman
        </a>
    </div>

    <div class="menu-container">
        <?php
        // Menggunakan tabel stokminuman
        $sqlb = mysqli_query($kon, "SELECT * FROM stokbhn ORDER BY nama ASC");
        if(mysqli_num_rows($sqlb) > 0) {
            while ($rb = mysqli_fetch_array($sqlb)) {
            ?>
                <div class="menu-card">
                    <img src="./img/<?php echo $rb['foto']; ?>" class="menu-image" alt="foto minuman">
                    <div class="menu-content">
                        <div class="menu-name"><?php echo $rb['nama']; ?></div>
                        <div class="menu-price">Rp <?php echo number_format($rb['harga'], 0, ',', '.'); ?></div>
                        <div class="action-area">
                            <a href="usereditminuman.php?id=<?php echo $rb['nama']; ?>" class="btn-edit">
                                <i class='bx bx-edit-alt'></i> Edit
                            </a>
                            <a href="userdelminuman.php?nama=<?php echo $rb['nama']; ?>" class="btn-delete" onclick="return confirm('Hapus minuman ini?')">
                                <i class='bx bx-trash'></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php 
            }
        } else {
            echo "<p style='color: white; grid-column: 1/-1; text-align: center;'>Belum ada data minuman.</p>";
        }
        ?>
    </div>

</body>
</html>