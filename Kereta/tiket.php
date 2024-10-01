<?php
include "koneksi.php";

if (isset($_GET['id_pembelian']) && is_numeric($_GET['id_pembelian'])) {
    $id_pembelian = $_GET['id_pembelian'];

    $query = "
        SELECT 
            p.id_pembelian, 
            pen.nama_penumpang, 
            pen.id_penumpang, 
            ka.nama_kereta, 
            p.asal, 
            p.tujuan, 
            CONCAT(p.tanggal_keberangkatan, ' ', p.waktu_keberangkatan) as waktu_keberangkatan,
            p.nomor_gerbong, 
            p.nomor_kursi, 
            p.biaya
        FROM pembelian p
        JOIN penumpang pen ON p.id_penumpangfk = pen.id_penumpang
        JOIN kereta_api ka ON p.id_keretafk = ka.id_kereta
        WHERE p.id_pembelian = $id_pembelian
    ";

    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo '<script>alert("Unknown Reservation ID.");location.replace("./pembelian.php")</script>';
        exit;
    }
} else {
    echo '<script>alert("Reservation ID is required to view this page.");location.replace("./pembelian.php")</script>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .ticket {
            border: 2px dashed #000;
            padding: 20px;
            margin: 20px 0;
            position: relative;
        }
        .ticket .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .ticket .header img {
            width: 100px;
        }
        .ticket .content {
            font-size: 16px;
        }
        .ticket .content b {
            display: inline-block;
            width: 150px;
        }
        .ticket .footer {
            text-align: right;
            margin-top: 20px;
        }
        @media print {
            .noprint {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="ticket">
            <div class="header">
                <h2>Reservation Ticket</h2>
            </div>
            <div class="content">
                <p><b>No Pembelian:</b> <?= $row['id_pembelian'] ?></p>
                <p><b>Nama:</b> <?= $row['nama_penumpang'] ?></p>
                <p><b>Nomor Identitas:</b> <?= $row['id_penumpang'] ?></p>
                <p><b>Kereta Api:</b> <?= $row['nama_kereta'] ?></p>
                <p><b>Asal:</b> <?= $row['asal'] ?></p>
                <p><b>Tujuan:</b> <?= $row['tujuan'] ?></p>
                <p><b>Waktu Keberangkatan:</b> <?= $row['waktu_keberangkatan'] ?></p>
                <p><b>Gerbong/Kursi:</b> KA<?= $row['nomor_gerbong'] ?>/<?= $row['nomor_kursi'] ?></p>
                <p><b>Biaya:</b> Rp <?= number_format($row['biaya'], 0, ',', '.') ?></p>
            </div>
            <div class="footer">
                <button class="btn btn-primary noprint" onclick="window.print()">Print Ticket</button>
            </div>
        </div>
    </div>
</body>
</html>

<?php mysqli_close($conn); ?>
