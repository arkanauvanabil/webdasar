<?php
session_start();
include '../../../config/koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../../../login.php");
    exit();
}

$id = $_GET['id'];
$hapus = $conn->query("DELETE FROM arkan_obat WHERE id_obat = $id");

if ($hapus) {
    echo "<script>alert('Obat berhasil dihapus'); window.location='tampil.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus'); window.location='tampil.php';</script>";
}
?>
