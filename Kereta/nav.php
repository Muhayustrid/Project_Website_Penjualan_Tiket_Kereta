<?php 

$usr = $_SESSION["user"];
?>
<nav class="navbar navbar-expand-lg" style="background-color: #0E4EB5;">
    <a class="navbar-brand text-white" href="#">Healing.com</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link text-white" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="reservasi.php">Reservation</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="jadwal.php">Jadwal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="pembelian.php">pembelian</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
        <img id="currentImage" src="uploads/foto_profil/<?= $usr["foto_profil"] ?>" alt="Profile Picture" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover; margin-right: 10px;">
            </li>
        
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Profile
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="profile.php">Account</a>
                    <a class="dropdown-item" href="login.php">Log Out</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
