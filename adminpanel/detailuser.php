<?php
include '../config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data user berdasarkan ID
    $query = mysqli_query($db, "SELECT * FROM user WHERE id='$id'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        // Kirim data sebagai JSON
        echo json_encode($data);
    } else {
        echo json_encode(['error' => 'User not found']);
    }
}
?>
