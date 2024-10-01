<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION["masuk"])) {
    header("Location: login.php");
    exit;
}
$id_penumpang = $_SESSION['id_penumpang'];
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
            max-width: 100%;
            overflow-x: auto;
        }
    </style>
</head>

<body style="background-color: #EEEEEE;">
    <div class="content-wrapper">
        <!-- Navbar -->
        <?php include "nav.php"; ?>
        <!-- Navbar -->

        <div class="main-content container mt-5 pt-5">
            <div class="card">
                <div class="card-body">
                    <?php
                    // Query mendapatkan data pembelian dan user yang sedang login
                    $query = "
                        SELECT 
                            p.id_pembelian, 
                            ka.nama_kereta, 
                            p.asal, 
                            CONCAT(p.waktu_keberangkatan, ' ', p.tanggal_keberangkatan) as waktu_keberangkatan, 
                            p.tujuan,
                            p.biaya,
                            p.nomor_gerbong,
                            p.nomor_kursi
                        FROM pembelian p
                        JOIN penumpang pen ON p.id_penumpangfk = pen.id_penumpang
                        JOIN kereta_api ka ON p.id_keretafk = ka.id_kereta
                        WHERE p.id_penumpangfk = $id_penumpang
                        ORDER BY p.id_pembelian DESC
                    ";

                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        echo '<div class="table-responsive"><table class="table table-bordered">';
                        echo '<thead style="background-color:#0E4EB5; color: #ffffff;"><tr><th>ID Pembelian</th><th>Nama Kereta</th><th>Asal</th><th>Tujuan</th><th>Waktu Keberangkatan</th><th>Biaya</th><th>Gerbong/Kursi</th><th>Status</th></tr></thead><tbody>';

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . $row['id_pembelian'] . '</td>';
                            echo '<td>' . $row['nama_kereta'] . '</td>';
                            echo '<td>' . $row['asal'] . '</td>';
                            echo '<td>' . $row['tujuan'] . '</td>';
                            echo '<td>' . $row['waktu_keberangkatan'] . '</td>';
                            echo '<td>Rp ' . number_format($row['biaya'], 0, ',', '.') . '</td>';
                            echo '<td>' . 'KA' . $row['nomor_gerbong'] . '/' . $row['nomor_kursi'] . '</td>';
                            
                            // Check if the train departure time is before the current time
                            date_default_timezone_set('Asia/Jakarta');
                            $currentDateTime = new DateTime();
                            $departureDateTime = new DateTime($row['waktu_keberangkatan']);

                            if ($departureDateTime > $currentDateTime) {
                                echo '<td>
                                        <a href="cancel_pembelian.php?id_pembelian=' . $row['id_pembelian'] . '" class="btn btn-danger btn-sm">Batal</a>
                                        <a href="tiket.php?id_pembelian=' . $row['id_pembelian'] . '" class="btn btn-primary btn-sm">Cetak</a>
                                      </td>';
                            } else {
                                echo '<td></td>';
                            }

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
