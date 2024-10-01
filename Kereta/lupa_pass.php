<?php
include 'koneksi.php';

if (isset($_POST["reset"])) {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $nama_penumpang = $_POST["nama_penumpang"];
    $username = $_POST["username"];
    $no_telpon = $_POST["no_telp"];
    $tgl_lahir = $_POST["tgl_lahir"];
    $gender = $_POST["gender"];
    
    $sql = mysqli_query($conn, "SELECT * FROM penumpang WHERE email='$email'");
    $usr = mysqli_fetch_assoc($sql);
    
    if ($usr) {
        if ($nama_penumpang === $usr['nama_penumpang'] && $username === $usr['username'] 
        && $no_telpon === $usr['no_telpon'] && $tgl_lahir === $usr['tanggal_lahir'] 
        && $gender === $usr['gender']) {
                $id_penumpang = $usr["id_penumpang"];
                header("Location: reset_pass.php?id=$id_penumpang");
            exit;
        } else {
            $error = "Data salah!";
        }
    } else {
        $error = "Email tidak ditemukan!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="container-Daftar">
        <div class="header">Lupa Password</div>
        <p>Masukkan data sesuai email</p><br>
        <form method="post">
            <div style="position: relative;">
                <input type="email" name="email" id="email" required>
                <label for="email">Email</label>
            </div>
            <div style="position: relative;">
                <input type="text" name="nama_penumpang" id="nama_penumpang" required>
                <label for="nama_penumpang">Nama Penumpang</label>
            </div>
            <div style="position: relative;">
                <input type="text" name="username" id="username" required>
                <label for="username">Username</label>
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
                    <option value="Laki-laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                <label for="gender">Gender</label>
            </div>
            <input type="submit" class="Daftar" name="reset" value="Reset"></a>
            <a href="login.php"><input type="button" class="Masuk" value="Back"></a>
    
            <?php if(isset($error)): ?>
            <p style="color: red;"><?php echo $usr["nama_penumpang"]; ?></p>
            <p style="color: red;"><?php echo $usr["username"]; ?></p>
            <p style="color: red;"><?php echo $usr["no_telpon"]; ?></p>
            <p style="color: red;"><?php echo $usr["tanggal_lahir"]; ?></p>
            <p style="color: red;"><?php echo $usr["gender"]; ?></p>
            <?php endif; ?>
           
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