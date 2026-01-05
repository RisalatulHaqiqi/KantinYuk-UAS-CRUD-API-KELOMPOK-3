
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - KantinYuk</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
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
        }
        
        .quantity-control button {
            background: none;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 16px;
            color: #333;
        }
        
        .quantity-control span {
            margin: 0 10px;
            font-weight: bold;
            min-width: 20px;
            text-align: center;
        }
        
        .delete-btn {
            background: #ff6b6b;
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
            background: #6616d0;
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
            transition: background 0.3s;
        }
        
        .checkout-btn:hover {
            background: #5a12b8;
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
                            <button class="delete-btn" onclick="deleteCart('<?= $item['nama'] ?>')">
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
                
                <button class="checkout-btn" onclick="checkout()">
                    <span>Bayar Sekarang</span>
                    <i class='bx bx-chevron-right'></i>
                </button>
            </div>
        <?php endif; ?>
    </div>

    <script>
        const API = "http://localhost/kantinyuenpi/api/keranjang";

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
                location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(err => {
            console.error('Error:', err);
            alert('Gagal memperbarui keranjang');
        });
    }
    
    function deleteCart(nama) {
        if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
            const fd = new FormData();
            fd.append('nama', nama);
            fd.append('action', 'delete');
            
            fetch('updatekeranjang.php', {
                method: 'POST',
                body: fd
            })
            .then(r => r.json())
            .then(data => {
                if (data.status === 'success') {
                    location.reload();
                } else {
                    alert(data.message);
                }
            })
            .catch(err => {
                console.error('Error:', err);
                alert('Gagal menghapus item');
            });
        }
    }
    
    function checkout() {
    if (!confirm("Yakin ingin membayar?")) return;

    fetch("../api/keranjang/hapus_semua.php", {
        method: "POST"
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === "success") {
            alert("Pembayaran berhasil!");
            window.location.href = "../Menu.php";
        } else {
            alert("Gagal mengosongkan keranjang");
        }
    });
    }


    </script>
</body>
</html>