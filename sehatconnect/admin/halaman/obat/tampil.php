<?php
// buka koneksi
include '../../../config/koneksi.php';
include '../../partials/navbar.php';

$result = $conn->query("SELECT * FROM arkan_obat o JOIN arkan_klinik k ON o.id_klinik = k.id_klinik");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Obat</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
<div class="container">
    <h2>Data Obat</h2>
    <a href="tambah.php"><button class="btn">+ Tambah Obat</button></a>
    <br><br>

    <table class="data-table">
        <tr>
            <th>Nama</th>
            <th>Jenis</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Klinik</th>
            <th>Aksi</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['nama_obat'] ?></td>
            <td><?= $row['jenis_obat'] ?></td>
            <td>Rp<?= number_format($row['harga']) ?></td>
            <td><?= $row['stok'] ?></td>
            <td><?= $row['nama_klinik'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id_obat'] ?>">Edit</a> |
                <a href="hapus.php?id=<?= $row['id_obat'] ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
<?php include '../../partials/footer.php'; ?>
</body>
</html>
