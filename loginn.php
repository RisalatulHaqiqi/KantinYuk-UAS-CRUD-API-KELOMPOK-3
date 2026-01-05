<?php
include "koneksi.php";
session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $kon->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if ($password == $user['password']) {  // Perbandingan langsung
            // Login berhasil
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['email'] = $user['email'];
            
            header("Location: beranda.php");
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Email tidak ditemukan!";
    }
    
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login - KantinYuk</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loginn.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="header-left">
            <a href="beranda.php" class="back-to-home">
                <i class='bx bx-home'></i>
                <span>Kembali ke Beranda</span>
            </a>
            <h1 class="nav-title">KantinYuk</h1>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <div class="form-container">
            <div class="logo-section">
                <div class="welcome-text">
                    <h2>Selamat Datang di KantinYuk</h2>
                    <p>Silahkan Login</p>
                </div>
            </div>

            <!-- Login Form -->
            <form class="login-form" action="" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="form-input" placeholder="Masukkan email Anda" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-input" placeholder="Masukkan password" required>
                </div>
                
                <button type="submit" name="login" class="login-button">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>

            <!-- Register Link -->
            <div class="register-section">
                <p class="register-text">
                    Belum memiliki Akun? 
                    <a href="register.php" class="register-link">Silahkan Register!</a>
                </p>
            </div>

            <?php
            // Your PHP code for handling form submission goes here
            if (isset($_POST["login"])) {
                // Your existing PHP code
                $sqla = mysqli_query($kon, "select * from user where email='$_POST[email]' and password='$_POST[password]'");
                $ra = mysqli_fetch_array($sqla);
                $row = mysqli_num_rows($sqla);
                if ($row > 0) {
                    session_start();
                    $_SESSION["emailpg"] = $ra["email"];
                    $_SESSION["passwordpg"] = $ra["password"];
                    echo '<div style="text-align: center; margin-top: 20px; padding: 10px; background-color: rgba(0, 85, 85, 0.1); border-radius: 10px; color: #005555;">Selamat Datang</div>';
                    echo "<META HTTP-EQUIV='Refresh' content='1; URL=beranda.php'>";
                } else {
                    echo '<div style="text-align: center; margin-top: 20px; padding: 10px; background-color: rgba(218, 20, 107, 0.1); border-radius: 10px; color: #da146b;">Login Gagal. Periksa kembali email dan password.</div>';
                    echo "<META HTTP-EQUIV='Refresh' content='3; URL=loginn.php'>";
                }
            }
            ?>
        </div>
    </div>
</body>

</html>