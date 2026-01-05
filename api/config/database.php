<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "kantinyuk"; // ganti sesuai nama DB kamu

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die(json_encode([
        "status" => false,
        "message" => "Koneksi database gagal"
    ]));
}
