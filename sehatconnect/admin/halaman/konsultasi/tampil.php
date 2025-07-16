<?php
session_start();
include '../../../config/koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../../../login.php");
    exit();
}

include '../../partials/navbar.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Konsultasi</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
<div class="container">
    <h2>Data Konsultasi Pasien</h2>

    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama User</th>
                <th>Dokter</th>
                <th>Spesialis</th>
                <th>Keluhan</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = $conn->query("
                SELECT k.*, u.nama_user, d.nama_dokter, d.spesialis
                FROM arkan_konsultasi k
                LEFT JOIN arkan_user u ON k.id_user = u.id_user
                LEFT JOIN arkan_dokter d ON k.id_dokter = d.id_dokter
                ORDER BY k.tanggal DESC
            ");
            while ($row = $query->fetch_assoc()):
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama_user']) ?></td>
                <td><?= htmlspecialchars($row['nama_dokter']) ?></td>
                <td><?= htmlspecialchars($row['spesialis']) ?></td>
                <td><?= htmlspecialchars($row['keluhan']) ?></td>
                <td><?= $row['tanggal'] ?></td>
                <td>
                    <a href="hapus.php?id=<?= $row['id_konsultasi'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php include '../../partials/footer.php'; ?>
</body>
</html>
