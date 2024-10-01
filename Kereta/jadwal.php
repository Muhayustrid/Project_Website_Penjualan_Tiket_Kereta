<?php
session_start();
include "koneksi.php";
if (!isset($_SESSION["masuk"])) {
    header("Location: login.php");
    exit;
}

// Fetch kereta data from the database
$query = "SELECT id_kereta, nama_kereta, rute FROM kereta_api";
$result = mysqli_query($conn, $query);
$kereta = array();
while ($row = mysqli_fetch_assoc($result)) {
    $kereta[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Kereta Api</title>
    <link rel="stylesheet"  href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .card {
            cursor: pointer;
            margin: 10px 0;
        }

        .card:hover {
            background-color: #f8f9fa;
        }

        .main-content {
            padding-top: 100px;
            padding-bottom: 100px;
        }
    </style>
</head>

<body style="background-color: #EEEEEE;">
<div class="content-wrapper">
    <!-- Navbar -->
    <?php include "nav.php"; ?>
    <!-- Navbar -->

    <div class="main-content container mt-5 pt-5">
        <h1>Jadwal Kereta Api</h1>
        <div class="row" id="kereta-cards">
            <?php
            foreach ($kereta as $k) {
                echo '
                <div class="col-md-4">
                    <div class="card kereta-card" data-id="' . $k['id_kereta'] . '" data-nama="' . $k['nama_kereta'] . '" data-rute="' . $k['rute'] . '">
                        <div class="card-body">
                            <h5 class="card-title">' . $k['nama_kereta'] . '</h5>
                            <p class="card-text">' . $k['rute'] . '</p>
                        </div>
                    </div>
                </div>
                ';
            }
            ?>
        </div>
        <div id="jadwal-container" class="mt-5" style="display: none;">
            <h2 id="jadwal-title"></h2>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead style="background-color: #0E4EB5; color:#ffffff;">
                        <tr>
                            <th>Stasiun</th>
                            <th>Kedatangan</th>
                            <th>Keberangkatan</th>
                        </tr>
                    </thead>
                    <tbody id="jadwal-table">
                        <!-- Jadwal kereta -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

    <!-- footer -->
    <?php include "footer.php"; ?>
    <!-- footer -->

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.kereta-card', function() {
                var id_kereta = $(this).data('id');
                var nama_kereta = $(this).data('nama');
                var rute = $(this).data('rute');
                $('#jadwal-title').text(nama_kereta + ' (' + rute + ')');
                $.ajax({
                    url: 'fetch_jadwal.php',
                    method: 'POST',
                    data: {
                        id_kereta: id_kereta
                    },
                    success: function(data) {
                        $('#jadwal-table').html(data);
                        $('#jadwal-container').show();
                    }
                });
            });
        });
    </script>
</body>

</html>