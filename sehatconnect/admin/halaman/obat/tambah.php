<?php
session_start();
include '../../../config/koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../../../login.php");
    exit();
}

$klinik = $conn->query("SELECT * FROM arkan_klinik");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_obat'];
    $jenis = $_POST['jenis_obat'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $id_klinik = $_POST['id_klinik'];

    $stmt = $conn->prepare("INSERT INTO arkan_obat (nama_obat, jenis_obat, harga, stok, id_klinik) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiii", $nama, $jenis, $harga, $stok, $id_klinik);

    if ($stmt->execute()) {
        echo "<script>alert('Obat ditambahkan!'); window.location='tampil.php';</script>";
    } else {
        echo "<script>alert('Gagal tambah obat');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Obat</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
<?php include '../../partials/navbar.php'; ?>
<div class="container">
    <h2>Tambah Obat</h2>
    <form method="post">
        <label>Nama Obat</label><br>
        <input type="text" name="nama_obat" required><br><br>

        <label>Jenis Obat</label><br>
        <input type="text" name="jenis_obat" required><br><br>

        <label>Harga</label><br>
        <input type="number" name="harga" required><br><br>

        <label>Stok</label><br>
        <input type="number" name="stok" required><br><br>

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
