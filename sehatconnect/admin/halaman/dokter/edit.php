<?php
session_start();
include '../../../config/koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../../../login.php");
    exit();
}

$id = $_GET['id'];
$dokter = $conn->query("SELECT * FROM arkan_dokter WHERE id_dokter = $id")->fetch_assoc();
$klinik = $conn->query("SELECT * FROM arkan_klinik");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_dokter = $_POST['nama_dokter'];
    $spesialis = $_POST['spesialis'];
    $id_klinik = $_POST['id_klinik'];

    $stmt = $conn->prepare("UPDATE arkan_dokter SET nama_dokter=?, spesialis=?, id_klinik=? WHERE id_dokter=?");
    $stmt->bind_param("ssii", $nama_dokter, $spesialis, $id_klinik, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Dokter berhasil diupdate');window.location='tampil.php';</script>";
    } else {
        echo "<script>alert('Gagal update');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Dokter</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
<?php include '../../partials/navbar.php'; ?>
<div class="container">
    <h2>Edit Dokter</h2>
    <form method="post">
        <label>Nama Dokter</label><br>
        <input type="text" name="nama_dokter" value="<?= $dokter['nama_dokter'] ?>" required><br><br>

        <label>Spesialis</label><br>
        <input type="text" name="spesialis" value="<?= $dokter['spesialis'] ?>" required><br><br>

        <label>Klinik</label><br>
        <select name="id_klinik" required>
            <option value="">-- Pilih Klinik --</option>
            <?php while ($k = $klinik->fetch_assoc()): ?>
                <option value="<?= $k['id_klinik'] ?>" <?= ($dokter['id_klinik'] == $k['id_klinik']) ? 'selected' : '' ?>>
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
