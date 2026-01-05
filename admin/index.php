<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Ini Latihan</title>
</head>

<body>
    <?php
    include "../admin/koneksi.php";

    // Check if $_GET["p"] is set, otherwise default to "loginadmin"
    $page = isset($_GET["p"]) ? $_GET["p"] : "loginadmin";

    // Include the appropriate file based on the value of $_GET["p"]
    switch ($page) {
        case "home":
            include "home.php";
            break;
        case "useradd":
            include "useradd.php";
            break;
        default:
            include "loginadmin.php";
            break;
    }
    ?>
</body>

</html>
