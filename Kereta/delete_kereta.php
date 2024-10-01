<?php
session_start(); // Start the session


include "koneksi.php";

if (isset($_GET['id_kereta'])) {
    $id_kereta = $_GET['id_kereta'];

    // Check if the id_kereta value is valid
    if (empty($id_kereta) ||!is_numeric($id_kereta)) {
        echo "Invalid id_kereta value";
        exit;
    }

    // Delete the kereta record
    $query = "DELETE FROM kereta_api WHERE id_kereta = '$id_kereta'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "Error deleting kereta: ". mysqli_error($conn);
    } else {
        echo "Kereta deleted successfully";
        header("Location: daftar_kereta.php");
        exit;
    }
}

mysqli_close($conn);
?>