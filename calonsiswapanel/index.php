<!DOCTYPE html>
<html>

<head>
    <title>EZI</title>
    <link rel="stylesheet" type="text/css" href="../assets/style.css">
</head>

<?php
session_start();

// cek apakah yang mengakses halaman ini sudah login
if (!isset($_SESSION['role']) || $_SESSION['role'] != "calonsiswa") {
    header("location:gagal_login");
}

?>

<body>
    <div class="menuutama">
        <p class="tulisan_menu">SELAMAT DATANG <?php echo($_SESSION['username']); ?></p>

        <form name="menu">
        <br><br>
            <a href="statuspendaftaran.php">
                <input type="button" value="Status Daftar" class="menu">
            </a>
            <br><br>
            <a href="pendaftaran.php">
                <input type="button" value="Lengkapi Biodata Pendaftar" class="menu">
            </a>
            <br><br>
            <a href="logout.php">
                <input type="button" value="LOGOUT" class="menu" style="color:black;">
            </a>
            <br><br>
        </form>
    </div>
</body>

</html>