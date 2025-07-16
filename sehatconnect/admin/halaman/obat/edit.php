<?php
session_start();
include '../../../config/koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../../../login.php");
    exit();
}

$id = $_GET['id'];
$obat = $conn->query("SELECT * FROM arkan_obat WHERE id_obat = $id")->fetch_assoc();
$klinik = $conn->query("SELECT * FROM arkan_klinik");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = $_POST['nama_obat'];
    $jenis = $_POST['jenis_obat'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $id_klinik = $_POST['id_klinik'];

    $stmt = $conn->prepare("UPDATE arkan_obat SET nama_obat=?, jenis_obat=?, harga=?, stok=?, id_klinik=? WHERE id_obat=?");
    $stmt->bind_param("ssiiii", $nama, $jenis, $harga, $stok, $id_klinik, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Data obat berhasil diupdate'); window.location='tampil.php';</script>";
    } else {
        echo "<script>alert('Gagal update');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Obat</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
<?php include '../../partials/navbar.php'; ?>
<div class="container">
    <h2>Edit Obat</h2>
    <form method="post">
        <label>Nama Obat</label><br>
        <input type="text" name="nama_obat" value="<?= $obat['nama_obat'] ?>" required><br><br>

        <label>Jenis Obat</label><br>
        <input type="text" name="jenis_obat" value="<?= $obat['jenis_obat'] ?>" required><br><br>

        <label>Harga</label><br>
        <input type="number" name="harga" value="<?= $obat['harga'] ?>" required><br><br>

        <label>Stok</label><br>
        <input type="number" name="stok" value="<?= $obat['stok'] ?>" required><br><br>

        <label>Klinik</label><br>
        <select name="id_klinik" required>
            <option value="">-- Pilih Klinik --</option>
            <?php while ($k = $klinik->fetch_assoc()): ?>
                <option value="<?= $k['id_klinik'] ?>" <?= ($obat['id_klinik'] == $k['id_klinik']) ? 'selected' : '' ?>>
                    <?= $k['nama_klinik'] ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <button type="submit" class="btn">Update</button>
        <a href="tampil.php"><button type="button" class="btn">Batal</button></a>
    </form>
</div>
<?php include '../../partials/footer.php'; ?>
</body>
</html>
