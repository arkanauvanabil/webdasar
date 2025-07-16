<?php
session_start();
include '../config/koneksi.php';

// Proteksi admin
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

// ========== TAMBAH ==========
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['tambah_dokter']) &&
        !empty($_POST['nama_dokter']) &&
        !empty($_POST['spesialis'])
    ) {
        $nama = $_POST['nama_dokter'];
        $spesialis = $_POST['spesialis'];
        $stmt = $conn->prepare("INSERT INTO arkan_dokter(nama_dokter, spesialis) VALUES (?, ?)");
        $stmt->bind_param("ss", $nama, $spesialis);
        $stmt->execute();
        $stmt->close();
    }

    if (
        isset($_POST['tambah_obat']) &&
        !empty($_POST['nama_obat']) &&
        !empty($_POST['jenis_obat']) &&
        isset($_POST['harga'])
    ) {
        $nama = $_POST['nama_obat'];
        $jenis = $_POST['jenis_obat'];
        $harga = $_POST['harga'];
        $stmt = $conn->prepare("INSERT INTO arkan_obat(nama_obat, jenis_obat, harga) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $nama, $jenis, $harga);
        $stmt->execute();
        $stmt->close();
    }

    if (
        isset($_POST['tambah_konsultasi']) &&
        !empty($_POST['nama_pasien']) &&
        !empty($_POST['keluhan']) &&
        !empty($_POST['tanggal']) &&
        !empty($_POST['nama_dokter'])
    ) {
        $nama = $_POST['nama_pasien'];
        $keluhan = $_POST['keluhan'];
        $tanggal = $_POST['tanggal'];
        $dokter = $_POST['nama_dokter'];
        $stmt = $conn->prepare("INSERT INTO arkan_konsultasi(nama_pasien, keluhan, tanggal, nama_dokter) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nama, $keluhan, $tanggal, $dokter);
        $stmt->execute();
        $stmt->close();
    }
}

// ========== HAPUS ==========
if (isset($_GET['hapus_dokter'])) {
    $stmt = $conn->prepare("DELETE FROM arkan_dokter WHERE id_dokter = ?");
    $stmt->bind_param("i", $_GET['hapus_dokter']);
    $stmt->execute();
    $stmt->close();
}
if (isset($_GET['hapus_obat'])) {
    $stmt = $conn->prepare("DELETE FROM arkan_obat WHERE id_obat = ?");
    $stmt->bind_param("i", $_GET['hapus_obat']);
    $stmt->execute();
    $stmt->close();
}
if (isset($_GET['hapus_konsultasi'])) {
    $stmt = $conn->prepare("DELETE FROM arkan_konsultasi WHERE id_konsultasi = ?");
    $stmt->bind_param("i", $_GET['hapus_konsultasi']);
    $stmt->execute();
    $stmt->close();
}

// Statistik
$total_dokter = $conn->query("SELECT COUNT(*) AS total FROM arkan_dokter")->fetch_assoc()['total'];
$total_user = $conn->query("SELECT COUNT(*) AS total FROM arkan_user")->fetch_assoc()['total'];
$total_konsultasi = $conn->query("SELECT COUNT(*) AS total FROM arkan_konsultasi")->fetch_assoc()['total'];
$total_obat = $conn->query("SELECT COUNT(*) AS total FROM arkan_obat")->fetch_assoc()['total'];

include 'partials/navbar.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2 class="section-title">Dashboard Admin</h2>
    <p>Halo, admin! Selamat datang di panel kontrol <strong>SehatConnect</strong>. Berikut adalah ringkasan jumlah data sistem yang tersedia:</p>

    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Data</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>1</td><td>Dokter</td><td><?= $total_dokter ?></td></tr>
            <tr><td>2</td><td>User</td><td><?= $total_user ?></td></tr>
            <tr><td>3</td><td>Konsultasi</td><td><?= $total_konsultasi ?></td></tr>
            <tr><td>4</td><td>Obat</td><td><?= $total_obat ?></td></tr>
        </tbody>
    </table>
</div>

<?php include 'partials/footer.php'; ?>

<!-- Tambahan CRUD untuk Dokter dan Obat -->
<div style="padding:40px">
    <h2>Data Dokter</h2>
    <form method="POST">
        <input type="text" name="nama_dokter" required placeholder="Nama Dokter">
        <input type="text" name="spesialis" required placeholder="Spesialis">
        <button name="tambah_dokter">Tambah Dokter</button>
    </form>
    <table border="1" cellpadding="6">
        <tr><th>No</th><th>Nama</th><th>Spesialis</th><th>Aksi</th></tr>
        <?php
        $no = 1;
        $res = $conn->query("SELECT * FROM arkan_dokter");
        while ($r = $res->fetch_assoc()) {
            echo "<tr><td>$no</td><td>{$r['nama_dokter']}</td><td>{$r['spesialis']}</td>
            <td><a href='?hapus_dokter={$r['id_dokter']}'>Hapus</a></td></tr>";
            $no++;
        }
        ?>
    </table>

    <h2>Data Obat</h2>
    <form method="POST">
        <input type="text" name="nama_obat" required placeholder="Nama Obat">
        <input type="text" name="jenis_obat" required placeholder="Jenis Obat">
        <input type="number" name="harga" required placeholder="Harga">
        <button name="tambah_obat">Tambah Obat</button>
    </form>
    <table border="1" cellpadding="6">
        <tr><th>No</th><th>Nama</th><th>Jenis</th><th>Harga</th><th>Aksi</th></tr>
        <?php
        $no = 1;
        $res = $conn->query("SELECT * FROM arkan_obat");
        while ($r = $res->fetch_assoc()) {
            echo "<tr><td>$no</td><td>{$r['nama_obat']}</td><td>{$r['jenis_obat']}</td><td>{$r['harga']}</td>
            <td><a href='?hapus_obat={$r['id_obat']}'>Hapus</a></td></tr>";
            $no++;
        }
        ?>
    </table>

    <h2>Data Konsultasi</h2>
    <form method="POST">
        <input type="text" name="nama_pasien" required placeholder="Nama Pasien">
        <input type="text" name="keluhan" required placeholder="Keluhan">
        <input type="date" name="tanggal" required>
        <select name="nama_dokter" required>
            <?php
            $dok = $conn->query("SELECT nama_dokter FROM arkan_dokter");
            while ($r = $dok->fetch_assoc()) echo "<option value='{$r['nama_dokter']}'>{$r['nama_dokter']}</option>";
            ?>
        </select>
        <button name="tambah_konsultasi">Tambah Konsultasi</button>
    </form>
    <table border="1" cellpadding="6">
        <tr><th>No</th><th>Pasien</th><th>Keluhan</th><th>Tanggal</th><th>Dokter</th><th>Aksi</th></tr>
        <?php
        $no = 1;
        $res = $conn->query("SELECT * FROM arkan_konsultasi");
        while ($r = $res->fetch_assoc()) {
            echo "<tr><td>$no</td><td>{$r['nama_pasien']}</td><td>{$r['keluhan']}</td><td>{$r['tanggal']}</td><td>{$r['nama_dokter']}</td>
            <td><a href='?hapus_konsultasi={$r['id_konsultasi']}'>Hapus</a></td></tr>";
            $no++;
        }
        ?>
    </table>
</div>
</body>
</html>
