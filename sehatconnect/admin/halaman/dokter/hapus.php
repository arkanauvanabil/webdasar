<?php
session_start();
include '../../../config/koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../../../login.php");
    exit();
}

$id = $_GET['id'];

$hapus = $conn->query("DELETE FROM arkan_dokter WHERE id_dokter = $id");

if ($hapus) {
    echo "<script>alert('Data dokter berhasil dihapus'); window.location='tampil.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus dokter'); window.location='tampil.php';</script>";
}
?>
