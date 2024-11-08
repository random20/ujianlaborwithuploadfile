<?php
session_start();
include('../config.php');

// Cek apakah pengguna sudah login dan role adalah "calonsiswa"
if ($_SESSION['role'] != "calonsiswa") {
    header("location:gagal_login.php");
    exit;
} else {
    // Siapkan statement untuk memeriksa apakah user dengan username yang sama sudah mendaftar
    $stmt = $db->prepare("SELECT username FROM pendaftaran WHERE username = ?");
    $stmt->bind_param("s", $_SESSION['username']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Jika data dengan username ini sudah ada, tampilkan pesan kesalahan dan alihkan
        echo '<script language="javascript">
              alert("Anda sudah mengisi biodata. Anda tidak dapat mengisi formulir lagi.");
              window.location="index.php";
              </script>';
        exit();
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>PENDAFTARAN</title>
    <link rel="stylesheet" type="text/css" href="../assets/style.css">
</head>
<body>
    <div class="menuutama">
        <p class="tulisan_menu">PENDAFTARAN SISWA BARU</p>

        <form action="inputpendaftaran.php" method="post" name="menu" enctype="multipart/form-data">
            <label>Nama</label>
            <br>
            <input type="text" name="nama" class="form_isian" placeholder="nama anda" required>
            <br>
            <label>NISN</label>
            <br>
            <input type="text" name="nisn" class="form_isian" placeholder="NISN anda" required>
            <br>
            <label>Jurusan</label>
            <br>
            <input type="text" name="jurusan" class="form_isian" placeholder="jurusan Anda" required>
            <br>
            <label>Email</label>
            <br>
            <input type="email" name="email" class="form_isian" placeholder="EMAIL" required>
            <br>
            <label>NoHp</label>
            <br>
            <input type="text" name="nohp" class="form_isian" placeholder="NO HP" required>
            <br>
            <label>Alamat</label>
            <br>
            <input type="text" name="alamat" class="form_isian" placeholder="Alamat Anda" required>
            <br>
            <label>Nilai Rata-Rata</label>
            <br>
            <input type="text" name="ratanilai" class="form_isian" placeholder="Nilai Rata - Rata (ex : 85.5)" required>
            <br>
            <label>KTP</label>
            <br>
            <input type="file" name="ktp" class="form_isian" accept="image/*" required>
            <br>

            <input type="submit" class="tombol_submit" value="SUBMIT">
            <br /><br />
            <center>
                <a class="link" href="index.php">kembali</a>
            </center>
        </form>
    </div>
</body>
</html>
