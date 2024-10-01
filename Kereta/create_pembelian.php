<?php
session_start(); // Start the session

include "koneksi.php";

if (isset($_POST['submit'])) {
    $penumpang_fk = $_POST['penumpang_fk'];
    $kereta_fk = $_POST['kereta_fk'];
    $asal = $_POST['asal'];
    $waktu_keberangkatan = $_POST['waktu_keberangkatan'];
    $tanggal_keberangkatan = $_POST['tanggal_keberangkatan'];
    $tujuan = $_POST['tujuan'];
    $waktu_tiba = $_POST['waktu_tiba'];
    $tanggal_tiba = $_POST['tanggal_tiba'];
    $nomor_gerbong = $_POST['nomor_gerbong'];
    $nomor_kursi = $_POST['nomor_kursi'];

    $query = "INSERT INTO pembelian (id_penumpangfk, id_keretafk, asal, waktu_keberangkatan, tanggal_keberangkatan, tujuan, waktu_tiba, tanggal_tiba, nomor_gerbong, nomor_kursi) 
              VALUES ('$penumpang_fk', '$kereta_fk', '$asal', '$waktu_keberangkatan', '$tanggal_keberangkatan', '$tujuan', '$waktu_tiba', '$tanggal_tiba', '$nomor_gerbong', '$nomor_kursi')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: daftar_pembelian.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Fetch penumpang and kereta data
$penumpang_query = "SELECT id_penumpang, nama_penumpang FROM penumpang";
$penumpang_result = mysqli_query($conn, $penumpang_query);

$kereta_query = "SELECT id_kereta, nama_kereta FROM kereta_api";
$kereta_result = mysqli_query($conn, $kereta_query);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Pembelian</title>
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
                <h2>Create Pembelian</h2>
                <p>Isi form di bawah ini untuk membuat pembelian baru:</p>

                <form action="" method="post">
                    <label for="penumpang_fk">Nama Penumpang:</label>
                    <select id="penumpang_fk" name="penumpang_fk" class="form-control">
                        <?php while ($penumpang_row = mysqli_fetch_assoc($penumpang_result)) : ?>
                            <option value="<?php echo $penumpang_row['id_penumpang']; ?>"><?php echo $penumpang_row['nama_penumpang']; ?></option>
                        <?php endwhile; ?>
                    </select><br><br>

                    <label for="kereta_fk">Nama Kereta:</label>
                    <select id="kereta_fk" name="kereta_fk" class="form-control">
                        <?php while ($kereta_row = mysqli_fetch_assoc($kereta_result)) : ?>
                            <option value="<?php echo $kereta_row['id_kereta']; ?>"><?php echo $kereta_row['nama_kereta']; ?></option>
                        <?php endwhile; ?>
                    </select><br><br>

                    <label for="asal">Asal:</label>
                    <input type="text" id="asal" name="asal" class="form-control"><br><br>

                    <label for="waktu_keberangkatan">Waktu Keberangkatan:</label>
                    <input type="text" id="waktu_keberangkatan" name="waktu_keberangkatan" class="form-control"><br><br>

                    <label for="tanggal_keberangkatan">Tanggal Keberangkatan:</label>
                    <input type="date" id="tanggal_keberangkatan" name="tanggal_keberangkatan" class="form-control"><br><br>

                    <label for="tujuan">Tujuan:</label>
                    <input type="text" id="tujuan" name="tujuan" class="form-control"><br><br>

                    <label for="waktu_tiba">Waktu Tiba:</label>
                    <input type="text" id="waktu_tiba" name="waktu_tiba" class="form-control"><br><br>

                    <label for="tanggal_tiba">Tanggal Tiba:</label>
                    <input type="date" id="tanggal_tiba" name="tanggal_tiba" class="form-control"><br><br>

                    <label for="nomor_gerbong">Nomor Gerbong:</label>
                    <input type="text" id="nomor_gerbong" name="nomor_gerbong" class="form-control"><br><br>

                    <label for="nomor_kursi">Nomor Kursi:</label>
                    <input type="text" id="nomor_kursi" name="nomor_kursi" class="form-control"><br><br>

                    <input type="submit" name="submit" value="Create" class="btn btn-primary">
                </form>
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
