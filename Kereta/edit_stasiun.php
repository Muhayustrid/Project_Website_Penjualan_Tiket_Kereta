<?php
session_start(); // Start the session


include "koneksi.php";

if (isset($_GET['id_stasiun'])) {
    $id_stasiun = $_GET['id_stasiun'];

    $query = "SELECT * FROM stasiun WHERE id_stasiun = '$id_stasiun'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (isset($_POST['submit'])) {
            $id_stasiun_new = $_POST['id_stasiun'];
            $nama_stasiun = $_POST['nama_stasiun'];
            $lokasi = $_POST['lokasi'];

            $query = "UPDATE stasiun SET id_stasiun = '$id_stasiun_new', nama_stasiun = '$nama_stasiun', alamat_stasiun = '$lokasi' WHERE id_stasiun = '$id_stasiun'";
            $result = mysqli_query($conn, $query);

            if ($result) {
                header("Location: stasiun.php");
                exit;
            } else {
                echo "Error: ". mysqli_error($conn);
            }
        }
    } else {
        echo "Stasiun not found";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Stasiun</title>
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
                <h2>Edit Stasiun</h2>
                <p>Isi form di bawah ini untuk mengedit stasiun:</p>

                <form action="" method="post">
                    <label for="id_stasiun">ID Stasiun:</label>
                    <input type="text" id="id_stasiun" name="id_stasiun" value="<?php echo isset($row)? $row['id_stasiun'] : '';?>" class="form-control"><br><br>
                    
                    <label for="nama_stasiun">Nama Stasiun:</label>
                    <input type="text" id="nama_stasiun" name="nama_stasiun" value="<?php echo isset($row)? $row['nama_stasiun'] : '';?>" class="form-control"><br><br>
                    
                    <label for="lokasi">Lokasi:</label>
                    <input type="text" id="lokasi" name="lokasi" value="<?php echo isset($row)? $row['alamat_stasiun'] : '';?>" class="form-control"><br><br>

                    <input type="submit" name="submit" value="Edit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include "footer.php";?>
    <!-- footer -->

    <script src="js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>