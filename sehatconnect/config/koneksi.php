<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "sehatconnect_dokter"; // semua tabel ada di sini

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
