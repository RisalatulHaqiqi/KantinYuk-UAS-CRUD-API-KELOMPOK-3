<?php
session_start();

// Inisialisasi keranjang jika belum ada
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

// Hitung total
$grand_total = 0;
$total_items = 0;

foreach ($_SESSION['keranjang'] as $item) {
    $grand_total += $item['harga'] * $item['jumlah'];
    $total_items += $item['jumlah'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - PeSaT</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            min-height: 100vh;
        }
        
        .header {
            background: white;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .back-btn {
            color: #333;
            text-decoration: none;
            font-size: 24px;
            margin-right: 15px;
        }
        
        .header h1 {
            font-size: 24px;
            color: #333;
        }
        
        .container {
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .empty-cart {
            text-align: center;
            padding: 50px 20px;
            background: white;
            border-radius: 15px;
            margin-top: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .empty-cart i {
            font-size: 80px;
            color: #ddd;
            margin-bottom: 20px;
        }
        
        .empty-cart p {
            font-size: 18px;
            color: #666;
            margin-bottom: 30px;
        }
        
        .btn-shop {
            background: #6616d0;
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .btn-shop:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 22, 208, 0.3);
        }
        
        .cart-items {
            margin-bottom: 30px;
        }
        
        .cart-item {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: transform 0.2s;
        }
        
        .cart-item:hover {
            transform: translateY(-3px);
        }
        
        .item-info h3 {
            font-size: 18px;
            margin-bottom: 5px;
            color: #333;
        }
        
        .item-price {
            color: #e74c3c;
            font-weight: bold;
            font-size: 16px;
        }
        
        .item-subtotal {
            color: #666;
            font-size: 14px;
            margin-top: 5px;
        }
        
        .item-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .quantity-control {
            display: flex;
            align-items: center;
            background: #f8f9fa;
            padding: 5px 10px;
            border-radius: 20px;
            box-shadow: inset 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .quantity-control button {
            background: white;
            border: 1px solid #ddd;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 16px;
            color: #333;
            transition: all 0.2s;
        }
        
        .quantity-control button:hover {
            background: #6616d0;
            color: white;
            border-color: #6616d0;
        }
        
        .quantity-control span {
            margin: 0 10px;
            font-weight: bold;
            min-width: 20px;
            text-align: center;
        }
        
        .delete-btn {
            background: linear-gradient(135deg, #ff6b6b, #ff5252);
            color: white;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 18px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .delete-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(255, 107, 107, 0.4);
        }
        
        .summary {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 16px;
        }
        
        .total-row {
            font-size: 20px;
            font-weight: bold;
            color: #6616d0;
            border-top: 2px solid #eee;
            padding-top: 15px;
            margin-top: 15px;
        }
        
        .checkout-btn {
            background: linear-gradient(135deg, #6616d0, #8a2be2);
            color: white;
            border: none;
            padding: 18px;
            border-radius: 10px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(102, 22, 208, 0.3);
        }
        
        .checkout-btn:hover {
            background: linear-gradient(135deg, #5a12b8, #7b1fa2);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 22, 208, 0.4);
        }
        
        /* Modal Notifikasi */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s;
        }
        
        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        .modal {
            background: white;
            border-radius: 20px;
            padding: 30px;
            max-width: 400px;
            width: 90%;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            transform: translateY(-20px);
            transition: transform 0.3s;
        }
        
        .modal-overlay.active .modal {
            transform: translateY(0);
        }
        
        .modal-icon {
            font-size: 60px;
            margin-bottom: 20px;
        }
        
        .modal-icon.success {
            color: #4CAF50;
        }
        
        .modal-icon.warning {
            color: #FF9800;
        }
        
        .modal-icon.error {
            color: #f44336;
        }
        
        .modal h3 {
            font-size: 22px;
            margin-bottom: 15px;
            color: #333;
        }
        
        .modal p {
            color: #666;
            margin-bottom: 25px;
            line-height: 1.5;
        }
        
        .modal-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
        }
        
        .modal-btn {
            padding: 12px 30px;
            border-radius: 25px;
            border: none;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s;
            min-width: 120px;
        }
        
        .modal-btn.cancel {
            background: #f5f5f5;
            color: #666;
        }
        
        .modal-btn.cancel:hover {
            background: #e0e0e0;
        }
        
        .modal-btn.confirm {
            background: linear-gradient(135deg, #ff6b6b, #ff5252);
            color: white;
        }
        
        .modal-btn.confirm:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 107, 107, 0.3);
        }
        
        .modal-btn.success {
            background: linear-gradient(135deg, #6616d0, #8a2be2);
            color: white;
        }
        
        .modal-btn.success:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 22, 208, 0.3);
        }

        /* Toast Notifikasi */
        .toast {
            position: fixed;
            top: 100px;
            right: 20px;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            gap: 15px;
            z-index: 999;
            transform: translateX(150%);
            transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            max-width: 350px;
        }
        
        .toast.show {
            transform: translateX(0);
        }
        
        .toast-icon {
            font-size: 24px;
        }
        
        .toast.success {
            border-left: 5px solid #4CAF50;
        }
        
        .toast.error {
            border-left: 5px solid #f44336;
        }
        
        .toast-content {
            flex: 1;
        }
        
        .toast h4 {
            font-size: 16px;
            margin-bottom: 5px;
            color: #333;
        }
        
        .toast p {
            font-size: 14px;
            color: #666;
        }
        
        .toast-close {
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            font-size: 20px;
            padding: 5px;
        }
        
        @media (max-width: 768px) {
            .cart-item {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
            
            .item-actions {
                width: 100%;
                justify-content: space-between;
            }
            
            .modal-buttons {
                flex-direction: column;
            }
            
            .modal-btn {
                width: 100%;
            }
            
            .toast {
                left: 20px;
                right: 20px;
                max-width: none;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="../Menu.php" class="back-btn">
            <i class='bx bx-arrow-back'></i>
        </a>
        <h1>Keranjang Saya</h1>
    </div>
    
    <div class="container">
        <?php if (empty($_SESSION['keranjang'])): ?>
            <div class="empty-cart">
                <i class='bx bx-cart'></i>
                <p>Wah, keranjangmu masih kosong!</p>
                <a href="../Menu.php" class="btn-shop">Cari Makanan</a>
            </div>
        <?php else: ?>
            <div class="cart-items">
                <?php foreach ($_SESSION['keranjang'] as $key => $item): ?>
                    <div class="cart-item">
                        <div class="item-info">
                            <h3><?= htmlspecialchars($item['nama']) ?></h3>
                            <p class="item-price">Rp <?= number_format($item['harga'], 0, ',', '.') ?></p>
                            <p class="item-subtotal">Subtotal: Rp <?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.') ?></p>
                        </div>
                        <div class="item-actions">
                            <div class="quantity-control">
                                <button onclick="updateCart('<?= $item['nama'] ?>', 'minus')">
                                    <i class='bx bx-minus'></i>
                                </button>
                                <span><?= $item['jumlah'] ?></span>
                                <button onclick="updateCart('<?= $item['nama'] ?>', 'plus')">
                                    <i class='bx bx-plus'></i>
                                </button>
                            </div>
                            <button class="delete-btn" onclick="showDeleteModal('<?= htmlspecialchars($item['nama'], ENT_QUOTES) ?>')">
                                <i class='bx bx-trash'></i>
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="summary">
                <div class="summary-row">
                    <span>Total Item</span>
                    <span><?= $total_items ?> Item</span>
                </div>
                <div class="summary-row">
                    <span>Total Harga</span>
                    <span>Rp <?= number_format($grand_total, 0, ',', '.') ?></span>
                </div>
                <div class="summary-row total-row">
                    <span>Total Bayar</span>
                    <span>Rp <?= number_format($grand_total, 0, ',', '.') ?></span>
                </div>
                
                <button class="checkout-btn" onclick="showCheckoutModal()">
                    <span>Bayar Sekarang</span>
                    <i class='bx bx-chevron-right'></i>
                </button>
            </div>
        <?php endif; ?>
    </div>
    
    <!-- Modal Konfirmasi Hapus -->
    <div class="modal-overlay" id="deleteModal">
        <div class="modal">
            <div class="modal-icon warning">
                <i class='bx bx-error-circle'></i>
            </div>
            <h3>Hapus Item?</h3>
            <p id="deleteItemName">Apakah Anda yakin ingin menghapus item ini dari keranjang?</p>
            <div class="modal-buttons">
                <button class="modal-btn cancel" onclick="closeDeleteModal()">Batal</button>
                <button class="modal-btn confirm" onclick="confirmDelete()">Ya, Hapus</button>
            </div>
        </div>
    </div>
    
    <!-- Modal Checkout -->
    <div class="modal-overlay" id="checkoutModal">
        <div class="modal">
            <div class="modal-icon success">
                <i class='bx bx-check-circle'></i>
            </div>
                  <h3>Selesaikan Pembayaran</h3>
<p>Total yang harus dibayar: 
    <strong>Rp <?= number_format($grand_total, 0, ',', '.') ?></strong>
</p>

<div style="text-align:left; margin-top:15px;">
    <p><strong>Pilih Metode Pembayaran</strong></p>

    <label style="display:block; margin:10px 0;">
        <input type="radio" name="payment_method" value="cash">
        💵 Cash (Bayar di Tempat)
    </label>

    <label style="display:block; margin:10px 0;">
        <input type="radio" name="payment_method" value="qris">
        📱 QRIS
    </label>
</div>

<div class="modal-buttons">
    <button class="modal-btn cancel" onclick="closeCheckoutModal()">Nanti</button>
    <button class="modal-btn success" onclick="processCheckout()">Bayar Sekarang</button>
</div>
            </div>
        </div>
    </div>
    
    <!-- Toast Notifikasi -->
    <div class="toast" id="toast">
        <div class="toast-icon">
            <i class='bx bx-check-circle'></i>
        </div>
        <div class="toast-content">
            <h4 id="toastTitle">Sukses!</h4>
            <p id="toastMessage">Item berhasil diperbarui</p>
        </div>
        <button class="toast-close" onclick="hideToast()">
            <i class='bx bx-x'></i>
        </button>
    </div>

    <script>
    let itemToDelete = '';
    
    // Fungsi untuk menampilkan toast notifikasi
    function showToast(type, title, message) {
        const toast = document.getElementById('toast');
        const toastIcon = toast.querySelector('.toast-icon i');
        const toastTitle = document.getElementById('toastTitle');
        const toastMessage = document.getElementById('toastMessage');
        
        // Set tipe toast
        toast.className = 'toast ' + type;
        
        // Set ikon berdasarkan tipe
        if (type === 'success') {
            toastIcon.className = 'bx bx-check-circle';
        } else if (type === 'error') {
            toastIcon.className = 'bx bx-error-circle';
        }
        
        // Set konten
        toastTitle.textContent = title;
        toastMessage.textContent = message;
        
        // Tampilkan toast
        toast.classList.add('show');
        
        // Sembunyikan otomatis setelah 3 detik
        setTimeout(hideToast, 3000);
    }
    
    function hideToast() {
        const toast = document.getElementById('toast');
        toast.classList.remove('show');
    }
    
    // Fungsi untuk modal hapus
    function showDeleteModal(itemName) {
        itemToDelete = itemName;
        const modal = document.getElementById('deleteModal');
        const itemNameElement = document.getElementById('deleteItemName');
        itemNameElement.innerHTML = `Apakah Anda yakin ingin menghapus <strong>"${itemName}"</strong> dari keranjang?`;
        modal.classList.add('active');
    }
    
    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.remove('active');
        itemToDelete = '';
    }
    
    // Fungsi untuk modal checkout
    function showCheckoutModal() {
        const modal = document.getElementById('checkoutModal');
        modal.classList.add('active');
    }
    
    function closeCheckoutModal() {
        const modal = document.getElementById('checkoutModal');
        modal.classList.remove('active');
    }
    
    function updateCart(nama, action) {
        const fd = new FormData();
        fd.append('nama', nama);
        fd.append('action', action);
        
        fetch('updatekeranjang.php', {
            method: 'POST',
            body: fd
        })
        .then(r => r.json())
        .then(data => {
            if (data.status === 'success') {
                showToast('success', 'Berhasil!', data.message || 'Keranjang berhasil diperbarui');
                // Reload halaman setelah 1 detik
                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                showToast('error', 'Gagal!', data.message || 'Gagal memperbarui keranjang');
            }
        })
        .catch(err => {
            console.error('Error:', err);
            showToast('error', 'Error!', 'Terjadi kesalahan saat memperbarui keranjang');
        });
    }
    
    function confirmDelete() {
        if (!itemToDelete) return;
        
        const fd = new FormData();
        fd.append('nama', itemToDelete);
        fd.append('action', 'delete');
        
        fetch('updatekeranjang.php', {
            method: 'POST',
            body: fd
        })
        .then(r => r.json())
        .then(data => {
            if (data.status === 'success') {
                showToast('success', 'Berhasil!', data.message || 'Item berhasil dihapus');
                closeDeleteModal();
                // Reload halaman setelah 1 detik
                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                showToast('error', 'Gagal!', data.message || 'Gagal menghapus item');
                closeDeleteModal();
            }
        })
        .catch(err => {
            console.error('Error:', err);
            showToast('error', 'Error!', 'Terjadi kesalahan saat menghapus item');
            closeDeleteModal();
        });
    }
    
function processCheckout() {
    const method = document.querySelector('input[name="payment_method"]:checked');

    if (!method) {
        showToast('error', 'Perhatian!', 'Silakan pilih metode pembayaran');
        return;
    }

    if (method.value === 'cash') {
        processCashPayment();
    } else if (method.value === 'qris') {
        processQrisPayment();
    }
}

function processCashPayment() {
    showToast('success', 'Cash Dipilih', 'Silakan lakukan pembayaran ke kasir');

    setTimeout(() => {
        const fd = new FormData();
        fd.append('action', 'clear');
        fd.append('payment_method', 'cash');

        fetch('updatekeranjang.php', {
            method: 'POST',
            body: fd
        }).then(() => {
            window.location.href = 'cash.php';
        });
    }, 1500);
}

function processQrisPayment() {
    closeCheckoutModal();

    // redirect ke halaman QRIS
    window.location.href = 'qris.php';
}

    
    // Tutup modal saat klik di luar modal
    document.querySelectorAll('.modal-overlay').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('active');
            }
        });
    });
    
    // Tutup modal dengan tombol ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal-overlay').forEach(modal => {
                modal.classList.remove('active');
            });
        }
    });
    </script>
</body>
</html>