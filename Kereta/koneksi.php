<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "keretaapi";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT nama_stasiun FROM stasiun";
$result = $conn->query($query);

$stasiun = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $stasiun[] = $row;
    }
}

?>
