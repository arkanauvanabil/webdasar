<?php
session_start();
include '../../../config/koneksi.php';

// Proteksi: hanya admin yang bisa akses
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../../../login.php");
    exit();
}

include '../../partials/navbar.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Dokter</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
<div class="container">
    <h2>Data Dokter</h2>
    <a href="tambah.php"><button class="btn">+ Tambah Dokter</button></a>
    <br><br>

    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Dokter</th>
                <th>Spesialis</th>
                <th>Klinik</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $sql = "SELECT d.*, k.nama_klinik FROM arkan_dokter d
                    LEFT JOIN arkan_klinik k ON d.id_klinik = k.id_klinik";
            $query = $conn->query($sql);
            while ($row = $query->fetch_assoc()):
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama_dokter']) ?></td>
                <td><?= htmlspecialchars($row['spesialis']) ?></td>
                <td><?= htmlspecialchars($row['nama_klinik']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id_dokter'] ?>">Edit</a> |
                    <a href="hapus.php?id=<?= $row['id_dokter'] ?>" onclick="return confirm('Yakin ingin menghapus dokter ini?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php include '../../partials/footer.php'; ?>
</body>
</html>
