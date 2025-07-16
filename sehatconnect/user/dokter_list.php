<?php
session_start();
include '../config/koneksi.php';
include 'partials/navbar.php';

$result = $conn->query("SELECT d.*, k.nama_klinik FROM arkan_dokter d
                        LEFT JOIN arkan_klinik k ON d.id_klinik = k.id_klinik");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Dokter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Daftar Dokter</h2>
    <table>
        <tr>
            <th>Nama</th>
            <th>Spesialis</th>
            <th>Klinik</th>
        </tr>
        <?php while ($d = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $d['nama_dokter'] ?></td>
            <td><?= $d['spesialis'] ?></td>
            <td><?= $d['nama_klinik'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
<?php include 'partials/footer.php'; ?>
</body>
</html>
