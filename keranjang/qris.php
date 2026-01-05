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
    <title>Pembayaran QRIS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            margin: 0;
            height: 100vh;
            overflow: hidden;
            background: rgba(46, 55, 154, 0.95)
        }

        .qris-wrapper {
            height: 100vh;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .qris-card {
            width: 100%;
            max-width: 1000px;
            height: 520px;
            display: flex;
            border-radius: 24px;
            overflow: hidden;
            backdrop-filter: blur(14px);
            background: rgba(255,255,255,0.15);
            box-shadow: 0 25px 60px rgba(0,0,0,0.4);
        }

        /* KIRI */
        .qris-left {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(255,255,255,0.25);
        }

        .qris-left img {
            width: 70%;
            max-width: 300px;
            border-radius: 20px;
            background: white;
            padding: 16px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.25);
        }

        /* KANAN */
        .qris-right {
            flex: 1;
            padding: 50px;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .qris-right h2 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .total {
            font-size: 18px;
            margin-bottom: 25px;
            opacity: 0.9;
        }

        .total strong {
            font-size: 26px;
            color: #ffd54f;
        }

        .hint {
            font-size: 15px;
            line-height: 1.6;
            opacity: 0.85;
            margin-bottom: 40px;
        }

        .btn-pay {
            padding: 16px;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, #ffd54f, #ffb300);
            color: #333;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }

        .btn-pay:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255,213,79,0.5);
        }

        .btn-cancel {
            background: none;
            border: none;
            color: rgba(255,255,255,0.8);
            font-size: 14px;
            cursor: pointer;
            align-self: flex-start;
        }

        .btn-cancel:hover {
            text-decoration: underline;
            color: #fff;
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            body {
                overflow: auto;
            }

            .qris-card {
                flex-direction: column;
                height: auto;
            }

            .qris-left {
                padding: 40px 0;
            }

            .qris-right {
                padding: 35px;
            }
        }
    </style>
</head>
<body>

<div class="qris-wrapper">
    <div class="qris-card">
        <div class="qris-left">
            <img src="../img/qris.jpeg" alt="QRIS">
        </div>

        <div class="qris-right">
            <h2>Scan QRIS</h2>

            <p class="total">
                Total Pembayaran<br>
                <strong>Rp <?= number_format($total, 0, ',', '.') ?></strong>
            </p>

            <p class="hint">
                Silakan scan kode QR di samping menggunakan aplikasi e-wallet atau
                mobile banking Anda untuk menyelesaikan pembayaran.
            </p>

            <button class="btn-pay" onclick="finishPayment()">
                Saya Sudah Bayar
            </button>

            <button class="btn-cancel" onclick="window.location.href='keranjang.php'">
                Batalkan Pembayaran
            </button>
        </div>
    </div>
</div>

<script>
function finishPayment() {
    fetch('updatekeranjang.php', {
        method: 'POST',
        body: new URLSearchParams({
            action: 'clear',
            payment_method: 'qris'
        })
    }).then(() => {
        window.location.href = 'succes.php';
    });
}
</script>

</body>
</html>
