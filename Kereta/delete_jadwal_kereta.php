<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();



include "koneksi.php";

if (!$conn) {
    echo "Error: Unable to connect to database";
    exit;
}

if (isset($_GET['id_jadwal'])) {
    $id_jadwal = $_GET['id_jadwal'];

    // Prepare the delete query
    $stmt = $conn->prepare("DELETE FROM jadwal_kereta WHERE id_jadwal =?");
    $stmt->bind_param("s", $id_jadwal);

    // Execute the query
    if (!$stmt->execute()) {
        echo "Error: ". $stmt->error;
        exit;
    } else {
        header("Location: jadwal_kereta.php");
        exit;
    }
}

mysqli_close($conn);
?>

<!-- HTML code to display a confirmation message -->
<!DOCTYPE html>
<html>
<head>
    <title>Delete Jadwal Kereta</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Delete Jadwal Kereta</h2>
                <div class="alert alert-success">
                    Jadwal kereta berhasil dihapus!
                </div>
                <a href="jadwal_kereta.php" class="btn btn-primary">Kembali ke Jadwal Kereta</a>
            </div>
        </div>
    </div>
</body>
</html>