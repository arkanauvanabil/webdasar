<?php
session_start();
include '../../../config/koneksi.php';

// Proteksi: hanya admin
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../../../login.php");
    exit();
}

// Ambil daftar klinik untuk dropdown
$klinik = $conn->query("SELECT * FROM arkan_klinik");

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_dokter = $_POST['nama_dokter'];
    $spesialis = $_POST['spesialis'];
    $id_klinik = $_POST['id_klinik'];

    $stmt = $conn->prepare("INSERT INTO arkan_dokter (nama_dokter, spesialis, id_klinik) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $nama_dokter, $spesialis, $id_klinik);

    if ($stmt->execute()) {
        echo "<script>alert('Dokter berhasil ditambahkan');window.location='tampil.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan dokter');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Dokter</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
<?php include '../../partials/navbar.php'; ?>
<div class="container">
    <h2>Tambah Dokter</h2>
    <form method="post">
        <label>Nama Dokter</label><br>
        <input type="text" name="nama_dokter" required><br><br>

        <label>Spesialis</label><br>
        <input type="text" name="spesialis" required><br><br>

        <label>Klinik</label><br>
        <select name="id_klinik" required>
            <option value="">-- Pilih Klinik --</option>
            <?php while ($k = $klinik->fetch_assoc()): ?>
                <option value="<?= $k['id_klinik'] ?>"><?= $k['nama_klinik'] ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <button type="submit" class="btn">Simpan</button>
        <a href="tampil.php"><button type="button" class="btn">Kembali</button></a>
    </form>
</div>
<?php include '../../partials/footer.php'; ?>
</body>
</html>
