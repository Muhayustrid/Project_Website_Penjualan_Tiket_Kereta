<?php
include "koneksi.php";

if (isset($_GET['id_pembelian']) && is_numeric($_GET['id_pembelian'])) {
    $id_pembelian = $_GET['id_pembelian'];

    $query = "DELETE FROM pembelian WHERE id_pembelian = '$id_pembelian'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Pembelian berhasil dibatalkan!'); window.location.href='pembelian.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
