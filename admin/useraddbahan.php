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
        <h2>Tambahkan bahan-bahan makanan kamu disini</h2>
    </center>
    <br>
    <form id="form2" name="form2" method="post" action="" enctype="multipart/form-data">
        <p>Nama</p>
        <input name="nama" type="text" id="nama" />
        </p>
        <p>Harga</p>
        <input name="harga" type="text" id="harga" />
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
if (isset($_POST["simpan"])) {
    include "../admin/koneksi.php";

    // Make sure to sanitize user inputs to prevent SQL injection
    $nama = mysqli_real_escape_string($kon, $_POST['nama']);
    $harga = mysqli_real_escape_string($kon, $_POST['harga']);

    $nmfoto  = $_FILES["foto"]["name"];
    $lokfoto = $_FILES["foto"]["tmp_name"];

    // Check if a file is selected
    if (!empty($lokfoto)) {
        // Move the uploaded file to a desired directory
        move_uploaded_file($lokfoto, "img/$nmfoto");
    } else {
        // Handle the case where no file is uploaded
        $nmfoto = "";  // Set an empty string or handle it accordingly
    }

    // Use prepared statements to prevent SQL injection
    $sqlm = mysqli_prepare($kon, "INSERT INTO stokbhn (nama, harga, foto) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($sqlm, 'sss', $nama, $harga, $nmfoto);
    $sqlm_exec = mysqli_stmt_execute($sqlm);

    if ($sqlm_exec) {
        echo "Data Gerai berhasil disimpan";
        echo "<META HTTP-EQUIV='Refresh' Content='1; URL=home.php'>";
    } else {
        echo "Gagal menyimpan";
    }

    // Close the prepared statement
    mysqli_stmt_close($sqlm);
}
?>

    </div>
</body>

</html>