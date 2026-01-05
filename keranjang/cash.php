<?php
session_start();

$total = 0;
if (!empty($_SESSION['keranjang'])) {
    foreach ($_SESSION['keranjang'] as $item) {
        $total += $item['harga'] * $item['jumlah'];
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran Cash</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            margin: 0;
            height: 100vh;
            background: rgba(46, 55, 154, 0.95);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            width: 100%;
            max-width: 520px;
            padding: 45px;
            border-radius: 24px;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(14px);
            box-shadow: 0 25px 60px rgba(0,0,0,0.35);
            color: #fff;
            text-align: center;
        }

        .card h2 {
            font-size: 30px;
            margin-bottom: 10px;
        }

        .total {
            font-size: 18px;
            margin-bottom: 30px;
        }

        .total strong {
            font-size: 26px;
            color: #ffd54f;
        }

        .info {
            font-size: 15px;
            line-height: 1.6;
            opacity: 0.9;
            margin-bottom: 40px;
        }

        .btn-confirm {
            width: 100%;
            padding: 16px;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, #ffd54f, #ffb300);
            color: #333;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-bottom: 15px;
            transition: 0.3s;
        }

        .btn-confirm:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255,213,79,0.45);
        }

        .btn-back {
            background: none;
            border: none;
            color: rgba(255,255,255,0.85);
            font-size: 14px;
            cursor: pointer;
        }

        .btn-back:hover {
            text-decoration: underline;
            color: #fff;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Pembayaran Cash</h2>

    <p class="total">
        Total Pembayaran<br>
        <strong>Rp <?= number_format($total,0,',','.') ?></strong>
    </p>

    <p class="info">
        Silakan lakukan pembayaran secara <b>tunai</b> langsung ke kasir kantin.
        Setelah pembayaran diterima, tekan tombol konfirmasi di bawah.
    </p>

    <button class="btn-confirm" onclick="confirmCash()">
        Saya Sudah Membayar
    </button>

    <button class="btn-back" onclick="window.location.href='keranjang.php'">
        Batalkan Transaksi
    </button>
</div>

<script>
function confirmCash() {
    fetch('updatekeranjang.php', {
        method: 'POST',
        body: new URLSearchParams({
            action: 'clear',
            payment_method: 'cash'
        })
    }).then(() => {
        window.location.href = 'succes.php';
    });
}
</script>

</body>
</html>
