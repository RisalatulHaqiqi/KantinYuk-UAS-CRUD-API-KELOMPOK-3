<?php
header("Content-Type: application/json");

// API KEY
$API_KEY = "kantinyuenpi";

// ambil api key dari header (aman untuk Apache)
$clientKey = null;

// cara 1: getallheaders
$headers = getallheaders();
if (isset($headers['X-API-KEY'])) {
    $clientKey = $headers['X-API-KEY'];
} elseif (isset($headers['X-Api-Key'])) {
    $clientKey = $headers['X-Api-Key'];
}

// cara 2: fallback server variable
if (!$clientKey && isset($_SERVER['HTTP_X_API_KEY'])) {
    $clientKey = $_SERVER['HTTP_X_API_KEY'];
}

if ($clientKey !== $API_KEY) {
    http_response_code(401);
    echo json_encode([
        "status" => false,
        "message" => "API Key tidak valid"
    ]);
    exit;
}


// koneksi database
$conn = mysqli_connect("localhost", "root", "", "kantinyuk");
if (!$conn) {
    echo json_encode([
        "status" => false,
        "message" => "Koneksi database gagal"
    ]);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        getmethod($conn);
        break;

    case 'POST':
        postmethod($conn);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);
        putmethod($conn, $data);
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents("php://input"), true);
        deletemethod($conn, $data);
        break;

    default:
        echo json_encode([
            "status" => false,
            "message" => "Method tidak diizinkan"
        ]);
}

// ================== GET ==================
function getmethod($conn)
{
    $query = "SELECT * FROM pengguna order by nama";
    $result = mysqli_query($conn, $query);

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    echo json_encode([
        "status" => true,
        "data" => $data
    ]);
}


// ================== POST ==================
function postmethod($conn)
{
    if (
        !isset(
            $_POST['nama'],
            $_POST['password'],
            $_POST['email'],
            $_POST['telepon'],
        )
    ) {
        echo json_encode([
            "status" => false,
            "message" => "Parameter POST tidak lengkap"
        ]);
        return;
    }

    $nama = $_POST['nama'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    
    $query = "INSERT INTO pengguna
        (nama, password, email, telepon)
        VALUES
        ('$nama', '$password', '$email', '$telepon')";

    if (mysqli_query($conn, $query)) {
        echo json_encode([
            "status" => true,
            "message" => "Nama Pengguna berhasil ditambahkan"
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => mysqli_error($conn)
        ]);
    }
}


// ================== PUT ==================
function putmethod($conn, $data)
{
   $nama = $_POST['nama'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];

    $query = "UPDATE reservasi SET
        nama='$nama',
        password='$password',
        email='$email',
        WHERE telepon='$telepon'";

    if (mysqli_query($conn, $query)) {
        echo json_encode([
            "status" => true,
            "message" => " Data pengguna berhasil di updtae"
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Gagal update data"
        ]);
    }
}


// ================== DELETE ==================
function deletemethod($conn, $data)
{
    $telepon = $telepon['telepon'];

    $query = "DELETE FROM pengguna WHERE telepon='$telepon'";

    if (mysqli_query($conn, $query)) {
        echo json_encode([
            "status" => true,
            "message" => "Data berhasil dihapus"
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Gagal hapus data"
        ]);
    }
}
