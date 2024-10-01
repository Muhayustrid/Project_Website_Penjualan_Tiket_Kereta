<?php
session_start();
include 'koneksi.php';

// Check if the user is logged in
if (!isset($_SESSION['masuk'])) {
    header("Location: login.php");
    exit;
}

// Fetch user profile data
$id_penumpang = $_SESSION['id_penumpang'];
$sql = mysqli_query($conn, "SELECT foto_profil FROM penumpang WHERE id_penumpang='$id_penumpang'");
$user = mysqli_fetch_assoc($sql);
$foto_profil = $user['foto_profil'] ?? 'default.jpg';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .main-content {
            padding-top: 50px;
            padding-bottom: 50px;
        }
        body {
            background-color: #f8f9fa;
        }
        .hero {
            background-color: #0E4EB5;
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        .hero h1 {
            font-size: 4rem;
            margin-bottom: 20px;
        }
        .hero p {
            font-size: 1.5rem;
        }
        .features {
            padding: 50px 0;
        }
        .features .feature {
            padding: 20px;
            text-align: center;
        }
        .features .feature i {
            font-size: 3rem;
            color: #0E4EB5;
            margin-bottom: 20px;
        }
        .features .feature h3 {
            font-size: 1.75rem;
            margin-bottom: 10px;
        }
        .features .feature p {
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php include "nav.php"; ?>
    <!-- Navbar -->

    <div class="hero">
        <div class="container">
            <h1>Selamat Datang di Healing.com</h1>
            <p>Pesan tiket kereta api dengan mudah dan cepat</p>
        </div>
    </div>

    <div class="main-content container">
        <div class="features row">
            <div class="feature col-md-4">
                <i class="fa-solid fa-ticket-alt"></i>
                <h3>Reservasi Mudah</h3>
                <p>Pesan tiket kereta api ke tujuan favorit Anda dengan beberapa klik saja.</p>
                <a href="reservasi.php" class="btn btn-primary">Reservasi Sekarang</a>
            </div>
            <div class="feature col-md-4">
                <i class="fa-solid fa-calendar"></i>
                <h3>Cek Jadwal</h3>
                <p>Lihat jadwal lengkap kereta api dan pilih waktu perjalanan yang sesuai.</p>
                <a href="jadwal.php" class="btn btn-primary">Lihat Jadwal</a>
            </div>
            <div class="feature col-md-4">
                <i class="fa-solid fa-train"></i>
                <h3>Tiket Saya</h3>
                <p>Kelola pemesanan tiket kereta api Anda dengan mudah di sini.</p>
                <a href="tiket.php" class="btn btn-primary">Kelola Tiket</a>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include "footer.php"; ?>
    <!-- footer -->

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
