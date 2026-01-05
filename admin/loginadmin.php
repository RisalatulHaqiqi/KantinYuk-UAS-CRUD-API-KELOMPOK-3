<?php
include "../admin/koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login adm</title>
    <link rel="stylesheet" href="stylelogin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">

</head>

<body>
    <div class="form">
        <div class="gambar"><img src="../admin/img/avatar.png" alt=""></div>
        <div class="teks">
            <h1>Administrator</h1>
            <p>Silahkan Login</p>
        </div>
        <!-- Add form tag with action and method attributes -->
        <form action="" method="post">

            <!-- Input fields -->
            <input name="nama" type="text" id="nama" placeholder="Nama">
            <input name="password" type="text" id="password" placeholder="Password">

            <!-- Login button -->
            <input name="login" type="submit" id="login" value="Login">
        </form>

        <?php
        // Your PHP code for handling form submission goes here
        if (isset($_POST["login"])) {
            // Your existing PHP code
            $sqla = mysqli_query($kon, "SELECT * FROM administrator where nama='$_POST[nama]' and password='$_POST[password]'");
            $ra = mysqli_fetch_array($sqla);
            $row = mysqli_num_rows($sqla);
            if ($row > 0) {
                session_start();
                $_SESSION["namaadm"] = $ra["nama"];
                $_SESSION["passwordadm"] = $ra["password"];
                echo '<div style="padding-left: 41em; color:white;">Welcome admin</div>';
                echo "<META HTTP-EQUIV='Refresh' content='1; URL=home.php'>";
            } else {
                echo '<div style="padding-left: 42em; color:white;">Login Gagal</div>';
                echo "<META HTTP-EQUIV='Refresh' content='1; URL=loginadmin.php'>";
            }
        }
        ?>
    </div>
</body>

</html>