<?php
session_start();

// Set the admin session variable
$_SESSION["admin"] = true;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <style>
        .main-content {
            padding-top: 100px;
            padding-bottom: 100px;
        }

        body {
            background-color: #f8f9fa;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body style="background-color: #EEEEEE;">
    <!-- Navbar -->
    <?php 


?>
<nav class="navbar navbar-expand-lg" style="background-color: #0E4EB5;">
    <a class="navbar-brand text-white" href="#">Healing.com</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link text-white" href="admin.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="daftar_pembelian.php">Daftar Pembelian</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="daftar_penumpang.php">Daftar Penumpang</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="daftar_kereta.php">Daftar Kereta</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="jadwal_kereta.php">Jadwal Kereta</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="stasiun.php">Stasiun</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Admin
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="login.php">Log Out</a>
                </div>
            </li>
        </ul>
    </div>
    </nav>  
    <!-- Navbar -->

    <div class="hero"><br>
        <div class="container">
            <h1>Selamat Datang di Dashboard Admin</h1>
            <p>Pesan tiket kereta api dengan mudah dan cepat</p>
        </div>
    </div>

    <div class="main-content container">
        <div class="features row">
            <div class="feature col-md-4">
                <h3>Reservasi</h3>
                <p>Halaman untuk melihat Daftar Reservasi .</p>
                <a href="daftar_pembelian.php" class="btn btn-primary">Reservasi</a>
            </div>
            <div class="feature col-md-4">
                <h3>Pengguna</h3>
                <p>Halaman untuk melihat Daftar pengguna .</p>
                <a href="daftar_penumpang.php" class="btn btn-primary">Lihat Jadwal</a>
            </div>
            <div class="feature col-md-4">
                <h3>Cek Jadwal</h3>
                <p>Lihat jadwal lengkap kereta api dan pilih waktu perjalanan yang sesuai.</p>
                <a href="jadwal_kereta.php" class="btn btn-primary">Lihat Jadwal</a>
            </div>
            <div class="feature col-md-4">
                <h3>Tiket</h3>
                <p>Kelola pemesanan tiket kereta api Anda dengan mudah di sini.</p>
                <a href="daftar_pembelian.php" class="btn btn-primary">Kelola Tiket</a>
            </div>
            <div class="feature col-md-4">                
                <h3>Kereta</h3>
                <p>Kelola daftar kereta api di sini.</p>
                <a href="daftar_kereta.php" class="btn btn-primary">Kereta</a>
            </div>
            <div class="feature col-md-4">               
                <h3>Stasiun</h3>
                <p>Kelola daftar Stasiun di sini.</p>
                <a href="stasiun.php" class="btn btn-primary">Stasiun</a>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include "footer.php"; ?>
    <!-- footer -->

    <script src="js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</body>

</html>