<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}
include 'partials/navbar.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Pasien</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Selamat datang, <?= $_SESSION['nama_user'] ?>!</h2>
    <p>Terima kasih telah menggunakan layanan <strong>SehatConnect</strong>. Di platform ini, Anda dapat melakukan konsultasi kesehatan dengan dokter terpercaya, melihat daftar obat yang tersedia, serta mencari informasi tentang dokter dan klinik yang bekerja sama dengan kami.</p>
    <p>Silakan pilih menu di atas untuk memulai konsultasi atau menjelajahi informasi lainnya. Kami siap membantu Anda untuk mendapatkan layanan kesehatan terbaik.</p>
</div>

<?php include 'partials/footer.php'; ?>
</body>
</html>
