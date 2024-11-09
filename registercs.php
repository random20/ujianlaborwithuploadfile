<?php
include 'config.php';

$username = $_POST['username'];
$password = $_POST['password'];
$role = "calonsiswa";


$mysqli = "INSERT INTO user (username, password, role) VALUES ('$username', '$password', '$role')";

$result = mysqli_query($db, $mysqli);

header('Location:index.php');

?>