<?php
$metode = $_GET['metode'] ?? 'cash';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Transaksi Berhasil</title>
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

        .success-card {
            width: 100%;
            max-width: 500px;
            padding: 50px;
            border-radius: 24px;
            background: rgba(255,255,255,0.18);
            backdrop-filter: blur(14px);
            box-shadow: 0 25px 60px rgba(0,0,0,0.35);
            color: #fff;
            text-align: center;
            animation: pop 0.5s ease;
        }

        @keyframes pop {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .icon {
            font-size: 64px;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .desc {
            font-size: 15px;
            opacity: 0.9;
            margin-bottom: 35px;
        }

        .method {
            font-weight: bold;
            color: #ffd54f;
        }

        .btn-home {
            width: 100%;
            padding: 16px;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, #ffd54f, #ffb300);
            color: #333;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-home:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255,213,79,0.45);
        }
    </style>
</head>
<body>

<div class="success-card">
    <div class="icon">✅</div>

    <h2>Transaksi Berhasil</h2>

    <p class="desc">
        Pembayaran menggunakan metode
        <span class="method"><?= strtoupper($metode) ?></span>
        telah berhasil diproses.
    </p>

    <button class="btn-home" onclick="window.location.href='../beranda.php'">
        Kembali ke Beranda
    </button>
</div>

</body>
</html>
