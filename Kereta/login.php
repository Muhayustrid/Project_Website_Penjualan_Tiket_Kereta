<?php
session_start();
include 'koneksi.php';

if (isset($_POST["masuk"])) {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $sql = mysqli_query($conn, "SELECT * FROM penumpang WHERE email='$email'");
    $usr = mysqli_fetch_assoc($sql);

    if ($email === 'admin@admin.com' && $password === 'admin'){
        header("Location: admin.php");
        exit;
    }

    if ($usr) {
        if ($password === $usr['password']) {
            $_SESSION['masuk'] = true;
            $_SESSION['user'] = $usr;
            $_SESSION['id_penumpang'] = $usr['id_penumpang'];
            $_SESSION['foto_profil'] = $usr['foto_profil']; // Pastikan ini benar
            // cek remember me
            if (isset($_POST['remember'])) {
                // buat cookie
                setcookie('email', $email, time() + (3600), "/"); // 1 jam
                setcookie('password', $password, time() + (3600), "/"); // 1 jam
            }
            header("Location: index.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Email tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="container-login">
        <div class="header">Masuk</div>
        <form method="post">
            <div style="position: relative;">
                <input type="email" name="email" id="email" required>
                <label for="email">Email</label>
            </div>
            <div style="position: relative;">
                <input type="password" name="password" id="password" required>
                <label for="password">Password</label>
            </div>
            <div class="remember-forgot">
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember" class="remember-label">Remember Me</label>
                </div>
                <div class="forgot-password">
                    <a href="lupa_pass.php">Lupa Password?</a>
                </div>
            </div>
            <input type="submit" class="Masuk" name="masuk" value="Masuk"></a>
            <a href="register.php"><input type="button" class="Daftar" value="Daftar"></a>
            <a href="index.html"><input type="button" class="Daftar" value="Kembali"></a>
        </form>
        <?php if (isset($error)) : ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
    </div>
</body>

</html>