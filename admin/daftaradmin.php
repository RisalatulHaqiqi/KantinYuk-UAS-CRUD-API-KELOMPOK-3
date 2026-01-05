<?php
include "../admin/koneksi.php";

if (isset($_POST["daftar"])) {
    $nama = mysqli_real_escape_string($kon, $_POST['nama']);
    // Menggunakan password_hash untuk keamanan standar modern
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

    // Query ke tabel administrator sesuai data Anda
    $sql = "INSERT INTO administrator (nama, password) VALUES ('$nama', '$password')";
    
    if (mysqli_query($kon, $sql)) {
        echo "<script>alert('Pendaftaran Berhasil! Silakan Login.'); window.location.href='loginadmin.php';</script>";
    } else {
        echo "<script>alert('Gagal daftar atau nama sudah digunakan!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Admin - PeSaT</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        :root {
            --bg-gradient: linear-gradient(135deg, #1a237e 0%, #4a148c 100%);
            --accent-pink: #ff4081;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-gradient);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            color: white;
        }
        .login-box {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            padding: 50px;
            border-radius: 40px;
            width: 100%;
            max-width: 400px;
            border: 2px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }
        .input-group { margin-bottom: 20px; text-align: left; }
        .input-group input {
            width: 100%;
            padding: 15px;
            border-radius: 15px;
            border: none;
            outline: none;
            box-sizing: border-box;
            font-weight: 600;
        }
        .btn-action {
            width: 100%;
            padding: 15px;
            background: var(--accent-pink);
            border: none;
            border-radius: 15px;
            color: white;
            font-weight: 800;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-action:hover { transform: scale(1.03); background: #f50057; }
        a { color: var(--accent-pink); text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
<div class="login-box">
    <h1>DAFTAR ADMIN</h1>
    <form method="post">
        <div class="input-group">
            <input type="text" name="nama" placeholder="Masukkan Nama Admin" required>
        </div>
        <div class="input-group">
            <input type="password" name="password" placeholder="Buat Password" required>
        </div>
        <button type="submit" name="daftar" class="btn-action">DAFTAR SEKARANG</button>
    </form>
    <p>Sudah punya akun? <a href="loginadmin.php">Login di sini</a></p>
</div>
</body>
</html>