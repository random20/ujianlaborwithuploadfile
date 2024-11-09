<?php
session_start();

// Cek login dan role
if ($_SESSION['role'] != 'calonsiswa') {
    header("location:gagal_login.php");
    exit;
}

// Konfigurasi dan koneksi database
include '../config.php';

// Validasi input yang diterima
$nama = $_POST['nama'] ? $_POST['nama'] : '';
$nisn = $_POST['nisn'] ? $_POST['nisn'] : '';
$jurusan = $_POST['jurusan'] ? $_POST['jurusan'] : '';
$email = $_POST['email'] ? $_POST['email'] : '';
$nohp = $_POST['nohp'] ? $_POST['nohp'] : '';
$alamat = $_POST['alamat'] ? $_POST['alamat'] : '';
$ratanilai = $_POST['ratanilai'] ? $_POST['ratanilai'] : '';
$username = $_SESSION['username'] ? $_SESSION['username'] : ''; // Ambil username dari session login

// Validasi dan upload file KTP
$uploadOk = true;
$ktp_name = basename($_FILES["ktp"]["name"]);
$imageFileType = strtolower(pathinfo($ktp_name, PATHINFO_EXTENSION));
$allowedTypes = ['jpg', 'jpeg', 'png'];

if (!in_array($imageFileType, $allowedTypes)) {
    echo "Hanya file JPG, JPEG, dan PNG yang diperbolehkan.";
    $uploadOk = false;
}

if ($uploadOk) {
    $ktp_name = uniqid() . "." . $imageFileType;
    $ktp_path = "../uploads/";
    if (move_uploaded_file($_FILES["ktp"]["tmp_name"], $ktp_path.$ktp_name)) {
        // Siapkan query aman menggunakan prepared statements
        $stmt = $db->prepare("INSERT INTO pendaftaran (username, nama, nisn, jurusan, email, nohp, alamat, ratanilai, ktp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $username, $nama, $nisn, $jurusan, $email, $nohp, $alamat, $ratanilai, $ktp_name);

        if ($stmt->execute()) {
            echo "Pendaftaran berhasil!";
            header("location:index.php");
        } else {
            echo "Gagal menyimpan data.";
        }
        $stmt->close();
    } else {
        echo "Maaf, terjadi kesalahan saat mengunggah file KTP.";
    }
}

// Tutup koneksi database
$db->close();
?>
