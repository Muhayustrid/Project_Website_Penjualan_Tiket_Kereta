<?php
include 'koneksi.php';


if (isset($_POST["daftar"])) {

    $nama_penumpang = $_POST['nama_penumpang'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $no_telpon = $_POST['no_telp'];
    $gender = $_POST['gender'];
    $tanggal_lahir = $_POST['tgl_lahir'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("INSERT INTO penumpang(nama_penumpang, username, email, no_telpon, gender, tanggal_lahir, password, foto_profil) VALUES (?, ?, ?, ?, ?, ?, ?, NULL)");
    $stmt->bind_param("sssssss", $nama_penumpang, $username, $email, $no_telpon, $gender, $tanggal_lahir, $password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Data Berhasil Terdaftar";
    } else {
        echo "Error: " . $stmt->error;
    }
    // Close the connection
    $stmt->close();
    $conn->close();
    header("Location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Page</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="container-Daftar">
        <div class="header">Daftar</div>
        <form method="post">
            <div style="position: relative;">
                <input type="text" name="nama_penumpang" id="nama_penumpang" required>
                <label for="nama_penumpang">Nama Penumpang</label>
            </div>
            <div style="position: relative;">
                <input type="text" name="username" id="username" required>
                <label for="username">Username</label>
            </div>
            <div style="position: relative;">
                <input type="email" name="email" id="email" required>
                <label for="email">Email</label>
            </div>
            <div style="position: relative;">
                <input type="tel" name="no_telp" id="no_telp" required>
                <label for="no_telp">No Telepon</label>
            </div>
            <div style="position: relative;">
                <input type="date" name="tgl_lahir" id="tgl_lahir" placeholder=" " required>
                <label for="tgl_lahir">Tanggal Lahir</label>
            </div>
            <div style="position: relative;">
                <select name="gender" id="gender" required>
                    <option value="" disabled selected></option>
                    <option value="laki-laki">Laki-Laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
                <label for="gender">Gender</label>
            </div>
            <div style="position: relative;">
                <input type="password" name="password" id="password" required>
                <label for="password">Password</label>
            </div>
            <div style="position: relative;">
                <input type="password" name="confirm_password" id="confirm_password" required>
                <label for="confirm_password">Confirm Password</label>
            </div>
            <input type="submit" class="Daftar" name="daftar" value="Daftar"></a>
            <a href="login.php"><input type="button" class="Masuk" value="Masuk"></a>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectElements = document.querySelectorAll('select');
            selectElements.forEach(select => {
                select.addEventListener('change', function () {
                    if (this.value) {
                        this.classList.add('filled');
                    } else {
                        this.classList.remove('filled');
                    }
                });

                // Add 'filled' class on page load if there's a value
                if (select.value) {
                    select.classList.add('filled');
                }
            });

            // Set the max date for the date input
            const today = new Date();
            const yesterday = new Date(today);
            yesterday.setDate(yesterday.getDate() - 1);
            const maxDate = yesterday.toISOString().split('T')[0];
            document.getElementById('tgl_lahir').setAttribute('max', maxDate);
        });
    </script>
</body>

</html>
