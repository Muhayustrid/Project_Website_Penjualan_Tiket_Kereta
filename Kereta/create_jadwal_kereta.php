<?php
session_start(); // Start the session


include "koneksi.php";

if (isset($_POST['id_jadwal']) && isset($_POST['id_kereta']) && isset($_POST['id_stasiun_asal']) && isset($_POST['id_stasiun_tujuan']) && isset($_POST['waktu_keberangkatan']) && isset($_POST['waktu_sampai'])) {
    $id_jadwal = $_POST['id_jadwal'];
    $id_kereta = $_POST['id_kereta'];
    $stasiun_asal = $_POST['id_stasiun_asal'];
    $stasiun_tujuan = $_POST['id_stasiun_tujuan'];
    $waktu_keberangkatan = $_POST['waktu_keberangkatan'];
    $waktu_sampai = $_POST['waktu_sampai'];

    // Check if id_kereta exists in kereta_api table
    $query = "SELECT * FROM kereta_api WHERE id_kereta = '$id_kereta'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
        echo "Error: ID Kereta does not exist in kereta_api table";
        exit;
    }

    // Check if id_jadwal already exists in jadwal_kereta table
    $query = "SELECT * FROM jadwal_kereta WHERE id_jadwal = '$id_jadwal'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "Error: ID Jadwal already exists in jadwal_kereta table";
        exit;
    }

    // Check if id_stasiun_tujuan exists in stasiun table
    $query = "SELECT * FROM stasiun WHERE id_stasiun = '$stasiun_tujuan'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
        echo "Error: ID Stasiun Tujuan does not exist in stasiun table";
        exit;
    }

    // Insert into jadwal_kereta table
    $query = "INSERT INTO jadwal_kereta (id_jadwal, id_kereta, id_stasiun_asal, id_stasiun_tujuan, waktu_keberangkatan, waktu_sampai) VALUES ('$id_jadwal', '$id_kereta', '$stasiun_asal', '$stasiun_tujuan', '$waktu_keberangkatan', '$waktu_sampai')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: jadwal_kereta.php");
        exit;
    } else {
        echo "Error: ". mysqli_error($conn);
        exit;
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Jadwal Kereta</title>
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

    <div class="main-content container mt-5 pt-5">
        <div class="card">
            <div class="card-body">
                <h2>Create Jadwal Kereta</h2>
                <p>Form to create new jadwal kereta:</p>

                <form action="create_jadwal_kereta.php" method="post">
                <div class="form-group">
                        <label for="id_jadwal">ID Jadwal:</label>
                        <input type="text" class="form-control" id="id_jadwal" name="id_jadwal" required>
                    </div>
                    <div class="form-group">
                        <label for="id_kereta">ID Kereta:</label>
                        <input type="text" class="form-control" id="id_kereta" name="id_kereta" required>
                    </div>
                    <div class="form-group">
                        <label for="id_stasiun_asal">Stasiun Awal:</label>
                        <input type="text" class="form-control" id="id_stasiun_asal" name="id_stasiun_asal" required>
                    </div>
                    <div class="form-group">
                        <label for="id_stasiun_tujuan">Stasiun Tujuan:</label>
                        <input type="text" class="form-control" id="id_stasiun_tujuan" name="id_stasiun_tujuan" required>
                    </div>
                    <div class="form-group">
                        <label for="waktu_keberangkatan">Waktu Keberangkatan:</label>
                        <input type="datetime-local" class="form-control" id="waktu_keberangkatan" name="waktu_keberangkatan" required>
                    </div>
                    <div class="form-group">
                        <label for="waktu_sampai">Waktu Sampai:</label>
                        <input type="datetime-local" class="form-control" id="waktu_sampai" name="waktu_sampai" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include "footer.php";?>
</body>
</html>