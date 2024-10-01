<?php
include "koneksi.php";

$stasiunAsal = $_POST['stasiunAsal'];
$stasiunTujuan = $_POST['stasiunTujuan'];
$tanggalKeberangkatan = $_POST['tanggalKeberangkatan'];
$gerbong = (int)$_POST['gerbong'];
$kursi = (int)$_POST['kursi'];

// Get current date and time
date_default_timezone_set('Asia/Jakarta');
$currentDateTime = date('Y-m-d H:i:s');

// Query to get trains that stop at the starting and ending stations and haven't departed yet
$query = "
    SELECT 
        k.id_kereta, 
        k.nama_kereta, 
        j1.waktu_keberangkatan AS waktu_keberangkatan_asal, 
        j2.waktu_sampai AS waktu_sampai_tujuan, 
        k.biaya, 
        TIMEDIFF(j2.waktu_sampai, j1.waktu_keberangkatan) AS durasi
    FROM jadwal_kereta j1
    JOIN jadwal_kereta j2 ON j1.id_kereta = j2.id_kereta
    JOIN kereta_api k ON j1.id_kereta = k.id_kereta
    JOIN stasiun s1 ON j1.id_stasiun_asal = s1.id_stasiun
    JOIN stasiun s2 ON j2.id_stasiun_tujuan = s2.id_stasiun
    WHERE s1.nama_stasiun = '$stasiunAsal'
      AND s2.nama_stasiun = '$stasiunTujuan'
      AND j1.waktu_keberangkatan < j2.waktu_sampai
      AND CONCAT('$tanggalKeberangkatan', ' ', j1.waktu_keberangkatan) > '$currentDateTime'
";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo '<div class="table-responsive"><table class="table table-bordered">';
    echo '<thead class="thead-dark"><tr><th>Kereta</th><th>Berangkat</th><th>Durasi</th><th>Tiba</th><th>Harga</th><th>Status</th></thead><tbody>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['nama_kereta'] . '</td>';
        echo '<td>' . $stasiunAsal . ' ' . $row['waktu_keberangkatan_asal'] . '</td>';
        echo '<td>' . $row['durasi'] . '</td>';
        echo '<td>' . $stasiunTujuan . ' ' . $row['waktu_sampai_tujuan'] . '</td>';
        echo '<td>Rp ' . number_format($row['biaya'], 0, ',', '.') . '</td>';
        echo '<td>
                <form action="reservasi_proses.php" method="post">
                    <input type="hidden" name="stasiunAsal" value="' . $stasiunAsal . '">
                    <input type="hidden" name="stasiunTujuan" value="' . $stasiunTujuan . '">
                    <input type="hidden" name="tanggalKeberangkatan" value="' . $tanggalKeberangkatan . '">
                    <input type="hidden" name="gerbong" value="' . $gerbong . '">
                    <input type="hidden" name="kursi" value="' . $kursi . '">
                    <input type="hidden" name="idKereta" value="' . $row['id_kereta'] . '">
                    <input type="hidden" name="waktuKeberangkatan" value="' . $row['waktu_keberangkatan_asal'] . '">
                    <input type="hidden" name="waktuTiba" value="' . $row['waktu_sampai_tujuan'] . '">
                    <input type="hidden" name="biaya" value="' . $row['biaya'] . '">
                    <button type="submit" class="btn btn-primary">Pesan</button>
                </form>
              </td>';
        echo '</tr>';
    }

    echo '</tbody></table></div>';
} else {
    echo '<div class="alert alert-warning" role="alert">Tidak ada kereta tersedia untuk rute yang dipilih.</div>';
}
?>
