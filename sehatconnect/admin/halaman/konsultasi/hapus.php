<?php
session_start();
include '../../../config/koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../../../login.php");
    exit();
}

$id = $_GET['id'];
$hapus = $conn->query("DELETE FROM arkan_konsultasi WHERE id_konsultasi = $id");

if ($hapus) {
    echo "<script>alert('Konsultasi berhasil dihapus'); window.location='tampil.php';</script>";
} else {
    echo "<script>alert('Gagal hapus data'); window.location='tampil.php';</script>";
}
?>
