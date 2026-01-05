<?php
session_start();
include "koneksi.php";

// Inisialisasi keranjang jika belum ada
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

// Hitung total item di keranjang
$total_cart_items = 0;
foreach ($_SESSION['keranjang'] as $item) {
    $total_cart_items += $item['jumlah'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Makanan - KantinYuk Resto</title>
    <link rel="stylesheet" href="style2.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        /* Reset & Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            /* BACKGROUND BIRU ASLI */
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        /* Header dengan Cart */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            position: relative;
            z-index: 10;
        }
        
        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .back-to-home {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.2);
        }
        
        .back-to-home:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.3);
            background: linear-gradient(135deg, #2980b9 0%, #3498db 100%);
        }
        
        .back-to-home i {
            font-size: 20px;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .logo i {
            font-size: 28px;
            color: #3498db;
        }
        
        .logo h1 {
            font-size: 24px;
            color: #2c3e50;
            font-weight: 700;
        }
        
        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .cart-icon {
            position: relative;
            text-decoration: none;
            background: #f8f9fa;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            border: 2px solid #3498db;
        }
        
        .cart-icon:hover {
            background: #3498db;
            transform: scale(1.1);
        }
        
        .cart-icon i {
            font-size: 24px;
            color: #3498db;
            transition: all 0.3s;
        }
        
        .cart-icon:hover i {
            color: white;
        }
        
        .cart-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ff4757;
            color: white;
            font-size: 12px;
            font-weight: bold;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(255, 71, 87, 0.3);
        }
        
        /* Menu Container */
        .menu-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }
        
        /* Menu Card */
        .menu-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
        }
        
        .menu-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        }
        
        .menu-image {
            width: 100%;
            height: 200px;
            overflow: hidden;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .menu-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        
        .menu-card:hover .menu-image img {
            transform: scale(1.1);
        }
        
        .menu-content {
            padding: 20px;
        }
        
        .menu-name {
            font-size: 20px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        
        .menu-price {
            font-size: 22px;
            font-weight: 800;
            color: #e74c3c;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        
        .menu-price::before {
            content: 'Rp ';
            font-size: 16px;
            color: #95a5a6;
            margin-right: 2px;
        }
        
        /* Order Button */
        .order-btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        
        .order-btn-default {
            /* TOMBOL BIRU */
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
        }
        
        .order-btn-default:hover {
            background: linear-gradient(135deg, #2980b9 0%, #3498db 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(52, 152, 219, 0.3);
        }
        
        .order-btn-added {
            background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
            color: white;
        }
        
        .order-btn-added:hover {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
        }
        
        /* CUSTOM NOTIFICATION SYSTEM */
        .notification-container {
            position: fixed;
            top: 100px;
            right: 30px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 15px;
            max-width: 400px;
        }
        
        .notification {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            gap: 15px;
            animation: slideInRight 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            border-left: 5px solid #2ecc71;
            max-width: 400px;
            opacity: 1;
            transform: translateX(0);
            transition: all 0.3s ease;
        }
        
        .notification.hiding {
            opacity: 0;
            transform: translateX(100%);
        }
        
        .notification.error {
            border-left-color: #e74c3c;
        }
        
        .notification.warning {
            border-left-color: #f39c12;
        }
        
        .notification.info {
            border-left-color: #3498db;
        }
        
        .notification-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        
        .notification.success .notification-icon {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
        }
        
        .notification.error .notification-icon {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
        }
        
        .notification.warning .notification-icon {
            background: linear-gradient(135deg, #f39c12, #e67e22);
        }
        
        .notification.info .notification-icon {
            background: linear-gradient(135deg, #3498db, #2980b9);
        }
        
        .notification-icon i {
            font-size: 24px;
            color: white;
        }
        
        .notification-content {
            flex: 1;
        }
        
        .notification-title {
            font-size: 18px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 5px;
        }
        
        .notification-message {
            font-size: 15px;
            color: #7f8c8d;
            line-height: 1.5;
        }
        
        .notification-close {
            background: none;
            border: none;
            color: #95a5a6;
            font-size: 20px;
            cursor: pointer;
            padding: 5px;
            transition: color 0.3s;
        }
        
        .notification-close:hover {
            color: #e74c3c;
        }
        
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        /* Progress Bar for Auto-hide */
        .notification-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 4px;
            background: rgba(46, 204, 113, 0.8);
            width: 100%;
            border-radius: 0 0 15px 15px;
            animation: progress 5s linear forwards;
        }
        
        .notification.error .notification-progress {
            background: rgba(231, 76, 60, 0.8);
        }
        
        @keyframes progress {
            from {
                width: 100%;
            }
            to {
                width: 0%;
            }
        }
        
        /* Responsive Design */
        @media (max-width: 1200px) {
            .menu-container {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            }
        }
        
        @media (max-width: 768px) {
            body {
                padding: 15px;
            }
            
            .header {
                padding: 12px 15px;
                margin-bottom: 20px;
                flex-direction: column;
                gap: 15px;
            }
            
            .header-left {
                width: 100%;
                justify-content: space-between;
            }
            
            .header-right {
                width: 100%;
                justify-content: center;
            }
            
            .logo h1 {
                font-size: 20px;
            }
            
            .menu-container {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 20px;
            }
            
            .notification-container {
                top: 150px;
                right: 15px;
                left: 15px;
                max-width: none;
            }
            
            .notification {
                max-width: none;
            }
        }
        
        @media (max-width: 480px) {
            .menu-container {
                grid-template-columns: 1fr;
            }
            
            .header-left {
                flex-direction: column;
                gap: 10px;
            }
            
            .back-to-home {
                width: 100%;
                justify-content: center;
            }
            
            .logo {
                justify-content: center;
            }
        }
        
        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* Additional Blue Accents */
        .menu-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #3498db, #2980b9);
            border-radius: 20px 20px 0 0;
        }
        
        .category-tag {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(52, 152, 219, 0.9);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            z-index: 2;
        }
    </style>
</head>
<body>
    <!-- Header dengan tombol kembali ke beranda -->
    <div class="header">
        <div class="header-left">
            <a href="beranda.php" class="back-to-home">
                <i class='bx bx-home'></i>
                <span>Kembali ke Beranda</span>
            </a>
            
            <div class="logo">
                <i class='bx bx-restaurant'></i>
                <h1>Menu Makanan - KantinYuk</h1>
            </div>
        </div>
        
        <div class="header-right">
            <a href="keranjang/index.php" class="cart-icon">
                <i class='bx bxs-cart-alt'></i>
                <span class="cart-count" id="cart-count"><?= $total_cart_items ?></span>
            </a>
        </div>
    </div>
    
    <!-- Notification Container -->
    <div class="notification-container" id="notificationContainer"></div>
    
    <!-- Menu Items -->
    <div class="menu-container">
        <?php
        $sqlm = mysqli_query($kon, "SELECT * FROM stokmakn ORDER BY nama ASC");
        while ($rm = mysqli_fetch_array($sqlm)) {
            // Cek apakah item sudah ada di keranjang
            $in_cart = false;
            $cart_qty = 0;
            $item_key = md5($rm['nama']);
            
            if (isset($_SESSION['keranjang'][$item_key])) {
                $in_cart = true;
                $cart_qty = $_SESSION['keranjang'][$item_key]['jumlah'];
            }
            
            // Cek apakah file gambar ada
            $image_file = "img/" . $rm['foto'];
            $image_exists = file_exists($image_file);
            
            // Tentukan kategori
            $nama_lower = strtolower($rm['nama']);
            $category = 'Makanan';
            if (strpos($nama_lower, 'nasi') !== false) $category = 'Nasi';
            if (strpos($nama_lower, 'mie') !== false) $category = 'Mie';
            if (strpos($nama_lower, 'gado') !== false || strpos($nama_lower, 'pecel') !== false) $category = 'Salad';
            if (strpos($nama_lower, 'gorengan') !== false) $category = 'Snack';
        ?>
            <div class="menu-card">
                <div class="category-tag"><?= $category ?></div>
                
                <div class="menu-image">
                    <?php if ($image_exists && !empty($rm['foto'])): ?>
                        <img src="img/<?= htmlspecialchars($rm['foto']) ?>" 
                             alt="<?= htmlspecialchars($rm['nama']) ?>"
                             loading="lazy">
                    <?php else: ?>
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#f8f9fa;color:#95a5a6;">
                            <i class='bx bx-food-menu' style="font-size:60px;"></i>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="menu-content">
                    <h3 class="menu-name"><?= htmlspecialchars($rm['nama']) ?></h3>
                    <div class="menu-price"><?= number_format($rm['harga'], 0, ',', '.') ?></div>
                    
                    <button onclick="addToCart('<?= addslashes($rm['nama']) ?>', <?= $rm['harga'] ?>)" 
                            class="order-btn <?= $in_cart ? 'order-btn-added' : 'order-btn-default' ?>"
                            id="btn-<?= $item_key ?>">
                        <?php if ($in_cart): ?>
                            <i class='bx bx-check-circle'></i>
                            <span>Ditambahkan (<?= $cart_qty ?>)</span>
                        <?php else: ?>
                            <i class='bx bx-cart-add'></i>
                            <span>Tambah ke Keranjang</span>
                        <?php endif; ?>
                    </button>
                </div>
            </div>
        <?php } ?>
    </div>

    <script>
    // Notification System
    class NotificationSystem {
        constructor() {
            this.container = document.getElementById('notificationContainer');
            this.notifications = [];
        }
        
        show(type, title, message, duration = 5000) {
            const notificationId = 'notification-' + Date.now();
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.id = notificationId;
            
            // Icon based on type
            let icon = 'bx-check-circle';
            switch(type) {
                case 'error': icon = 'bx-error-alt'; break;
                case 'warning': icon = 'bx-error'; break;
                case 'info': icon = 'bx-info-circle'; break;
                default: icon = 'bx-check-circle';
            }
            
            notification.innerHTML = `
                <div class="notification-icon">
                    <i class='bx ${icon}'></i>
                </div>
                <div class="notification-content">
                    <div class="notification-title">${title}</div>
                    <div class="notification-message">${message}</div>
                </div>
                <button class="notification-close" onclick="notificationSystem.close('${notificationId}')">
                    <i class='bx bx-x'></i>
                </button>
                <div class="notification-progress"></div>
            `;
            
            this.container.appendChild(notification);
            
            // Store notification info
            const notificationInfo = {
                id: notificationId,
                element: notification,
                timeout: null
            };
            
            this.notifications.push(notificationInfo);
            
            // Auto close after duration
            if (duration > 0) {
                notificationInfo.timeout = setTimeout(() => {
                    this.close(notificationId);
                }, duration);
            }
            
            // Limit number of notifications
            if (this.notifications.length > 3) {
                this.close(this.notifications[0].id);
            }
            
            return notificationId;
        }
        
        close(notificationId) {
            const notificationIndex = this.notifications.findIndex(n => n.id === notificationId);
            
            if (notificationIndex !== -1) {
                const notification = this.notifications[notificationIndex];
                
                // Clear timeout if exists
                if (notification.timeout) {
                    clearTimeout(notification.timeout);
                }
                
                // Add hiding class for animation
                notification.element.classList.add('hiding');
                
                // Remove from DOM after animation
                setTimeout(() => {
                    if (notification.element.parentNode) {
                        notification.element.parentNode.removeChild(notification.element);
                    }
                }, 300);
                
                // Remove from array
                this.notifications.splice(notificationIndex, 1);
            }
        }
        
        success(message, title = 'Berhasil! 🎉') {
            return this.show('success', title, message);
        }
        
        error(message, title = 'Gagal 😞') {
            return this.show('error', title, message);
        }
        
        warning(message, title = 'Peringatan ⚠️') {
            return this.show('warning', title, message);
        }
        
        info(message, title = 'Informasi ℹ️') {
            return this.show('info', title, message);
        }
        
        clearAll() {
            this.notifications.forEach(notification => {
                this.close(notification.id);
            });
        }
    }
    
    // Initialize notification system
    const notificationSystem = new NotificationSystem();
    
    // Update cart count
    function updateCartCount(count) {
        document.getElementById('cart-count').textContent = count;
    }
    
    // Add to cart function
    function addToCart(nama, harga) {
        const button = event.target.closest('.order-btn');
        const originalContent = button.innerHTML;
        
        // Show loading state
        button.innerHTML = '<div class="loading"></div><span style="margin-left: 10px;">Memproses...</span>';
        button.disabled = true;
        
        const fd = new FormData();
        fd.append('nama', nama);
        fd.append('harga', harga);
        
        fetch('keranjang/tambahkeranjang.php', { 
            method: 'POST', 
            body: fd 
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('Response:', data);
            
            if (data.status === 'success') {
                // Update cart count
                updateCartCount(data.total_item);
                
                // Show success notification
                notificationSystem.success(
                    `${nama} berhasil ditambahkan ke keranjang.`,
                    'Yeay! 🛒'
                );
                
                // Change button state
                button.className = 'order-btn order-btn-added';
                button.innerHTML = `<i class='bx bx-check-circle'></i><span>Ditambahkan (${data.total_item - <?= $total_cart_items ?> + 1})</span>`;
                
                // Reload page after 1.5 seconds to fully sync
                setTimeout(() => {
                    location.reload();
                }, 1500);
            } else {
                // Show error notification
                notificationSystem.error(
                    data.message || 'Gagal menambahkan item ke keranjang.',
                    'Oops! ❌'
                );
                
                // Reset button
                button.innerHTML = originalContent;
                button.disabled = false;
            }
        })
        .catch(err => {
            console.error('Error:', err);
            
            // Show error notification
                notificationSystem.error(
                'Terjadi kesalahan pada sistem. Silakan coba lagi.',
                'Koneksi Error 📡'
            );
            
            // Reset button
            button.innerHTML = originalContent;
            button.disabled = false;
        });
    }
    
    // Close notification when clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.notification')) {
            const notifications = document.querySelectorAll('.notification');
            notifications.forEach(notification => {
                const notificationId = notification.id;
                setTimeout(() => notificationSystem.close(notificationId), 100);
            });
        }
    });
    
    // Welcome notification on page load
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            notificationSystem.info(
                'Pilih makanan favorit Anda dan tambahkan ke keranjang!',
                'Selamat Datang di Menu KantinYuk 👋'
            );
        }, 1000);
    });
    </script>
</body>
</html>