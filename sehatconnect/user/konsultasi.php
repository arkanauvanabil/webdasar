<?php
session_start();
include '../config/koneksi.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}
include 'partials/navbar.php';

$dokter = $conn->query("SELECT d.id_dokter, d.nama_dokter, d.spesialis, k.nama_klinik 
                        FROM arkan_dokter d 
                        JOIN arkan_klinik k ON d.id_klinik = k.id_klinik");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_SESSION['user_id'];
    $id_dokter = $_POST['id_dokter'];
    $keluhan = $_POST['keluhan'];

    $stmt = $conn->prepare("INSERT INTO arkan_konsultasi (id_user, id_dokter, keluhan) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $id_user, $id_dokter, $keluhan);
    if ($stmt->execute()) {
        echo "<script>alert('Konsultasi berhasil dikirim'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal kirim konsultasi');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Konsultasi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Kirim Konsultasi</h2>
    <form method="post">
        <label>Pilih Dokter</label><br>
        <select name="id_dokter" required>
            <option value="">-- Pilih Dokter --</option>
            <?php while ($d = $dokter->fetch_assoc()): ?>
                <option value="<?= $d['id_dokter'] ?>">
                    <?= $d['nama_dokter'] ?> - <?= $d['spesialis'] ?> (<?= $d['nama_klinik'] ?>)
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Keluhan</label><br>
        <textarea name="keluhan" required style="width:100%; height:120px;">

        </textarea>
<br>
<br>

        <button type="submit" class="btn">Kirim</button>
    </form>
</div>
<?php include 'partials/footer.php'; ?>
</body>
</html>
