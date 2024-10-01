<?php
include "koneksi.php";

$id_kereta = $_POST['id_kereta'];

$query = "
    SELECT s.nama_stasiun, j.waktu_keberangkatan, j.waktu_sampai
    FROM jadwal_kereta j
    JOIN stasiun s ON j.id_stasiun_asal = s.id_stasiun
    WHERE j.id_kereta = $id_kereta
    ORDER BY id_jadwal asc
";
$result = mysqli_query($conn, $query);

$output = '';
while ($row = mysqli_fetch_assoc($result)) {
    $output .= '
    <tr>
        <td>' . $row['nama_stasiun'] . '</td>
        <td>' . ($row['waktu_sampai'] ? $row['waktu_sampai'] : '-') . '</td>
        <td>' . ($row['waktu_keberangkatan'] ? $row['waktu_keberangkatan'] : '-') . '</td>
    </tr>
    ';
}
echo $output;
?>
