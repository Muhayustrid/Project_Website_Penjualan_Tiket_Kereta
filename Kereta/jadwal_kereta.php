<?php
include "koneksi.php";

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Kereta</title>
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
                <h2>Jadwal Kereta</h2>
                <p>Berikut adalah jadwal kereta:</p>

                <a href="create_jadwal_kereta.php" class="btn btn-primary">Create New</a>

                <div class="table-responsive">
                    <table class="table table-bordered" id="jadwal-kereta-table">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID Jadwal</th>
                                <th>ID Kereta</th>
                                <th>ID Stasiun Asal</th>
                                <th>ID Stasiun Tujuan</th>
                                <th>Waktu Keberangkatan</th>
                                <th>Waktu Sampai</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="jadwal-kereta-tbody">
                            <?php
                            $query = "SELECT * FROM jadwal_kereta";
                            $result = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr data-id="' . $row['id_jadwal'] . '">';
                                echo '<td>' . $row['id_jadwal'] . '</td>';
                                echo '<td>' . $row['id_kereta'] . '</td>';
                                echo '<td>' . $row['id_stasiun_asal'] . '</td>';
                                echo '<td>' . $row['id_stasiun_tujuan'] . '</td>';
                                echo '<td>' . $row['waktu_keberangkatan'] . '</td>';
                                echo '<td>' . $row['waktu_sampai'] . '</td>';
                                echo '<td>
                                        <a href="edit_jadwal_kereta.php?id_jadwal=' . $row['id_jadwal'] . '" class="btn btn-primary">Edit</a>
                                        <a href="delete_jadwal_kereta.php?id_jadwal=' . $row['id_jadwal'] . '" class="btn btn-danger">Delete</a>
                                      </td>';
                                echo '</tr>';
                            }

                            mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                </div>
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
