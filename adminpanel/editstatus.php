<?php
session_start();

// Periksa apakah admin sudah login
if ($_SESSION['role'] != "admin") {
    header("location:gagal_login");
    exit();
}

include '../config.php';

// Cek apakah parameter id dan statuscs ada di POST
if (isset($_POST['id']) && isset($_POST['statuscs'])) {
    $id = $_POST['id'];
    $statuscs = $_POST['statuscs'];

    // Update status calon siswa di database
    $stmt = $db->prepare("UPDATE pendaftaran SET statuscs = ? WHERE id = ?");
    $stmt->bind_param("si", $statuscs, $id);
    
    if ($stmt->execute()) {
        // Jika update berhasil, alihkan ke halaman status pendaftaran dengan pesan sukses
        header("Location: informasipendaftar.php?pesan=berhasil");
    } else {
        // Jika gagal, alihkan ke halaman status pendaftaran dengan pesan error
        header("Location: informasipendaftar.php?pesan=gagal");
    }

    $stmt->close();
} else {
    // Jika data tidak lengkap, alihkan kembali dengan pesan error
    header("Location: informasipendaftar.php?pesan=gagal");
}
?>
