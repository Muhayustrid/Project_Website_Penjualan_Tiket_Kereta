<?php
$host = 'localhost'; // atau nama host database Anda
$db = 'keretaapi'; // nama database Anda
$user = 'root'; // username database Anda
$pass = ''; // password database Anda

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$term = $_GET['term'];

$sql = "SELECT * FROM stasiun WHERE nama LIKE '%" . $term . "%'";
$result = $conn->query($sql);

$stasiun = array();
while ($row = $result->fetch_assoc()) {
    $stasiun[] = $row;
}

echo json_encode($stasiun);

$conn->close();
?>
