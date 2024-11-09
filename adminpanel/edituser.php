<?php

session_start();

include '../config.php';

if (isset($_POST['edit'])) {

    // cek apakah yang mengakses halaman ini sudah login
    if ($_SESSION['level'] == "calonsiswa" | $_SESSION['level'] == "") {
        header("location:gagal_login");
    }else {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $level = $_POST['level'];

        $mysqli = "UPDATE user SET username='$username', password='$password', level='$level' WHERE id='$id'";
        $result = mysqli_query($db, $mysqli);

        if ($result) {
            echo "INPUT BERHASIL";
        } else {
            echo "GAGAL";
        }

        mysqli_close($db);

        header("location:index.php");
    }

} elseif (isset($_POST['hapus'])) {

    // cek apakah yang mengakses halaman ini sudah login
    if ($_SESSION['level'] == "calonsiswa" | $_SESSION['level'] == "") {
        header("location:gagal_login");
    }else {
        $id = $_POST['id'];

        $mysqli = "DELETE FROM user WHERE id=$id";
        $query = mysqli_query($db, $mysqli);

        if( $query ){
            header('Location: index.php.php');
        } else {
            die("gagal menghapus...");
        }

        mysqli_close($db);

        header("location:index.php");
    }

}else {

}

?>