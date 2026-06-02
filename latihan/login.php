<?php


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
    <div class="wrapper">
        <div class="container" id="div-judul">
            <h1 id="judul-form">Reservasi <br>Silahkan Login Dulu </h1>
        </div>
    <form action="script-login.php" method="post" class="container">
        <div class="div_input">
            <input type="text" name="username" class="input" id="username" placeholder="Username">
        </div>
        <div class="div_input">
            <input type="password" name="password" class="input" id="password" placeholder="Password">
        </div>
        <div class="div_input" id="div-login">
            <input type="submit" name="daftar" class="input" id="tbl-login" value="Login">
        </div>
        
    </form>
    <div class="container" id="div-daftar">
        <label>Belum Punya Akun Silahkan klik tombol Daftar</label>
        <a href="registrasi.php" class="daftar">
            <div id="tbl-daftar">Daftar</div>
        </a>
    </div>
    </div>
</body>
</html>