<?php 
session_start();
include "koneksi.php";

$usr = $_SESSION["user"];

function upload()
{
    $namaFile = $_FILES['fileinput']['name'];
    $ukuranFile = $_FILES['fileinput']['size'];
    $error = $_FILES['fileinput']['error'];
    $tmpName = $_FILES['fileinput']['tmp_name'];

    // cek apakah gambar sudah diupload
    if ($error === 4) {
        echo "<script>
        alert('gambar belum diupload');
        </script>";
        return false;
    }

    // cek apakah benar ekstensi gambar yang diupload
    $ekstensiGambarValid = ['jpeg', 'jpg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
        alert('ekstensi gambar yang diperbolehkan adalah jpeg, jpg, png');
        </script>";
        return false;
    }

    // cek jika size melebihi yang diperbolehkan
    if ($ukuranFile > 800000) {
        echo "<script>
        alert('gambar melebihi ukuran yang diperbolehkan');
        </script>";
        return false;
    }

    // lolos pengecekan, file dimasukkan ke dalam folder
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, 'uploads/foto_profil/' . $namaFileBaru);
    return $namaFileBaru;
}

if (isset($_POST["update"])) {
    $id_penumpang = $usr["id_penumpang"];
    $nama_penumpang = $_POST['nama_penumpang'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $no_telpon = $_POST['no_telp'];
    $gender = $_POST['gender'];
    $tanggal_lahir = $_POST['tgl_lahir'];
    $foto_profil = upload();

    // Proses update ke database
    $sql = "UPDATE penumpang SET 
            nama_penumpang = ?, 
            username = ?, 
            email = ?, 
            no_telpon = ?, 
            tanggal_lahir = ?,
            foto_profil = ?
            WHERE id_penumpang = ?";

    if (!$stmt = $conn->prepare($sql)) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    if (!$stmt->bind_param("ssssssi", $nama_penumpang, $username, $email, $no_telpon, $tanggal_lahir, $foto_profil, $id_penumpang)) {
        die('Bind param failed: ' . htmlspecialchars($stmt->error));
    }

    // Update data in session
    if ($stmt->execute()) {
        $sql = mysqli_query($conn, "SELECT * FROM penumpang WHERE id_penumpang='$id_penumpang'");
        $usr = mysqli_fetch_assoc($sql);
        $_SESSION["user"] = $usr;

        if (isset($_POST["curr_pass"])) {
            $pass = $_POST["curr_pass"];
            if ($pass == $usr["password"] && $_POST["new_pass"] == $_POST["re_new_pass"]) {
                $sql = "UPDATE penumpang SET password = ? WHERE id_penumpang = ?";
                $stmt = $conn->prepare($sql);
                if ($stmt === false) {
                    die('Prepare failed: ' . htmlspecialchars($conn->error));
                }
                $stmt->bind_param("si", $_POST["new_pass"], $id_penumpang);
                $stmt->execute();
            }
        }

        echo "<script>alert('Berhasil memperbarui data!'); window.location.href='index.php';</script>";
    } else {
        echo "Execute failed: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodingDung | Profile Template</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f5f5;
            margin-top: 20px;
        }

        #currentImage {
            width: 80px;
            height: 80px;
            object-fit: cover;
        }

        .ui-w-80 {
            width: 80px !important;
            height: auto;
        }

        .btn-default {
            border-color: rgba(24, 28, 33, 0.1);
            background: rgba(0, 0, 0, 0);
            color: #4E5155;
        }

        label.btn {
            margin-bottom: 0;
        }

        .btn-outline-primary {
            border-color: #26B4FF;
            background: transparent;
            color: #26B4FF;
        }

        .btn {
            cursor: pointer;
        }

        .text-light {
            color: #babbbc !important;
        }

        .btn-facebook {
            border-color: rgba(0, 0, 0, 0);
            background: #3B5998;
            color: #fff;
        }

        .btn-instagram {
            border-color: rgba(0, 0, 0, 0);
            background: #000;
            color: #fff;
        }

        .card {
            background-clip: padding-box;
            box-shadow: 0 1px 4px rgba(24, 28, 33, 0.012);
        }

        .row-bordered {
            overflow: hidden;
        }

        .account-settings-fileinput {
            position: absolute;
            visibility: hidden;
            width: 1px;
            height: 1px;
            opacity: 0;
        }

        .account-settings-links .list-group-item.active {
            font-weight: bold !important;
        }

        html:not(.dark-style) .account-settings-links .list-group-item.active {
            background: transparent !important;
        }

        .account-settings-multiselect~.select2-container {
            width: 100% !important;
        }

        .light-style .account-settings-links .list-group-item {
            padding: 0.85rem 1.5rem;
            border-color: rgba(24, 28, 33, 0.03) !important;
        }

        .light-style .account-settings-links .list-group-item.active {
            color: #4e5155 !important;
        }

        .material-style .account-settings-links .list-group-item {
            padding: 0.85rem 1.5rem;
            border-color: rgba(24, 28, 33, 0.03) !important;
        }

        .material-style .account-settings-links .list-group-item.active {
            color: #4e5155 !important;
        }

        .dark-style .account-settings-links .list-group-item {
            padding: 0.85rem 1.5rem;
            border-color: rgba(255, 255, 255, 0.03) !important;
        }

        .dark-style .account-settings-links .list-group-item.active {
            color: #fff !important;
        }

        .light-style .account-settings-links .list-group-item.active {
            color: #4E5155 !important;
        }

        .light-style .account-settings-links .list-group-item {
            padding: 0.85rem 1.5rem;
            border-color: rgba(24, 28, 33, 0.03) !important;
        }
    </style>
</head>

<body>
    <div class="container light-style flex-grow-1 container-p-y">
        <form method="post" action="profile.php" enctype="multipart/form-data">
            <h4 class="font-weight-bold py-3 mb-4">
                Account settings
            </h4>
            <div class="card overflow-hidden">
                <div class="row no-gutters row-bordered row-border-light">
                    <div class="col-md-3 pt-0">
                        <div class="list-group list-group-flush account-settings-links">
                            <a class="list-group-item list-group-item-action active" data-toggle="list"
                                href="#account-general">General</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list"
                                href="#account-change-password">Change password</a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="account-general">
                            <div class="card-body media align-items-center">
                                <img id="currentImage" src="uploads/foto_profil/<?= $usr["foto_profil"] ?>" alt class="d-block ui-w-80">
                                <div class="media-body ml-4">
                                    <label class="btn btn-outline-primary">
                                        Upload new photo
                                        <input type="file" class="account-settings-fileinput" id="fileInput" name="fileinput" accept="image/*" onchange="previewImage(event)">
                                    </label> &nbsp;
                                    <button type="button" class="btn btn-default md-btn-flat" onclick="resetImage()">Reset</button>
                                    <div class="text-light small mt-1">Allowed JPG, GIF or PNG. Max size of 800K</div>
                                </div>
                            </div>
                                <hr class="border-light m-0">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control mb-1" name="username" value="<?= $usr["username"] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="nama_penumpang" value="<?= $usr["nama_penumpang"] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">E-mail</label>
                                        <input type="text" class="form-control mb-1" name="email" value="<?= $usr["email"] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Birthday</label>
                                        <input type="text" class="form-control" name="tgl_lahir" value="<?= $usr["tanggal_lahir"] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Phone</label>
                                        <input type="text" class="form-control" name="no_telp" value="<?= $usr["no_telpon"] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-change-password">
                                <div class="card-body pb-2">
                                    <div class="form-group">
                                        <label class="form-label">Current password</label>
                                        <input type="password" name="curr_pass" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">New password</label>
                                        <input type="password" name="new_pass" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Repeat new password</label>
                                        <input type="password" name="re_new_pass" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right mt-3">
                    <button type="submit" class="btn btn-primary" name="update">Save changes</button>&nbsp;
                    <button type="button" class="btn btn-default" onclick="cancel()">Cancel</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        let originalImageSrc = document.getElementById('currentImage').src;

        function previewImage(event) {
            const file = event.target.files[0];
            if (file && file.size <= 800 * 1024) { // Check if file size is less than 800KB
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById('currentImage');
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                alert('File is too large or not supported.');
            }
        }

        function resetImage() {
            document.getElementById('fileInput').value = '';
            const img = document.getElementById('currentImage');
            img.src = originalImageSrc;
        }

        function cancel() {
            window.location.href = "index.php";
        }
    </script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
