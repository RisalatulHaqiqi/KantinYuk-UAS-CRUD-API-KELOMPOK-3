<?php
session_start();

// Untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Default response
$response = ['status' => 'error', 'message' => 'Gagal menambahkan ke keranjang', 'total_item' => 0];

// Periksa apakah request adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nama']) && isset($_POST['harga'])) {
        $nama = trim($_POST['nama']);
        $harga = (int)$_POST['harga'];
        
        // Validasi input
        if (empty($nama) || $harga <= 0) {
            $response['message'] = 'Data makanan tidak valid';
        } else {
            // Pastikan session keranjang ada
            if (!isset($_SESSION['keranjang'])) {
                $_SESSION['keranjang'] = [];
            }
            
            // Buat key unik berdasarkan nama
            $item_key = md5($nama);
            
            // Cek apakah item sudah ada di keranjang
            if (isset($_SESSION['keranjang'][$item_key])) {
                // Jika sudah ada, tambah jumlahnya
                $_SESSION['keranjang'][$item_key]['jumlah']++;
                $message = "Jumlah $nama berhasil ditambahkan";
            } else {
                // Jika belum ada, tambahkan item baru
                $_SESSION['keranjang'][$item_key] = [
                    'nama' => $nama,
                    'harga' => $harga,
                    'jumlah' => 1
                ];
                $message = "$nama berhasil ditambahkan ke keranjang! 🎉";
            }
            
            // Hitung total item di keranjang
            $total_items = 0;
            foreach ($_SESSION['keranjang'] as $item) {
                $total_items += $item['jumlah'];
            }
            
            // Set response sukses
            $response = [
                'status' => 'success',
                'message' => $message,
                'total_item' => $total_items
            ];
        }
    } else {
        $response['message'] = 'Data tidak lengkap';
    }
} else {
    $response['message'] = 'Metode request tidak valid';
}

// Set header JSON
header('Content-Type: application/json');
echo json_encode($response);
exit();
?>