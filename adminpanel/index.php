<!DOCTYPE html>
<html>

<head>
    <title>EZI</title>
    <link rel="stylesheet" type="text/css" href="../assets/style.css">
</head>

<?php
session_start();

// cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['role'] != "admin") {
    header("location:gagal_login");
}

?>

<body>
    <div class="menuutama">
        <p class="tulisan_menu">SELAMAT DATANG <?php echo $_SESSION['role']; ?></p>

        <form name="menu">
        <br><br>
            <a href="informasipendaftar.php">
                <input type="button" value="Informasi Pendaftar" class="menu">
            </a>
            <br><br>
            <a href="daftarakun.php">
                <input type="button" value="Daftar Akun" class="menu">
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