<?php
session_start();
include '../config/koneksi.php';
include 'partials/navbar.php';

$result = $conn->query("SELECT o.*, k.nama_klinik FROM arkan_obat o
                        LEFT JOIN arkan_klinik k ON o.id_klinik = k.id_klinik");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Obat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Obat Tersedia</h2>
    <table>
        <tr>
            <th>Nama Obat</th>
            <th>Jenis</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Klinik</th>
        </tr>
        <?php while ($o = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $o['nama_obat'] ?></td>
            <td><?= $o['jenis_obat'] ?></td>
            <td>Rp<?= number_format($o['harga']) ?></td>
            <td><?= $o['stok'] ?></td>
            <td><?= $o['nama_klinik'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
<?php include 'partials/footer.php'; ?>
</body>
</html>
