<?php
include "../admin/koneksi.php";

// Ambil data lama
if (isset($_GET['id'])) {
    $id_nama = $_GET['id'];
    $query = mysqli_query($kon, "SELECT * FROM stokmakn WHERE nama = '$id_nama'");
    $data = mysqli_fetch_array($query);

    if (!$data) {
        echo "<script>alert('Data tidak ditemukan!'); window.location.href='admin.php';</script>";
        exit;
    }
}

// Logika Update (tetap sama)
if (isset($_POST["update"])) {
    $nama_lama = $_POST['nama_lama'];
    $nama_baru = mysqli_real_escape_string($kon, $_POST['nama']);
    $harga = str_replace(['.', ','], '', $_POST['harga']);
    
    $nmfoto  = $_FILES["foto"]["name"];
    $lokfoto = $_FILES["foto"]["tmp_name"];

    if (!empty($lokfoto)) {
        $fileExtension = strtolower(pathinfo($nmfoto, PATHINFO_EXTENSION));
        $uniqueName = uniqid() . '.' . $fileExtension;
        move_uploaded_file($lokfoto, "../img/" . $uniqueName);
        $foto_final = $uniqueName;
    } else {
        $foto_final = $_POST['foto_lama'];
    }

    $sql = "UPDATE stokmakn SET nama='$nama_baru', harga='$harga', foto='$foto_final' WHERE nama='$nama_lama'";
    
    if (mysqli_query($kon, $sql)) {
        echo "<script>alert('Berhasil diperbarui!'); window.location.href='admin.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu - Colorful & Bold</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        :root {
            /* Biru yang lebih terlihat biru (Royal/Navy Blue) */
            --bg-main: #1a237e; 
            /* Gradasi Ungu/Indigo agar tidak monoton */
            --bg-gradient: linear-gradient(135deg, #1a237e 0%, #4a148c 100%);
            /* Warna Aksen Tabrakan: Pink Magenta & Kuning Amber */
            --accent-pink: #ff4081;
            --accent-yellow: #ffc107;
            --glass-white: rgba(255, 255, 255, 0.15);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-gradient);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .edit-container {
            background: var(--glass-white);
            backdrop-filter: blur(15px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            padding: 50px; /* Diperbesar */
            border-radius: 40px; /* Kotak lebih membulat (vibe modern) */
            width: 100%;
            max-width: 600px; /* Ukuran container diperbesar */
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.4);
            position: relative;
            overflow: hidden;
        }

        /* Dekorasi agar tidak monoton */
        .edit-container::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            background: var(--accent-pink);
            border-radius: 50%;
            filter: blur(40px);
            opacity: 0.4;
        }

        .header {
            text-align: left;
            margin-bottom: 40px;
        }

        .header h1 {
            font-size: 32px;
            margin: 5px 0;
            background: linear-gradient(to right, #fff, var(--accent-yellow));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
        }

        .back-link {
            color: var(--accent-pink);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
            transition: 0.3s;
        }

        .back-link:hover { transform: translateX(-5px); color: white; }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
            font-weight: 500;
            color: #efefef;
        }

        /* Input: Kotak TIDAK BIRU (Putih Transparan/Glass) */
        .form-group input[type="text"],
        .form-group input[type="number"] {
            width: 100%;
            padding: 16px 20px;
            background: rgba(255, 255, 255, 0.9); /* Putih pekat agar kontras */
            border: none;
            border-radius: 18px;
            color: #1a237e; /* Teks biru tua di dalam kotak putih */
            font-size: 16px;
            font-weight: 600;
            box-sizing: border-box;
            outline: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        /* Preview Area */
        .preview-section {
            display: flex;
            align-items: center;
            background: rgba(0, 0, 0, 0.3);
            padding: 20px;
            border-radius: 20px;
            margin-top: 15px;
            border: 1px dashed var(--accent-yellow);
        }

        #imagePreview img {
            width: 100px; /* Ukuran preview diperbesar */
            height: 100px;
            border-radius: 15px;
            object-fit: cover;
            border: 3px solid var(--accent-pink);
        }

        /* Button Simpan: Warna Tabrakan (Magenta/Pink) */
        .btn-update {
            width: 100%;
            padding: 20px;
            background: var(--accent-pink);
            border: none;
            border-radius: 20px;
            color: white;
            font-size: 18px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            cursor: pointer;
            transition: 0.4s;
            margin-top: 20px;
            box-shadow: 0 10px 25px rgba(255, 64, 129, 0.4);
        }

        .btn-update:hover {
            background: var(--accent-yellow);
            color: #000;
            transform: scale(1.02);
            box-shadow: 0 10px 25px rgba(255, 193, 7, 0.4);
        }

        input[type="file"] {
            color: white;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="edit-container">
    <a href="home.php" class="back-link"><i class='bx bx-left-arrow-alt'></i> BACK TO DASHBOARD</a>
    
    <div class="header">
        <h1>EDIT DATA MENU</h1>
        <p style="color: #ccc;">Perbarui detail menu makanan anda dengan mudah.</p>
    </div>

    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="nama_lama" value="<?= $data['nama']; ?>">
        <input type="hidden" name="foto_lama" value="<?= $data['foto']; ?>">

        <div class="form-group">
            <label><i class='bx bx-font'></i> NAMA MENU</label>
            <input name="nama" type="text" value="<?= $data['nama']; ?>" required />
        </div>

        <div class="form-group">
            <label><i class='bx bx-money'></i> HARGA (RP)</label>
            <input name="harga" type="number" value="<?= $data['harga']; ?>" required />
        </div>

        <div class="form-group">
            <label><i class='bx bx-image-add'></i> UPLOAD FOTO BARU</label>
            <input name="foto" type="file" accept="image/*" onchange="previewImage(event)" />
            
            <div class="preview-section">
                <div id="imagePreview">
                    <img src="../img/<?= $data['foto']; ?>">
                </div>
                <div style="margin-left: 20px;">
                    <p style="margin: 0; font-size: 14px; font-weight: 700; color: var(--accent-yellow);">PREVIEW GAMBAR</p>
                    <p style="margin: 0; font-size: 12px; color: #bbb;">Klik pilih file untuk mengganti</p>
                </div>
            </div>
        </div>

        <button type="submit" name="update" class="btn-update">
            <i class='bx bx-save'></i> SIMPAN PERUBAHAN
        </button>
    </form>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('imagePreview');
            output.innerHTML = `<img src="${reader.result}">`;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

</body>
</html>