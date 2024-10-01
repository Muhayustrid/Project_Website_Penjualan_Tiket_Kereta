<?php
session_start(); // Start the session

include "koneksi.php";

if (isset($_GET['id'])) {
    $id_pembelian = $_GET['id'];
    $query = "SELECT * FROM pembelian WHERE id_pembelian = '$id_pembelian'";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $id_penumpangfk = $row['id_penumpangfk'];
        $kereta_fk = $row['id_keretafk'];
        $asal = $row['asal'];
        $waktu_keberangkatan = $row['waktu_keberangkatan'];
        $tanggal_keberangkatan = $row['tanggal_keberangkatan'];
        $tujuan = $row['tujuan'];
        $waktu_tiba = $row['waktu_tiba'];
        $tanggal_tiba = $row['tanggal_tiba'];
        $nomor_gerbong = $row['nomor_gerbong'];
        $nomor_kursi = $row['nomor_kursi'];
    }
}

// Fetch penumpang and kereta data
$penumpang_query = "SELECT id_penumpang, nama_penumpang FROM penumpang";
$penumpang_result = mysqli_query($conn, $penumpang_query);

$kereta_query = "SELECT id_kereta, nama_kereta FROM kereta_api";
$kereta_result = mysqli_query($conn, $kereta_query);

if (isset($_POST['submit'])) {
    $id_pembelian = $_POST['id_pembelian'];
    $id_penumpangfk = $_POST['id_penumpangfk'];
    $kereta_fk = $_POST['kereta_fk'];
    $asal = $_POST['asal'];
    $waktu_keberangkatan = $_POST['waktu_keberangkatan'];
    $tanggal_keberangkatan = $_POST['tanggal_keberangkatan'];
    $tujuan = $_POST['tujuan'];
    $waktu_tiba = $_POST['waktu_tiba'];
    $tanggal_tiba = $_POST['tanggal_tiba'];
    $nomor_gerbong = $_POST['nomor_gerbong'];
    $nomor_kursi = $_POST['nomor_kursi'];

    $query = "UPDATE pembelian SET id_penumpangfk = '$id_penumpangfk', id_keretafk = '$kereta_fk', asal = '$asal', waktu_keberangkatan = '$waktu_keberangkatan', tanggal_keberangkatan = '$tanggal_keberangkatan', tujuan = '$tujuan', waktu_tiba = '$waktu_tiba', tanggal_tiba = '$tanggal_tiba', nomor_gerbong = '$nomor_gerbong', nomor_kursi = '$nomor_kursi' WHERE id_pembelian = '$id_pembelian'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: daftar_pembelian.php");
        exit;
    } else {
        echo "Error: ". mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pembelian</title>
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
                <h2>Edit Pembelian</h2>
                <p>Isi form di bawah ini untuk mengedit pembelian:</p>

                <form action="" method="post">
                    <input type="hidden" name="id_pembelian" value="<?php echo $id_pembelian;?>">

                    <label for="id_penumpangfk">Nama Penumpang:</label>
                    <select id="id_penumpangfk" name="id_penumpangfk" class="form-control">
                        <?php while ($penumpang_row = mysqli_fetch_assoc($penumpang_result)) : ?>
                            <option value="<?php echo $penumpang_row['id_penumpang']; ?>" <?php if ($id_penumpangfk == $penumpang_row['id_penumpang']) echo 'selected'; ?>>
                                <?php echo $penumpang_row['nama_penumpang']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select><br><br>

                    <label for="kereta_fk">Nama Kereta:</label>
                    <select id="kereta_fk" name="kereta_fk" class="form-control">
                        <?php while ($kereta_row = mysqli_fetch_assoc($kereta_result)) : ?>
                            <option value="<?php echo $kereta_row['id_kereta']; ?>" <?php if ($kereta_fk == $kereta_row['id_kereta']) echo 'selected'; ?>>
                                <?php echo $kereta_row['nama_kereta']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select><br><br>

                    <label for="asal">Asal:</label>
                    <input type="text" id="asal" name="asal" value="<?php echo $asal;?>" class="form-control"><br><br>

                    <label for="waktu_keberangkatan">Waktu Keberangkatan:</label>
                    <input type="text" id="waktu_keberangkatan" name="waktu_keberangkatan" value="<?php echo $waktu_keberangkatan;?>" class="form-control"><br><br>

                    <label for="tanggal_keberangkatan">Tanggal Keberangkatan:</label>
                    <input type="date" id="tanggal_keberangkatan" name="tanggal_keberangkatan" value="<?php echo $tanggal_keberangkatan;?>" class="form-control"><br><br>

                    <label for="tujuan">Tujuan:</label>
                    <input type="text" id="tujuan" name="tujuan" value="<?php echo $tujuan;?>" class="form-control"><br><br>

                    <label for="waktu_tiba">Waktu Tiba:</label>
                    <input type="text" id="waktu_tiba" name="waktu_tiba" value="<?php echo $waktu_tiba;?>" class="form-control"><br><br>

                    <label for="tanggal_tiba">Tanggal Tiba:</label>
                    <input type="date" id="tanggal_tiba" name="tanggal_tiba" value="<?php echo $tanggal_tiba;?>" class="form-control"><br><br>

                    <label for="nomor_gerbong">Nomor Gerbong:</label>
                    <input type="text" id="nomor_gerbong" name="nomor_gerbong" value="<?php echo $nomor_gerbong;?>" class="form-control"><br><br>

                    <label for="nomor_kursi">Nomor Kursi:</label>
                    <input type="text" id="nomor_kursi" name="nomor_kursi" value="<?php echo $nomor_kursi;?>" class="form-control"><br><br>

                    <input type="submit" name="submit" value="Update" class="btn btn-primary">
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
    <script src="
