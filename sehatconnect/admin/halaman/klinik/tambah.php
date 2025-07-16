<?php
session_start();
include '../../../config/koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../../../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = $_POST['nama_klinik'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];

    $stmt = $conn->prepare("INSERT INTO arkan_klinik (nama_klinik, telepon, alamat) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nama, $telepon, $alamat);

    if ($stmt->execute()) {
        echo "<script>alert('Klinik ditambahkan!'); window.location='tampil.php';</script>";
    } else {
        echo "<script>alert('Gagal tambah klinik');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Klinik</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
<?php include '../../partials/navbar.php'; ?>
<div class="container">
    <h2>Tambah Klinik</h2>
    <form method="post">
        <label>Nama Klinik</label><br>
        <input type="text" name="nama_klinik" required><br><br>

        <label>No. Telepon</label><br>
        <input type="text" name="telepon" required><br><br>

        <label>Alamat</label><br>
        <textarea name="alamat" required></textarea><br><br>

        <button type="submit" class="btn">Simpan</button>
        <a href="tampil.php"><button type="button" class="btn">Kembali</button></a>
    </form>
</div>
<?php include '../../partials/footer.php'; ?>
</body>
</html>
