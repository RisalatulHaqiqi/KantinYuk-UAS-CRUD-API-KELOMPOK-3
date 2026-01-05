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
    <title>Menu Minuman - KantinYuk</title>
    <link rel="stylesheet" href="style-minuman.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
                <i class='bx bx-drink'></i>
                <h1>Menu Minuman - KantinYuk</h1>
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
        $sqlm = mysqli_query($kon, "SELECT * FROM stokbhn ORDER BY nama ASC");
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
            $category = 'Minuman';
            if (strpos($nama_lower, 'teh') !== false) $category = 'Teh';
            if (strpos($nama_lower, 'kopi') !== false) $category = 'Kopi';
            if (strpos($nama_lower, 'jus') !== false) $category = 'Jus';
            if (strpos($nama_lower, 'susu') !== false) $category = 'Susu';
            if (strpos($nama_lower, 'es') !== false) $category = 'Es';
        ?>
            <div class="menu-card">
                <div class="category-tag"><?= $category ?></div>
                
                <div class="menu-image">
                    <?php if ($image_exists && !empty($rm['foto'])): ?>
                        <img src="img/<?= htmlspecialchars($rm['foto']) ?>" 
                             alt="<?= htmlspecialchars($rm['nama']) ?>"
                             loading="lazy">
                    <?php else: ?>
                        <div class="image-placeholder">
                            <i class='bx bx-drink'></i>
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
                'Pilih minuman favorit Anda dan tambahkan ke keranjang!',
                'Selamat Datang di Menu Minuman KantinYuk 👋'
            );
        }, 1000);
    });
    </script>
</body>
</html>