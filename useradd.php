<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Untitled Document</title>
    <link rel="stylesheet" href="styleuseradd.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
</head>

<body>
    <center>
        <h2>Tambahkan gerai kamu disini</h2>
    </center>
    <br>
    <form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
        <p>Nama</p>
        <input name="nama" type="text" id="nama" />
        </p>
        <p>Domisili</p>
        <input name="domisili" type="text" id="domisili" />
        </p>
        <p>Menu</p>
        <input name="menu" type="text" id="menu" />
        </p>
        <p>Harga</p>
        <input name="price" type="text" id="price" />
        </p>
        <p>Foto
            <input name="foto" type="file" id="foto" />
        </p>

        <center>
            <p>
                <input name="simpan" type="submit" id="simpan" value="Simpan Data" />
            </p>
        </center>
    </form>
    <br>
    <div style="text-align: center;">

        <?php
        if ($_POST["simpan"]) {
            include "koneksi.php";
            $nmfoto  = $_FILES["foto"]["name"];
            $lokfoto = $_FILES["foto"]["tmp_name"];

            if (!empty($lokfoto)) {
                move_uploaded_file($lokfoto, "img/$nmfoto");
            }

            $sqlm = mysqli_query($kon, "INSERT INTO menuseller (nama, domisili, menu, price, foto) VALUES ('$nama', '$domisili', '$menu', '$price', '$nmfoto')");

            if ($sqlm) {
                echo "Data Gerai berhasil disimpan";
                echo "<META HTTP-EQUIV='Refresh' Content='1; URL=mitra.php'>";
            } else {
                echo "Gagal menyimpan";
            }
            echo "<META HTTP-EQUIV='Refresh' Content='1; URL=mitra.php'>";
        }
        ?>
    </div>
</body>

</html>