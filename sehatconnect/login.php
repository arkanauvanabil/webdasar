<?php
session_start();
include 'config/koneksi.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = $_POST['username'];
    $password = $_POST['password'];

    // Cek ke tabel admin
    $admin = $conn->prepare("SELECT * FROM arkan_admin WHERE username = ?");
    $admin->bind_param("s", $input);
    $admin->execute();
    $admin_result = $admin->get_result();

    if ($admin_result->num_rows > 0) {
        $data = $admin_result->fetch_assoc();
        if (password_verify($password, $data['password'])) {
            $_SESSION['admin_id'] = $data['id_admin'];
            header("Location: admin/index.php");
            exit();
        } else {
            $error = "Password salah (admin)";
        }
    } else {
        // Cek ke tabel user
        $user = $conn->prepare("SELECT * FROM arkan_user WHERE email = ?");
        $user->bind_param("s", $input);
        $user->execute();
        $user_result = $user->get_result();

        if ($user_result->num_rows > 0) {
            $data = $user_result->fetch_assoc();
            if (password_verify($password, $data['password'])) {
                $_SESSION['user_id'] = $data['id_user'];
                $_SESSION['nama_user'] = $data['nama_user'];
                header("Location: user/index.php");
                exit();
            } else {
                $error = "Password salah (user)";
            }
        } else {
            $error = "Akun tidak ditemukan";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login | SehatConnect</title>
    <style>
        body { background: #0D1B2A; color: white; text-align: center; font-family: sans-serif; padding-top: 100px; }
        form { display: inline-block; background: #1B263B; padding: 30px; border-radius: 10px; }
        input { width: 250px; padding: 10px; margin: 5px 0; }
        button { padding: 10px 20px; background: #415A77; color: white; border: none; cursor: pointer; }
        a { color: #91C4F2; }
        .error { color: red; margin-bottom: 10px; }
    </style>
</head>
<body>
    <h2>Login SehatConnect</h2>
    <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username admin / Email user" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button><br><br>
        <p>Belum punya akun? <a href="register_user.php">Daftar di sini</a></p>
    </form>
</body>
</html>
