<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Poppins:wght@600&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    include "../admin/koneksi.php";
    $nama = $_GET['nama'];
    $sqlm = mysqli_query($kon, "delete from stokmakn where nama = '$nama'");
    $sqlm = mysqli_query($kon, "delete from stokbhn where nama = '$nama'");
    if ($sqlm) {
        echo '<style>
    body {
        background : #b6c4b6; }
    h2 {
        color: black;
        font-family: Poppins;
        text-align:center;
    }  </style>';
        echo "<h2>Data berhasil menghapus</h2>";
    } else {
        echo '<style>
    body {
        background : #b6c4b6; }
    h2 {
        color: black;
        font-family: Poppins;
        text-align:center;
    }  </style>';
        echo "<h2>Gagal menghapus</h2>";
    }
    echo "<META HTTP-EQUIV='Refresh' Content='1; URL=home.php'>";
    ?>

</body>

</html>