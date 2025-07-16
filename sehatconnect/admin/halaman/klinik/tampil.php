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
    <title>Data Klinik</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
<div class="container">
    <h2>Data Klinik</h2>
    <a href="tambah.php"><button class="btn">+ Tambah Klinik</button></a>
    <br><br>

    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Klinik</th>
                <th>Telepon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $result = $conn->query("SELECT * FROM arkan_klinik");
            while ($row = $result->fetch_assoc()):
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama_klinik']) ?></td>
                <td><?= htmlspecialchars($row['telepon']) ?></td>
                <td><?= htmlspecialchars($row['alamat']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id_klinik'] ?>">Edit</a> |
                    <a href="hapus.php?id=<?= $row['id_klinik'] ?>" onclick="return confirm('Yakin hapus klinik ini?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php include '../../partials/footer.php'; ?>
</body>
</html>
