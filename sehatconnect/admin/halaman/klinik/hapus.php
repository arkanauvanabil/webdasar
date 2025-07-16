<?php
session_start();
include '../../../config/koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../../../login.php");
    exit();
}

$id = $_GET['id'];
$hapus = $conn->query("DELETE FROM arkan_klinik WHERE id_klinik = $id");

if ($hapus) {
    echo "<script>alert('Data klinik dihapus'); window.location='tampil.php';</script>";
} else {
    echo "<script>alert('Gagal hapus klinik'); window.location='tampil.php';</script>";
}
?>
