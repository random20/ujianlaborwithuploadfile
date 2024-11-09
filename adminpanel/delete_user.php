<?php
include '../config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus user berdasarkan ID
    $query = mysqli_query($db, "DELETE FROM user WHERE id='$id'");

    if ($query) {
        echo "User deleted successfully";
    } else {
        echo "Error deleting user";
    }
}
?>
