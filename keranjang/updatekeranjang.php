<?php
session_start();

// Untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$response = ['status' => 'error', 'message' => 'Gagal memperbarui keranjang', 'total_item' => 0];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nama']) && isset($_POST['action'])) {
        $nama = trim($_POST['nama']);
        $action = $_POST['action'];
        $item_key = md5($nama);
        
        // Debug
        error_log("Update Cart - Nama: $nama, Action: $action, Key: $item_key");
        error_log("Session sebelum update: " . print_r($_SESSION, true));
        
        if (isset($_SESSION['keranjang'][$item_key])) {
            $item_name = $_SESSION['keranjang'][$item_key]['nama'];
            
            switch ($action) {
                case 'plus':
                    $_SESSION['keranjang'][$item_key]['jumlah']++;
                    $message = "Jumlah $item_name berhasil ditambahkan";
                    break;
                    
                case 'minus':
                    if ($_SESSION['keranjang'][$item_key]['jumlah'] > 1) {
                        $_SESSION['keranjang'][$item_key]['jumlah']--;
                        $message = "Jumlah $item_name berhasil dikurangi";
                    } else {
                        // Hapus item jika jumlah menjadi 0
                        unset($_SESSION['keranjang'][$item_key]);
                        $message = "$item_name berhasil dihapus dari keranjang";
                    }
                    break;
                    
                case 'delete':
                case 'hapus':
                    // Hapus item langsung
                    unset($_SESSION['keranjang'][$item_key]);
                    $message = "$item_name berhasil dihapus dari keranjang";
                    break;
                    
                default:
                    $message = "Aksi tidak valid";
            }
            
            // Hitung total item
            $total_items = 0;
            if (isset($_SESSION['keranjang'])) {
                foreach ($_SESSION['keranjang'] as $item) {
                    $total_items += $item['jumlah'];
                }
            }
            
            $response = [
                'status' => 'success',
                'message' => $message,
                'total_item' => $total_items
            ];
            
        } else {
            $response['message'] = 'Item tidak ditemukan di keranjang';
        }
        
        // Debug
        error_log("Session setelah update: " . print_r($_SESSION, true));
        error_log("Response: " . json_encode($response));
        
    } else {
        $response['message'] = 'Data tidak lengkap';
    }
}

header('Content-Type: application/json');
echo json_encode($response);
exit();
?>