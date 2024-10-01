<?php
session_start(); // Start the session


include "koneksi.php";

if (isset($_GET['id'])) {
    $id_stasiun = $_GET['id'];
    $query = "DELETE FROM stasiun WHERE id_stasiun = '$id_stasiun'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: daftar_stasiun.php");
        exit;
    } else {
        echo "Error: ". mysqli_error($conn);
        exit;
    }
}

mysqli_close($conn);
?>