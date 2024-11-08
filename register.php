<!DOCTYPE html>
<html>

<head>
    <title>REGISTER</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>

<body>
    <div class="menuutama">
        <p class="tulisan_menu">REGISTER</p>

        <form action="registercs.php" method="POST" name="menu">
            <label>USERNAME</label>
            <br>
            <input type="text" name="username" class="form_isian">
            <br>
            <label>PASSWORD</label>
            <br>
            <input type="password" name="password" class="form_isian">
            <br>
            <input type="hidden" name="role" class="form_isian">
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