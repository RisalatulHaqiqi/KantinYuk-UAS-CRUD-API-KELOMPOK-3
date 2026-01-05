<?php
include "koneksi.php";

$message = "";
$message_type = "";

if (isset($_POST['register'])) {
    // Ambil dan bersihkan data
    $email    = trim($_POST['email']);
    $nama     = trim($_POST['nama']);
    $telepon  = trim($_POST['telepon']);
    $password = $_POST['password'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    // Validasi
    $errors = [];
    
    if (empty($email) || empty($nama) || empty($telepon) || empty($password) || empty($konfirmasi_password)) {
        $errors[] = "Semua field harus diisi!";
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid!";
    }
    
    if ($password !== $konfirmasi_password) {
        $errors[] = "Password tidak cocok!";
    }
    
    if (strlen($password) < 6) {
        $errors[] = "Password minimal 6 karakter!";
    }
    
    // Jika ada error, tampilkan
    if (!empty($errors)) {
        $message = implode("<br>", $errors);
        $message_type = "error";
    } else {
        // CEK EMAIL SUDAH TERDAFTAR
        $stmt = $kon->prepare("SELECT email FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $message = "Email sudah terdaftar!";
            $message_type = "error";
            $stmt->close();
        } else {
            $stmt->close();
            
            $plain_password = $password;
            
            $stmt = $kon->prepare(
                "INSERT INTO user (nama, email, password, telepon)
                 VALUES (?, ?, ?, ?)"
            );
            
            if ($stmt) {
                $stmt->bind_param("ssss", $nama, $email, $plain_password, $telepon);
                
                if ($stmt->execute()) {
                    $message = "Registrasi berhasil! Password disimpan tanpa hash.";
                    $message_type = "success";
                    
                    // Debug: tampilkan password yang disimpan
                    echo "<script>console.log('Password yang disimpan: $plain_password');</script>";
                    
                    // Redirect setelah 3 detik
                    echo '<meta http-equiv="refresh" content="3;url=loginn.php">';
                } else {
                    $message = "Registrasi gagal: " . $stmt->error;
                    $message_type = "error";
                }
                $stmt->close();
            } else {
                $message = "Error prepare statement: " . $kon->error;
                $message_type = "error";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register Admin - KantinYuk</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="loginn.php" class="back-button">
                <span class="back-icon">←</span> Kembali ke Login
            </a>
            <h1 class="nav-title">KantinYuk</h1>
            <div class="nav-menu">
                <a href="beranda.php">Beranda</a>
                <a href="loginn.php">Login</a>
                <a href="tentang.php">Tentang</a>
            </div>
        </div>
    </nav>

    <!-- Register Content -->
    <div class="register-container">
        <div class="register-form-container">
            <h1 class="register-title">Register Admin</h1>

            <?php if (!empty($message)): ?>
                <div class="message <?php echo $message_type; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <form class="register-form" method="post" action="">
                <div class="form-horizontal-container">
                    <div class="form-horizontal-row">
                        <div class="form-horizontal-group">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-input" 
                                       placeholder="Masukkan email anda" 
                                       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" 
                                       required>
                            </div>
                        </div>
                        
                        <div class="form-horizontal-group">
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama" class="form-input" 
                                       placeholder="Masukkan nama lengkap anda" 
                                       value="<?php echo isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : ''; ?>" 
                                       required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-horizontal-row">
                        <div class="form-horizontal-group">
                            <div class="form-group">
                                <label for="telepon">Telepon</label>
                                <input type="tel" id="telepon" name="telepon" class="form-input" 
                                       placeholder="Masukkan nomor telepon anda" 
                                       value="<?php echo isset($_POST['telepon']) ? htmlspecialchars($_POST['telepon']) : ''; ?>" 
                                       required>
                            </div>
                        </div>
                        
                        <div class="form-horizontal-group">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-input" 
                                       placeholder="Masukkan password (min. 6 karakter)" 
                                       required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-horizontal-row">
                        <div class="form-horizontal-group">
                            <div class="form-group">
                                <label for="konfirmasi_password">Confirm Password</label>
                                <input type="password" id="konfirmasi_password" name="konfirmasi_password" 
                                       class="form-input" placeholder="Konfirmasi password anda" required>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="separator">

                <div class="button-container">
                    <button type="submit" name="register" class="register-button">
                        <i class="fas fa-user-plus"></i> Daftar
                    </button>
                
                </div>
            </form>
        </div>
    </div>
</body>
</html>