<?php
session_start();
require_once 'koneksi.php';

/* =========================
   CEK LOGIN
========================= */

if (!isset($_SESSION['user'])) {

    header('Location: login.php');
    exit;

}

function e($text)
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

$id_user = $_SESSION['user']['id_user'];

/* =========================
   SIMPAN ULASAN
========================= */

if (isset($_POST['kirim'])) {

    $id_buku = (int) $_POST['id_buku'];

    $ulasan = mysqli_real_escape_string(
        $koneksi,
        $_POST['ulasan']
    );

    $reting = (int) $_POST['reting'];

    mysqli_query($koneksi, "

        INSERT INTO ulasan
        (
            id_user,
            id_buku,
            ulasan,
            reting
        )

        VALUES
        (
            '$id_user',
            '$id_buku',
            '$ulasan',
            '$reting'
        )

    ");

    echo "

    <script>

        alert('Ulasan berhasil dikirim');

        window.location='ulasan.php';

    </script>

    ";

}

/* =========================
   DATA ULASAN
========================= */

$query = mysqli_query($koneksi, "

    SELECT *

    FROM ulasan

    LEFT JOIN buku
    ON buku.id_buku = ulasan.id_buku

    LEFT JOIN user
    ON user.id_user = ulasan.id_user

    ORDER BY id_ulasan DESC

");

/* =========================
   DATA BUKU
========================= */

$buku = mysqli_query($koneksi, "

    SELECT *

    FROM buku

    ORDER BY judul ASC

");

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Ulasan Buku</title>

<link rel="stylesheet"
href="css/adminlte.min.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<style>

body{

    background:
    linear-gradient(
    180deg,
    #f8fbff 0%,
    #eef4ff 100%);

    min-height:100vh;
}

.navbar-custom{

    background:
    linear-gradient(
    135deg,
    #0f172a,
    #1d4ed8);
}

.page-title{

    font-weight:800;
    color:#0f172a;
}

.card-ulasan{

    border:none;
    border-radius:22px;
    overflow:hidden;
    background:#fff;

    box-shadow:
    0 15px 35px rgba(0,0,0,.08);
}

.rating{

    color:#facc15;
    font-size:20px;
}

.form-control,
.form-select{

    border-radius:12px;
}

.btn{

    border-radius:12px;
}

.ulasan-item{

    padding:20px;

    border-bottom:
    1px solid #e2e8f0;
}

.ulasan-item:last-child{

    border-bottom:none;
}

.user-avatar{

    width:45px;
    height:45px;

    border-radius:50%;

    background:#2563eb;

    color:#fff;

    display:flex;
    align-items:center;
    justify-content:center;

    font-weight:bold;
}

.empty-box{

    padding:60px 20px;
    text-align:center;
}

.empty-box i{

    font-size:70px;
    color:#cbd5e1;
    margin-bottom:15px;
}

</style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow">

<div class="container">

<a class="navbar-brand fw-bold"
href="katalog.php">

<i class="fas fa-book-open"></i>

Perpustakaan Digital

</a>

<div class="ms-auto d-flex gap-2">

<a href="buku_saya.php"
class="btn btn-light btn-sm">

<i class="fas fa-book"></i>

Buku Saya

</a>

<a href="katalog.php"
class="btn btn-primary btn-sm">

<i class="fas fa-arrow-left"></i>

Katalog

</a>

</div>

</div>

</nav>

<div class="container py-5">

<div class="row">

<!-- FORM ULASAN -->

<div class="col-lg-4 mb-4">

<div class="card card-ulasan">

<div class="card-body">

<h4 class="fw-bold mb-4">

<i class="fas fa-star text-warning"></i>

Tulis Ulasan

</h4>

<form method="POST">

<div class="mb-3">

<label class="fw-bold mb-2">

Pilih Buku

</label>

<select
name="id_buku"
class="form-select"
required>

<option value="">
-- Pilih Buku --
</option>

<?php while($b = mysqli_fetch_array($buku)){ ?>

<option value="<?= $b['id_buku']; ?>">

<?= e($b['judul']); ?>

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label class="fw-bold mb-2">

Rating

</label>

<select
name="reting"
class="form-select"
required>

<option value="5">⭐⭐⭐⭐⭐</option>
<option value="4">⭐⭐⭐⭐</option>
<option value="3">⭐⭐⭐</option>
<option value="2">⭐⭐</option>
<option value="1">⭐</option>

</select>

</div>

<div class="mb-4">

<label class="fw-bold mb-2">

Ulasan

</label>

<textarea
name="ulasan"
class="form-control"
rows="5"
placeholder="Tulis ulasan buku..."
required></textarea>

</div>

<button
type="submit"
name="kirim"
class="btn btn-primary w-100">

<i class="fas fa-paper-plane me-1"></i>

Kirim Ulasan

</button>

</form>

</div>

</div>

</div>

<!-- DAFTAR ULASAN -->

<div class="col-lg-8">

<div class="card card-ulasan">

<div class="card-body">

<div class="d-flex justify-content-between align-items-center mb-4">

<h4 class="fw-bold mb-0">

<i class="fas fa-comments text-primary"></i>

Daftar Ulasan

</h4>

<span class="badge bg-primary">

<?= mysqli_num_rows($query); ?> Ulasan

</span>

</div>

<?php
if(mysqli_num_rows($query) > 0){

while($data = mysqli_fetch_array($query)){
?>

<div class="ulasan-item">

<div class="d-flex justify-content-between align-items-start">

<div class="d-flex">

<div class="user-avatar me-3">

<?= strtoupper(substr($data['nama'],0,1)); ?>

</div>

<div>

<h5 class="fw-bold mb-1">

<?= e($data['judul']); ?>

</h5>

<div class="text-muted small mb-2">

<?= e($data['nama']); ?>

</div>

<div class="rating mb-2">

<?php

for($i = 1; $i <= 5; $i++){

    if($i <= $data['reting']){

        echo "⭐";

    }else{

        echo "☆";

    }

}

?>

</div>

<p class="mb-0">

<?= e($data['ulasan']); ?>

</p>

</div>

</div>

</div>

</div>

<?php
}
}else{
?>

<div class="empty-box">

<i class="fas fa-comments"></i>

<h5 class="fw-bold">

Belum ada ulasan

</h5>

<p class="text-muted">

Jadilah yang pertama memberi ulasan buku

</p>

</div>

<?php } ?>

</div>

</div>

</div>

</div>

</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="js/adminlte.min.js"></script>

</body>
</html>