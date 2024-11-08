<!DOCTYPE html>
<html>

<head>
    <title>LOGIN</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>

<?php
if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == "gagal") {
        echo "<div class='alert'>nim dan Password tidak sesuai !</div>";
    }
}
?>

<body>
    <div class="menuutama">
        <p class="tulisan_menu">LOGIN</p>

        <form action="ceklogin.php" method="POST" name="menu">
            <label>USERNAME</label>
            <br>
            <input type="text" name="username" class="form_isian">
            <br>
            <label>PASSWORD</label>
            <br>
            <input type="password" name="password" class="form_isian">
            <br>
            <label>role</label>
            <br>
            <select id="role" name="role" class="form_isian">
                <option value="admin">admin</option>
                <option value="calonsiswa">calon siswa</option>
            </select>
            <br>

            <input type="submit" class="tombol_submit" value="SUBMIT">

            <br />
            <br />
            <center>
                <a class="link" href="index.php">kembali</a>
            </center>
        </form>

    </div>
</body>

</html>