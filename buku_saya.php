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

$initial = strtoupper(substr(
    preg_replace('/[^a-zA-Z0-9]/', '', $username) ?: 'P',
    0,
    1
));

/* =========================
   QUERY BUKU DIPINJAM
========================= */

$query = mysqli_query($koneksi, "

    SELECT
        peminjaman.*,
        buku.id_buku,
        buku.judul,
        buku.penulis,
        buku.foto,
        buku.link_buku

    FROM peminjaman

    LEFT JOIN buku
    ON buku.id_buku = peminjaman.id_buku

    WHERE peminjaman.id_user = '$id_user'
    AND peminjaman.status = 'dipinjam'

    ORDER BY peminjaman.id_peminjaman DESC

");

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Buku Saya</title>

<link rel="stylesheet"
href="css/adminlte.min.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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

    --sidebar1:#0f172a;
    --sidebar2:#1e293b;

    --shadow:
    0 10px 30px rgba(0,0,0,.08);
}

/* =========================
   DARK MODE
========================= */

body.dark-mode{

    --bg:#020617;
    --bg2:#0f172a;

    --card:#1e293b;

    --text:#f8fafc;
    --muted:#cbd5e1;

    --border:#334155;

    --sidebar1:#020617;
    --sidebar2:#111827;
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
}

/* =========================
   NAVBAR
========================= */

.main-header.navbar{

    background:
    rgba(255,255,255,.85)!important;

    backdrop-filter:blur(12px);

    border-bottom:
    1px solid var(--border);
}

body.dark-mode
.main-header.navbar{

    background:#1e293b!important;
}

/* =========================
   SIDEBAR
========================= */

.main-sidebar{

    background:
    linear-gradient(
        180deg,
        var(--sidebar1),
        var(--sidebar2)
    );
}

.brand-link{

    border-bottom:
    1px solid rgba(255,255,255,.08)!important;
}

.brand-text{

    color:#fff!important;
    font-weight:700;
}

.user-panel{

    border-bottom:
    1px solid rgba(255,255,255,.08);
}

.user-avatar{

    width:45px;
    height:45px;

    border-radius:14px;

    display:flex;
    align-items:center;
    justify-content:center;

    background:
    linear-gradient(
        135deg,
        #3b82f6,
        #22c55e
    );

    color:#fff;

    font-weight:bold;
    font-size:18px;
}

/* =========================
   MENU
========================= */

.nav-sidebar .nav-link{

    border-radius:12px;

    margin:4px 10px;

    color:#fff!important;
}

.nav-sidebar .nav-link:hover{

    background:
    rgba(255,255,255,.08);
}

.nav-sidebar .nav-link.active{

    background:
    linear-gradient(
        135deg,
        rgba(59,130,246,.25),
        rgba(34,197,94,.2)
    );
}

/* =========================
   CONTENT
========================= */

.content-wrapper{
    background:transparent;
}

.page-title{

    font-size:30px;
    font-weight:800;

    color:var(--text);
}

.page-subtitle{

    color:var(--muted);

    margin-top:5px;
}

/* =========================
   CARD
========================= */

.main-card{

    background:var(--card);

    border-radius:24px;

    box-shadow:var(--shadow);

    border:
    1px solid var(--border);

    overflow:hidden;
}

.card-header-custom{

    padding:22px 25px;

    border-bottom:
    1px solid var(--border);
}

.card-header-custom h4{

    margin:0;

    font-weight:700;
}

/* =========================
   TABLE
========================= */

.table{

    margin:0;

    color:var(--text);
}

.table thead th{

    border-top:none;

    border-bottom:
    1px solid var(--border);

    background:
    rgba(15,23,42,.03);

    font-weight:700;

    color:var(--text);

    padding:16px 14px;
}

.table td{

    border-color:var(--border);

    vertical-align:middle;

    padding:18px 14px;
}

body.dark-mode
.table thead th{

    background:#0f172a;
}

.table tbody tr:hover{

    background:
    rgba(59,130,246,.03);
}

/* =========================
   COVER
========================= */

.book-cover{

    width:72px;
    height:92px;

    object-fit:cover;

    border-radius:14px;

    box-shadow:
    0 5px 15px rgba(0,0,0,.08);
}

.empty-cover{

    width:72px;
    height:92px;

    border-radius:14px;

    display:flex;
    align-items:center;
    justify-content:center;

    background:#e2e8f0;

    color:#64748b;

    font-size:26px;
}

body.dark-mode
.empty-cover{

    background:#334155;

    color:#cbd5e1;
}

/* =========================
   BUTTON
========================= */

.btn{

    border-radius:12px;

    font-weight:600;
}

.action-group{

    display:flex;

    flex-wrap:wrap;

    gap:10px;
}

.action-group .btn{

    min-width:120px;
}

/* =========================
   EMPTY
========================= */

.empty-box{

    padding:70px 20px;

    text-align:center;
}

.empty-box i{

    font-size:70px;

    color:#cbd5e1;

    margin-bottom:20px;
}

.empty-box h5{

    font-weight:700;

    margin-bottom:10px;
}

/* =========================
   FOOTER
========================= */

.main-footer{

    background:transparent!important;

    border-top:none;

    color:var(--muted);
}

/* =========================
   THEME BUTTON
========================= */

.theme-btn{

    width:42px;
    height:42px;

    border:none;

    border-radius:12px;

    background:#f1f5f9;

    cursor:pointer;
}

body.dark-mode
.theme-btn{

    background:#334155;

    color:#fff;
}

</style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

<!-- =========================
     NAVBAR
========================= -->

<nav class="main-header navbar navbar-expand">

    <ul class="navbar-nav">

        <li class="nav-item">

            <a class="nav-link"
            data-widget="pushmenu"
            href="#">

                <i class="fas fa-bars"></i>

            </a>

        </li>

        <li class="nav-item d-none d-sm-inline-block">

            <span class="nav-link font-weight-bold">

                Perpustakaan Digital

            </span>

        </li>

    </ul>

    <ul class="navbar-nav ml-auto align-items-center">

        <li class="nav-item mr-2">

            <button
            class="theme-btn"
            id="toggleTheme">

                <i class="fas fa-moon"></i>

            </button>

        </li>

        <li class="nav-item d-none d-sm-inline-block">

            <span class="nav-link text-muted">

                <i class="far fa-user mr-1"></i>

                <?= e($username); ?>

            </span>

        </li>

    </ul>

</nav>

<!-- =========================
     SIDEBAR
========================= -->

<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="katalog.php"
    class="brand-link text-center">

        <span class="brand-text">

            Perpus Digital

        </span>

    </a>

    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">

            <div class="image">

                <div class="user-avatar">

                    <?= e($initial); ?>

                </div>

            </div>

            <div class="info">

                <a href="#"
                class="d-block text-white font-weight-bold">

                    <?= e($username); ?>

                </a>

                <small class="text-light">

                    Peminjam

                </small>

            </div>

        </div>

        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column">

                <li class="nav-item">

                    <a href="katalog.php"
                    class="nav-link">

                        <i class="nav-icon fas fa-book-open"></i>

                        <p>Home</p>

                    </a>

                </li>

                <li class="nav-item">

                    <a href="buku_saya.php"
                    class="nav-link active">

                        <i class="nav-icon fas fa-book"></i>

                        <p>Buku Saya</p>

                    </a>

                </li>

                <li class="nav-item">

                    <a href="pengaturan.php"
                    class="nav-link">

                        <i class="nav-icon fas fa-user-cog"></i>

                        <p>Pengaturan</p>

                    </a>

                </li>

            </ul>

        </nav>

    </div>

</aside>

<!-- =========================
     CONTENT
========================= -->

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <div class="mb-4">

                <div class="page-title">

                    Buku Saya

                </div>

                <div class="page-subtitle">

                    Daftar buku yang sedang dipinjam 📚

                </div>

            </div>

        </div>

    </section>

    <section class="content pb-4">

        <div class="container-fluid">

            <div class="main-card">

                <div class="card-header-custom">

                    <h4>

                        <i class="fas fa-book mr-2 text-primary"></i>

                        Koleksi Buku

                    </h4>

                </div>

                <div class="table-responsive">

                    <table class="table table-hover">

                        <thead>

                            <tr>

                                <th width="60">No</th>

                                <th>Buku</th>

                                <th>Tanggal Pinjam</th>

                                <th>Tanggal Kembali</th>

                                <th width="380">Aksi</th>

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
                                        class="book-cover mr-3">

                                    <?php } else { ?>

                                        <div class="empty-cover mr-3">

                                            <i class="fas fa-book"></i>

                                        </div>

                                    <?php } ?>

                                    <div>

                                        <div class="font-weight-bold mb-1">

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

                                <div class="action-group">

                                    <!-- BUTTON BACA -->

                                    <?php if(!empty($data['link_buku'])){ ?>

                                        <a
                                        href="<?= e($data['link_buku']); ?>"
                                        target="_blank"
                                        class="btn btn-primary btn-sm">

                                            <i class="fas fa-book-open mr-1"></i>

                                            Baca Buku

                                        </a>

                                    <?php } else { ?>

                                        <button
                                        class="btn btn-secondary btn-sm"
                                        disabled>

                                            <i class="fas fa-book-open mr-1"></i>

                                            Tidak Tersedia

                                        </button>

                                    <?php } ?>

                                    <!-- BUTTON DETAIL -->

                                    <a
                                    href="detail_buku.php?id=<?= $data['id_buku']; ?>"
                                    class="btn btn-info btn-sm">

                                        <i class="fas fa-eye mr-1"></i>

                                        Detail

                                    </a>

                                    <!-- BUTTON KEMBALIKAN -->

                                    <a
                                    href="kembalikan.php?id=<?= $data['id_peminjaman']; ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin mengembalikan buku ini?')">

                                        <i class="fas fa-rotate-left mr-1"></i>

                                        Kembalikan

                                    </a>

                                </div>

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

                                        Belum ada buku dipinjam

                                    </h5>

                                    <p class="text-muted mb-4">

                                        Silakan pinjam buku dari katalog

                                    </p>

                                    <a href="katalog.php"
                                    class="btn btn-primary">

                                        Cari Buku

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

    </section>

</div>

<!-- =========================
     FOOTER
========================= -->

<footer class="main-footer">

    <strong>

        Perpustakaan Digital

    </strong>

    <div class="float-right d-none d-sm-inline-block">

        Halaman Peminjam

    </div>

</footer>

</div>

<!-- =========================
     DARK MODE
========================= -->

<script>

const toggleTheme =
document.getElementById('toggleTheme');

/* LOAD THEME */

if(localStorage.getItem('theme') === 'dark'){

    document.body.classList.add('dark-mode');

    toggleTheme.innerHTML =
    '<i class="fas fa-sun"></i>';
}

/* TOGGLE */

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