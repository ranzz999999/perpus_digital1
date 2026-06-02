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

/* =========================
   FUNCTION AMAN
========================= */

function e($text)
{
    return htmlspecialchars(
        (string)$text,
        ENT_QUOTES,
        'UTF-8'
    );
}

/* =========================
   DATA USER
========================= */

$id_user  = $_SESSION['user']['id_user'];
$username = $_SESSION['user']['username'] ?? 'Peminjam';

/* =========================
   AMBIL DATA PEMINJAMAN
========================= */

$query = mysqli_query($koneksi, "

    SELECT *

    FROM peminjaman

    LEFT JOIN buku
    ON buku.id_buku = peminjaman.id_buku

    WHERE peminjaman.id_user = '$id_user'

    ORDER BY peminjaman.id_peminjaman DESC

");

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Riwayat Peminjaman</title>

<link
rel="stylesheet"
href="css/adminlte.min.css">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link
rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<style>

/* =========================
   ROOT
========================= */

:root{

    --bg:#f4f7fb;
    --bg2:#eef4ff;

    --card:#ffffff;

    --text:#0f172a;
    --muted:#64748b;

    --border:#e2e8f0;

    --shadow:
    0 15px 35px rgba(0,0,0,.08);

}

/* =========================
   DARK MODE
========================= */

body.dark-mode{

    --bg:#0f172a;
    --bg2:#111827;

    --card:#1e293b;

    --text:#f8fafc;
    --muted:#cbd5e1;

    --border:#334155;

}

/* =========================
   BODY
========================= */

body{

    background:
    linear-gradient(
        180deg,
        var(--bg2) 0%,
        var(--bg) 100%
    );

    color:var(--text);

    min-height:100vh;

}

/* =========================
   NAVBAR
========================= */

.navbar-custom{

    background:
    linear-gradient(
        135deg,
        #0f172a,
        #1d4ed8
    );

    box-shadow:
    0 10px 30px rgba(0,0,0,.08);

}

/* =========================
   TITLE
========================= */

.page-title{

    font-size:36px;

    font-weight:800;

    color:var(--text);

}

.page-subtitle{

    color:var(--muted);

    font-size:15px;

}

/* =========================
   CARD
========================= */

.card-riwayat{

    border:none;

    border-radius:24px;

    overflow:hidden;

    background:var(--card);

    box-shadow:var(--shadow);

}

/* =========================
   TABLE
========================= */

.table{

    margin:0;

    color:var(--text);

}

.table thead th{

    background:
    rgba(59,130,246,.06);

    border:none;

    color:var(--muted);

    font-weight:700;

    padding:18px;

}

.table td{

    padding:18px;

    vertical-align:middle;

    border-color:var(--border);

}

.table tbody tr:hover{

    background:
    rgba(59,130,246,.04);

}

body.dark-mode .table{

    color:#fff;

}

body.dark-mode .table tbody tr:hover{

    background:
    rgba(255,255,255,.03);

}

/* =========================
   COVER
========================= */

.book-cover{

    width:65px;
    height:85px;

    object-fit:cover;

    border-radius:12px;

    margin-right:12px;

}

.empty-cover{

    width:65px;
    height:85px;

    border-radius:12px;

    background:#e2e8f0;

    display:flex;
    align-items:center;
    justify-content:center;

    color:#64748b;

    margin-right:12px;

}

body.dark-mode .empty-cover{

    background:#334155;

    color:#cbd5e1;

}

/* =========================
   BADGE
========================= */

.badge-dipinjam{

    background:#22c55e;

    color:#fff;

    padding:.5rem .9rem;

    border-radius:999px;

    font-size:.8rem;

    font-weight:600;

}

.badge-kembali{

    background:#3b82f6;

    color:#fff;

    padding:.5rem .9rem;

    border-radius:999px;

    font-size:.8rem;

    font-weight:600;

}

/* =========================
   EMPTY DATA
========================= */

.empty-box{

    padding:70px 20px;

    text-align:center;

}

.empty-box i{

    font-size:70px;

    margin-bottom:15px;

    color:#cbd5e1;

}

.empty-box h5{

    font-weight:700;

    color:var(--text);

}

.empty-box p{

    color:var(--muted);

}

/* =========================
   BUTTON
========================= */

.btn-back{

    border-radius:12px;

}

.theme-btn{

    position:fixed;

    right:25px;
    bottom:25px;

    width:55px;
    height:55px;

    border:none;

    border-radius:18px;

    background:#2563eb;

    color:#fff;

    font-size:20px;

    z-index:999;

    box-shadow:
    0 10px 25px rgba(37,99,235,.35);

}

/* =========================
   RESPONSIVE
========================= */

@media(max-width:768px){

    .page-title{

        font-size:28px;

    }

    .table td,
    .table th{

        white-space:nowrap;

    }

}

</style>

</head>

<body>

<!-- NAVBAR -->

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">

    <div class="container">

        <a
        class="navbar-brand fw-bold"
        href="katalog.php">

            <i class="fas fa-book-open"></i>

            Perpustakaan Digital

        </a>

        <div class="ms-auto d-flex gap-2">

            <a
            href="katalog.php"
            class="btn btn-light btn-sm btn-back">

                <i class="fas fa-arrow-left"></i>

                Kembali

            </a>

        </div>

    </div>

</nav>

<!-- CONTENT -->

<div class="container py-5">

    <!-- TITLE -->

    <div class="mb-4">

        <h2 class="page-title">

            Riwayat Peminjaman

        </h2>

        <div class="page-subtitle">

            Daftar buku yang pernah kamu pinjam 📚

        </div>

    </div>

    <!-- CARD -->

    <div class="card card-riwayat">

        <div class="card-body table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>

                        <th width="60">No</th>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                <?php

                $no = 1;

                if(mysqli_num_rows($query) > 0){

                    while($data = mysqli_fetch_array($query)){

                ?>

                    <tr>

                        <td>

                            <?= $no++; ?>

                        </td>

                        <td>

                            <div class="d-flex align-items-center">

                                <?php if(!empty($data['foto'])){ ?>

                                    <img
                                    src="uploads/<?= e($data['foto']); ?>"
                                    class="book-cover">

                                <?php } else { ?>

                                    <div class="empty-cover">

                                        <i class="fas fa-book"></i>

                                    </div>

                                <?php } ?>

                                <div>

                                    <div class="fw-bold">

                                        <?= e($data['judul']); ?>

                                    </div>

                                    <small class="text-muted">

                                        <?= e($data['penulis']); ?>

                                    </small>

                                </div>

                            </div>

                        </td>

                        <td>

                            <?= e($data['tanggal_pinjam']); ?>

                        </td>

                        <td>

                            <?= e($data['tanggal_kembali']); ?>

                        </td>

                        <td>

                            <?php if($data['status'] == 'dipinjam'){ ?>

                                <span class="badge-dipinjam">

                                    Dipinjam

                                </span>

                            <?php } else { ?>

                                <span class="badge-kembali">

                                    Dikembalikan

                                </span>

                            <?php } ?>

                        </td>

                    </tr>

                <?php

                    }

                } else {

                ?>

                    <tr>

                        <td colspan="5">

                            <div class="empty-box">

                                <i class="fas fa-book"></i>

                                <h5>

                                    Belum ada riwayat peminjaman

                                </h5>

                                <p>

                                    Silakan pinjam buku terlebih dahulu

                                </p>

                                <a
                                href="katalog.php"
                                class="btn btn-primary">

                                    Lihat Katalog

                                </a>

                            </div>

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- DARK MODE BUTTON -->

<button
class="theme-btn"
id="toggleTheme">

    <i class="fas fa-moon"></i>

</button>

<!-- DARK MODE SCRIPT -->

<script>

const toggleTheme =
document.getElementById('toggleTheme');

/* LOAD THEME */

if(localStorage.getItem('theme') === 'dark'){

    document.body.classList.add('dark-mode');

    toggleTheme.innerHTML =
    '<i class="fas fa-sun"></i>';

}

/* TOGGLE THEME */

toggleTheme.addEventListener('click', () => {

    document.body.classList.toggle('dark-mode');

    if(document.body.classList.contains('dark-mode')){

        localStorage.setItem('theme', 'dark');

        toggleTheme.innerHTML =
        '<i class="fas fa-sun"></i>';

    } else {

        localStorage.setItem('theme', 'light');

        toggleTheme.innerHTML =
        '<i class="fas fa-moon"></i>';

    }

});

</script>

<script src="plugins/jquery/jquery.min.js"></script>

<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="js/adminlte.min.js"></script>

</body>
</html>