<?php
session_start(); // Start the session


include "koneksi.php";

if (isset($_GET['id'])) {
    $id_penumpang = $_GET['id'];
    $query = "DELETE FROM penumpang WHERE id_penumpang = '$id_penumpang'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: daftar_penumpang.php");
        exit;
    } else {
        echo "Error: ". mysqli_error($conn);
        exit;
    }
}

mysqli_close($conn);
?>