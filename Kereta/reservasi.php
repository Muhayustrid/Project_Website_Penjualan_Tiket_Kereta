<?php
session_start();
include "koneksi.php";
if (!isset($_SESSION["masuk"])) {
    header("Location: login.php");
    exit;
}
$id_penumpang = $_SESSION['id_penumpang'];
// Fetch stasiun data from the database
$query = "SELECT nama_stasiun FROM stasiun";
$result = mysqli_query($conn, $query);
$stasiun = array();
while ($row = mysqli_fetch_assoc($result)) {
    $stasiun[] = $row['nama_stasiun'];
}
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <style>
        
    </style>
</head>

<body style="background-color: #EEEEEE;">
    <div class="content-wrapper">
        <!-- Navbar -->
        <?php include "nav.php"; ?>
        <!-- Navbar -->

        <div class="main-content container mt-5 pt-5">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Pemesanan Tiket Kereta Api</h4>
                    <p id="currentDate"></p> <!-- Tambahkan elemen ini -->
                </div>
                <div class="card-body">
                    <form id="ticketForm" action="fetch_trains.php" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="stasiunAsal">Stasiun Asal</label>
                                <input type="text" class="form-control" id="stasiunAsal" name="stasiunAsal" placeholder="Stasiun Asal" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="stasiunTujuan">Stasiun Tujuan</label>
                                <input type="text" class="form-control" id="stasiunTujuan" name="stasiunTujuan" placeholder="Stasiun Tujuan" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tanggalKeberangkatan">Tanggal Keberangkatan</label>
                                <input type="date" class="form-control" id="tanggalKeberangkatan" name="tanggalKeberangkatan" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="gerbong">Nomor Gerbong</label>
                                <input type="number" class="form-control" id="gerbong" name="gerbong" min="1" max="8" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="kursi">Nomor Kursi</label>
                                <input type="number" class="form-control" id="kursi" name="kursi" min="1" max="40" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Cari & Pesan Tiket</button>
                    </form>

                </div>
            </div>

            <div id="trainResults" class="mt-5"></div>
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
    <script>
        $(document).ready(function() {
            // Set the date input min and max values
            var today = new Date();
            var maxDate = new Date();
            maxDate.setDate(today.getDate() + 45);

            var todayString = today.toISOString().split('T')[0];
            var maxDateString = maxDate.toISOString().split('T')[0];

            $('#tanggalKeberangkatan').attr('min', todayString);
            $('#tanggalKeberangkatan').attr('max', maxDateString);

            // Fetch stasiun data from server
            var stasiunData = <?php echo json_encode($stasiun); ?>;

            // Autocomplete for stasiunAsal
            $('#stasiunAsal').autocomplete({
                source: stasiunData,
                minLength: 2,
                select: function(event, ui) {
                    $('#stasiunAsal').val(ui.item.value);
                }
            });

            // Autocomplete for stasiunTujuan
            $('#stasiunTujuan').autocomplete({
                source: stasiunData,
                minLength: 2,
                select: function(event, ui) {
                    $('#stasiunTujuan').val(ui.item.value);
                }
            });

            // Form validation and fetch trains on submit
            $('#ticketForm').on('submit', function(event) {
                event.preventDefault();
                var gerbong = $('#gerbong').val();
                var kursi = $('#kursi').val();
                var stasiunAsal = $('#stasiunAsal').val();
                var stasiunTujuan = $('#stasiunTujuan').val();

                if (gerbong < 1 || gerbong > 8) {
                    alert('Nomor gerbong harus antara 1 dan 8.');
                    return;
                }

                if (kursi < 1 || kursi > 40) {
                    alert('Nomor kursi harus antara 1 dan 40.');
                    return;
                }

                if (!stasiunData.includes(stasiunAsal)) {
                    alert('Stasiun asal tidak dikenal.');
                    return;
                }

                if (!stasiunData.includes(stasiunTujuan)) {
                    alert('Stasiun tujuan tidak dikenal.');
                    return;
                }

                // Fetch available trains
                $.ajax({
                    url: 'fetch_trains.php',
                    type: 'POST',
                    data: {
                        stasiunAsal: stasiunAsal,
                        stasiunTujuan: stasiunTujuan,
                        tanggalKeberangkatan: $('#tanggalKeberangkatan').val(),
                        gerbong: gerbong,
                        kursi: kursi
                    },
                    success: function(response) {
                        $('#trainResults').html(response);
                    }
                });
            });

            // Display current date in card header
            var options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            var currentDate = new Date().toLocaleDateString('id-ID', options);
            $('#currentDate').text(currentDate);
        });
    </script>
</body>

</html>
