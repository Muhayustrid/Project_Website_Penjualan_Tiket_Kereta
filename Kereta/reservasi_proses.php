<?php
session_start();
include "koneksi.php";
if (!isset($_SESSION["masuk"])) {
    header("Location: login.php");
    exit;
}
$id_penumpang = $_SESSION['id_penumpang'];
$stasiunAsal = $_POST['stasiunAsal'];
$stasiunTujuan = $_POST['stasiunTujuan'];
$tanggalKeberangkatan = $_POST['tanggalKeberangkatan'];
$gerbong = (int)$_POST['gerbong'];
$kursi = (int)$_POST['kursi'];
$idKereta = $_POST['idKereta'];
$waktuKeberangkatan = $_POST['waktuKeberangkatan'];
$waktuTiba = $_POST['waktuTiba'];
$biaya = (int)$_POST['biaya'];


// Insert reservation
$query = "
    INSERT INTO pembelian 
    (id_keretafk, id_penumpangfk, asal, tujuan, waktu_keberangkatan, waktu_tiba, tanggal_keberangkatan, tanggal_tiba, nomor_gerbong, nomor_kursi, biaya) 
    VALUES 
    ($idKereta, $id_penumpang, '$stasiunAsal', '$stasiunTujuan', '$waktuKeberangkatan', '$waktuTiba', '$tanggalKeberangkatan', '$tanggalKeberangkatan', $gerbong, $kursi, $biaya)
";

if (mysqli_query($conn, $query)) {
        echo "<script>alert('Pemesanan berhasil!'); window.location.href='reservasi.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
mysqli_close($conn);
?>
