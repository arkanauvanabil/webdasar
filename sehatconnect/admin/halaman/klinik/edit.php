<?php
session_start();
include '../../../config/koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../../../login.php");
    exit();
}

$id = $_GET['id'];
$klinik = $conn->query("SELECT * FROM arkan_klinik WHERE id_klinik = $id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = $_POST['nama_klinik'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];

    $stmt = $conn->prepare("UPDATE arkan_klinik SET nama_klinik=?, telepon=?, alamat=? WHERE id_klinik=?");
    $stmt->bind_param("sssi", $nama, $telepon, $alamat, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Klinik berhasil diupdate'); window.location='tampil.php';</script>";
    } else {
        echo "<script>alert('Gagal update');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Klinik</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
<?php include '../../partials/navbar.php'; ?>
<div class="container">
    <h2>Edit Klinik</h2>
    <form method="post">
        <label>Nama Klinik</label><br>
        <input type="text" name="nama_klinik" value="<?= $klinik['nama_klinik'] ?>" required><br><br>

        <label>No. Telepon</label><br>
        <input type="text" name="telepon" value="<?= $klinik['telepon'] ?>" required><br><br>

        <label>Alamat</label><br>
        <textarea name="alamat" required><?= $klinik['alamat'] ?></textarea><br><br>

        <button type="submit" class="btn">Update</button>
        <a href="tampil.php"><button type="button" class="btn">Batal</button></a>
    </form>
</div>
<?php include '../../partials/footer.php'; ?>
</body>
</html>
