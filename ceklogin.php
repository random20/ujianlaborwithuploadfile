<?php
session_start();

// Menghubungkan PHP dengan koneksi database
include 'config.php';

// Menangkap data yang dikirim dari form login
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? '';

// Periksa apakah role dipilih
if (empty($role)) {
    header("location:index.php?pesan=role_kosong");
    exit;
}

// Menggunakan prepared statement untuk menghindari SQL Injection
$stmt = $db->prepare("SELECT * FROM user WHERE username = ? AND password = ? AND role = ?");
$stmt->bind_param("sss", $username, $password, $role);
$stmt->execute();
$result = $stmt->get_result();
$cek = $result->num_rows;

// Cek apakah username, password, dan role ditemukan di database
if ($cek > 0) {
    $data = $result->fetch_assoc();

    // Buat session login dan role sesuai dengan data pengguna
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $data['role'];

    // Cek role untuk menentukan dashboard yang benar
    if ($data['role'] == "admin") {
        header("location:adminpanel/index.php");
        exit;

    } else if ($data['role'] == "calonsiswa") {
        header("location:calonsiswapanel/index.php");
        exit;
    } 
} else {
    // Redirect jika login gagal
    header("location:index.php");
    exit;
}

$stmt->close();
$db->close();
?>
