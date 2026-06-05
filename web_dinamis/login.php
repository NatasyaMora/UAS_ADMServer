<?php
session_start();
include 'koneksi.php';

// Jika sudah login, langsung lempar ke dashboard
if (isset($_SESSION['admin'])) {
    header("Location: dashboard.php");
    exit;
}

$error = "";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = md5($_POST['password']); // Menggunakan MD5 sesuai isi dummy database

    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['admin'] = $row['username'];
        $_SESSION['nama'] = $row['nama_lengkap'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - Pinkish Accessories</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="background-color: #1A2E40;"> <div class="login-box">
        <h2>Admin Login</h2>
        
        <?php if($error): ?>
            <p style="color: red; text-align: center; margin-bottom: 15px;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required autocomplete="off">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn-login">Masuk</button>
        </form>
        <p style="text-align: center; margin-top: 15px;"><a href="index.php" style="color: #1A2E40; text-decoration: none; font-size: 0.9rem;">⬅ Kembali ke Toko</a></p>
    </div>

</body>
</html>