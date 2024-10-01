<?php
session_start(); // Start the session

include "koneksi.php";
$id_pembelian = $_GET['id'];

// Delete the record
$query = "DELETE FROM pembelian WHERE id_pembelian = '$id_pembelian'";
$result = mysqli_query($conn, $query);

if ($result) {
    header("Location: daftar_pembelian.php");
    exit;
} else {
    echo "Error: " . mysqli_error($conn);
}
