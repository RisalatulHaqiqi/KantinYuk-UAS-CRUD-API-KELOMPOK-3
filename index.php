<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Ini Latihan</title>
</head>

<body>
    

<?php
include "koneksi.php";

// Check if the "p" key is set in the $_GET array
if (isset($_GET["p"])) {
    $p = $_GET["p"];

    // Use a switch statement for better readability
    switch ($p) {
        case "useradd":
            include "useradd.php";
            break;
        case "login":
            include "loginn.php";
            break;
        case "keranjang":
            include "keranjang.php";
            break;
        case "userdel":
            include "userdel.php";
            break;
        case "login_mitra": // Fix the space issue in the key
            include "login_mitra.php";
            break;
        default:
            include "beranda.php";
            break;
    }
} else {
    // Handle the case when "p" is not set, for example, redirect to a default page
    include "beranda.php";
}
?>
</body>

</html>