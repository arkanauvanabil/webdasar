<?php
include 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO arkan_user (nama_user, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nama, $email, $pass);

    if ($stmt->execute()) {
        echo "<script>alert('Pendaftaran berhasil. Silakan login'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Gagal daftar, email mungkin sudah digunakan');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register User</title>
    <style>
        body { background: #0D1B2A; color: white; text-align: center; font-family: sans-serif; padding-top: 100px; }
        form { display: inline-block; background: #1B263B; padding: 30px; border-radius: 10px; }
        input { width: 250px; padding: 10px; margin: 5px 0; }
        button { padding: 10px 20px; background: #415A77; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h2>Daftar Pasien Baru</h2>
    <form method="POST">
        <input type="text" name="nama" placeholder="Nama Lengkap" required><br>
        <input type="email" name="email" placeholder="Email Aktif" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Daftar</button><br><br>
        <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
    </form>
</body>
</html>
