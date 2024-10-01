<?php
include "koneksi.php";

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pembelian</title>
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
                <h2>Daftar Pembelian</h2>
                <p>Berikut adalah daftar pembelian tiket:</p>
                <a href="create_pembelian.php" class="btn btn-primary">Create New</a>
                <?php
                $query = "SELECT p.id_pembelian, ka.nama_kereta, pen.nama_penumpang, p.asal, p.waktu_keberangkatan, p.tanggal_keberangkatan, p.tujuan, p.waktu_tiba, p.tanggal_tiba, p.nomor_gerbong, p.nomor_kursi 
                          FROM pembelian p
                          JOIN kereta_api ka ON p.id_keretafk = ka.id_kereta
                          JOIN penumpang pen ON p.id_penumpangfk = pen.id_penumpang";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    echo '<div class="table-responsive"><table class="table table-bordered">';
                    echo '<thead class="thead-dark"><tr><th>ID Pembelian</th><th>Nama Kereta</th><th>Nama Penumpang</th><th>Asal</th><th>Waktu Keberangkatan</th><th>Tanggal Keberangkatan</th><th>Tujuan</th><th>Waktu Tiba</th><th>Tanggal Tiba</th><th>Nomor Gerbong</th><th>Nomor Kursi</th><th>Actions</th></tr></thead><tbody>';

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $row['id_pembelian'] . '</td>';
                        echo '<td>' . $row['nama_kereta'] . '</td>';
                        echo '<td>' . $row['nama_penumpang'] . '</td>';
                        echo '<td>' . $row['asal'] . '</td>';
                        echo '<td>' . $row['waktu_keberangkatan'] . '</td>';
                        echo '<td>' . $row['tanggal_keberangkatan'] . '</td>';
                        echo '<td>' . $row['tujuan'] . '</td>';
                        echo '<td>' . $row['waktu_tiba'] . '</td>';
                        echo '<td>' . $row['tanggal_tiba'] . '</td>';
                        echo '<td>' . $row['nomor_gerbong'] . '</td>';
                        echo '<td>' . $row['nomor_kursi'] . '</td>';
                        echo '<td>
                                <a href="edit_pembelian.php?id=' . $row['id_pembelian'] . '" class="btn btn-primary">Edit</a>
                                <a href="delete_pembelian.php?id=' . $row['id_pembelian'] . '" class="btn btn-danger">Delete</a>
                              </td>';
                        echo '</tr>';
                    }

                    echo '</tbody></table></div>';
                } else {
                    echo '<div class="alert alert-warning" role="alert">Belum ada pembelian tiket.</div>';
                }

                mysqli_close($conn);
                ?>
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
