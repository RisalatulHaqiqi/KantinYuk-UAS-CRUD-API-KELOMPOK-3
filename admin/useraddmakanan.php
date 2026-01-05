<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Menu Makanan</title>
    <link rel="stylesheet" href="styleuseraddd.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <a href="home.php" class="back-btn">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h1><i class="fas fa-plus-circle"></i> Tambah Menu Makanan</h1>
            <p class="subtitle">Tambahkan menu makanan baru ke dalam sistem</p>
        </div>

        <!-- Form Container -->
        <div class="form-container">
            <form id="form2" name="form2" method="post" action="" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group">
                        <label for="nama">
                            <i class="fas fa-tag"></i> Nama Makanan
                        </label>
                        <input name="nama" type="text" id="nama" placeholder="Masukkan nama makanan..." required />
                    </div>
                    
                    <div class="form-group">
                        <label for="harga">
                            <i class="fas fa-money-bill-wave"></i> Harga
                        </label>
                        <div class="price-input">
                            <span class="currency">Rp</span>
                            <input name="harga" type="number" id="harga" placeholder="0" min="0" required />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="foto">
                        <i class="fas fa-image"></i> Foto Makanan
                    </label>
                    <div class="file-upload-container">
                        <input name="foto" type="file" id="foto" accept="image/*" onchange="previewImage(event)" />
                        <label for="foto" class="file-upload-label">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span>Pilih File Gambar</span>
                            <p class="file-types">Format: JPG, PNG, JPEG</p>
                        </label>
                        <div class="image-preview" id="imagePreview">
                            <i class="fas fa-image"></i>
                            <span>Pratinjau gambar akan muncul di sini</span>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="reset" class="btn-reset">
                        <i class="fas fa-redo"></i> Reset Form
                    </button>
                    <button type="submit" name="simpan" id="simpan" class="btn-submit">
                        <i class="fas fa-save"></i> Simpan Data
                    </button>
                </div>
            </form>
        </div>

        <!-- Preview Card -->
        <div class="preview-card">
            <h3><i class="fas fa-eye"></i> Pratinjau Data</h3>
            <div class="preview-content">
                <div class="preview-image">
                    <i class="fas fa-image"></i>
                </div>
                <div class="preview-details">
                    <h4 id="previewNama">Nama Makanan</h4>
                    <p class="preview-price" id="previewHarga">Rp 0</p>
                    <p class="preview-status">Status: <span class="status-new">Baru</span></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Real-time preview untuk form
        document.getElementById('nama').addEventListener('input', function() {
            document.getElementById('previewNama').textContent = this.value || 'Nama Makanan';
        });

        document.getElementById('harga').addEventListener('input', function() {
            const harga = this.value ? parseInt(this.value).toLocaleString('id-ID') : '0';
            document.getElementById('previewHarga').textContent = 'Rp ' + harga;
        });

        // Image preview function
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('imagePreview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                    
                    // Update preview card image
                    document.querySelector('.preview-image').innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Format harga saat input
        document.getElementById('harga').addEventListener('blur', function() {
            if (this.value) {
                const numericValue = this.value.replace(/\D/g, '');
                this.value = parseInt(numericValue).toLocaleString('id-ID');
            }
        });

        // Remove formatting on focus
        document.getElementById('harga').addEventListener('focus', function() {
            if (this.value) {
                this.value = this.value.replace(/\D/g, '');
            }
        });

        // Drag and drop functionality
        const fileInput = document.getElementById('foto');
        const fileUploadLabel = document.querySelector('.file-upload-label');
        
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            fileUploadLabel.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            fileUploadLabel.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            fileUploadLabel.addEventListener(eventName, unhighlight, false);
        });

        function highlight() {
            fileUploadLabel.classList.add('highlight');
        }

        function unhighlight() {
            fileUploadLabel.classList.remove('highlight');
        }

        fileUploadLabel.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            fileInput.files = files;
            
            // Trigger change event
            const event = new Event('change');
            fileInput.dispatchEvent(event);
        }
    </script>
</body>
</html>

<?php
if (isset($_POST["simpan"])) {
    include "../admin/koneksi.php";

    // Make sure to sanitize user inputs to prevent SQL injection
    $nama = mysqli_real_escape_string($kon, $_POST['nama']);
    $harga = mysqli_real_escape_string($kon, $_POST['harga']);
    
    // Remove formatting from harga
    $harga = str_replace('.', '', $harga);

    $nmfoto  = $_FILES["foto"]["name"];
    $lokfoto = $_FILES["foto"]["tmp_name"];
    $error = $_FILES["foto"]["error"];

    // Check if a file is selected
    if ($error === 0 && !empty($lokfoto)) {
        // Validate file type
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExtension = strtolower(pathinfo($nmfoto, PATHINFO_EXTENSION));
        
        // Validate file size (max 2MB)
        $maxFileSize = 2 * 1024 * 1024; // 2MB
        $fileSize = $_FILES["foto"]["size"];
        
        if (in_array($fileExtension, $allowedExtensions)) {
            if ($fileSize <= $maxFileSize) {
                // Generate unique filename to prevent overwriting
                $uniqueName = uniqid() . '_' . time() . '.' . $fileExtension;
                $uploadPath = "../img/" . $uniqueName;
                
                // Move the uploaded file
                if (move_uploaded_file($lokfoto, $uploadPath)) {
                    $nmfoto = $uniqueName;
                } else {
                    echo "<script>alert('Gagal mengupload gambar!');</script>";
                    $nmfoto = "";
                }
            } else {
                echo "<script>alert('Ukuran file terlalu besar! Maksimal 2MB.');</script>";
                $nmfoto = "";
            }
        } else {
            echo "<script>alert('Format file tidak didukung! Gunakan JPG, PNG, atau JPEG.');</script>";
            $nmfoto = "";
        }
    } else {
        // Handle the case where no file is uploaded
        $nmfoto = "default_food.jpg";  // Set default image
    }

    // Use prepared statements to prevent SQL injection
    $sqlm = mysqli_prepare($kon, "INSERT INTO stokmakn (nama, harga, foto) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($sqlm, 'sis', $nama, $harga, $nmfoto);
    $sqlm_exec = mysqli_stmt_execute($sqlm);

    if ($sqlm_exec) {
        echo "<script>
                alert('Data makanan berhasil disimpan!');
                setTimeout(function() {
                    window.location.href = 'home.php';
                }, 1500);
              </script>";
    } else {
        echo "<script>alert('Gagal menyimpan data!');</script>";
    }

    // Close the prepared statement
    mysqli_stmt_close($sqlm);
}
?>