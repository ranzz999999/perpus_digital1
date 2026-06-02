<?php
session_start();
require_once 'koneksi.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

if ($_SESSION['user']['role'] != 'admin') {
    header('location:katalog.php');
    exit;
}

/* =========================
   FUNCTION
========================= */

function e($value): string
{
    return htmlspecialchars(
        (string)$value,
        ENT_QUOTES,
        'UTF-8'
    );
}

/* =========================
   USER LOGIN
========================= */

$user      = $_SESSION['user'];

$level     = $user['level']
             ?? ($user['role'] ?? 'user');

$username  = $user['username']
             ?? 'Pengguna';

$initial = strtoupper(
    substr(
        preg_replace(
            '/[^a-zA-Z0-9]/',
            '',
            $username
        ) ?: 'U',
        0,
        1
    )
);

$sidebarUserName = $username !== ''
    ? $username
    : 'Admin';

$sidebarRole = $level !== ''
    ? $level
    : 'user';

/* =========================
   PAGE
========================= */

$allowedPages = [

    'home',

    'kategori',
    'kategori_tambah',
    'kategori_ubah',
    'kategori_hapus',

    'buku',
    'buku_tambah',
    'buku_ubah',
    'buku_hapus',

    'peminjaman',
    'peminjaman_tambah',

    'ulasan',

    '404'
];

$page = $_GET['page'] ?? 'home';

if (!in_array($page, $allowedPages, true)) {
    $page = '404';
}

/* =========================
   TITLE
========================= */

$pageTitles = [

    'home'               => 'Dashboard',
    'kategori'           => 'Kategori Buku',
    'kategori_tambah'    => 'Tambah Kategori',
    'kategori_ubah'      => 'Ubah Kategori',

    'buku'               => 'Data Buku',
    'buku_tambah'        => 'Tambah Buku',
    'buku_ubah'          => 'Ubah Buku',

    'peminjaman'         => 'Data Peminjaman',
    'peminjaman_tambah'  => 'Tambah Peminjaman',

    'ulasan'             => 'Ulasan Buku'
];

$title = $pageTitles[$page]
         ?? 'Perpustakaan Digital';
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>

        <?php echo e($title); ?>

        - Perpustakaan Digital

    </title>

    <!-- CSS -->

    <link rel="stylesheet"
          href="css/adminlte.min.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- STYLE -->

    <style>

        /* =========================
           ROOT
        ========================= */

        :root{

            --app-bg:#f4f7fb;

            --panel:
            rgba(255,255,255,.76);

            --panel-border:
            rgba(255,255,255,.55);

            --shadow-soft:
            0 14px 40px rgba(15,23,42,.08);

            --shadow-hover:
            0 20px 50px rgba(15,23,42,.12);

            --text-main:#0f172a;

            --text-muted:#64748b;
        }

        /* =========================
           DARK MODE
        ========================= */

        body.dark-mode{

            --app-bg:#0f172a;

            --panel:
            rgba(15,23,42,.92);

            --panel-border:
            rgba(255,255,255,.08);

            --shadow-soft:
            0 14px 40px rgba(0,0,0,.35);

            --shadow-hover:
            0 20px 50px rgba(0,0,0,.45);

            --text-main:#f8fafc;

            --text-muted:#cbd5e1;

            background:
            linear-gradient(
                180deg,
                #0f172a 0%,
                #111827 100%
            ) !important;

            color:#fff;
        }

        /* =========================
           BODY
        ========================= */

        body{

            background:
                radial-gradient(
                    circle at top left,
                    rgba(0,123,255,.08),
                    transparent 30%
                ),

                radial-gradient(
                    circle at top right,
                    rgba(40,167,69,.07),
                    transparent 24%
                ),

                linear-gradient(
                    180deg,
                    #f8fbff 0%,
                    var(--app-bg) 100%
                );

            transition:.3s;
        }

        /* =========================
           NAVBAR
        ========================= */

        .main-header.navbar,
        .main-footer{

            backdrop-filter:blur(14px);

            background:
            rgba(255,255,255,.82)!important;

            border-bottom:
            1px solid rgba(148,163,184,.18);

            box-shadow:
            0 4px 30px rgba(15,23,42,.04);
        }

        body.dark-mode
        .main-header.navbar,

        body.dark-mode
        .main-footer{

            background:
            rgba(17,24,39,.95)!important;

            color:#fff;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .main-sidebar{

            background:
            linear-gradient(
                180deg,
                #111827 0%,
                #1f2937 45%,
                #0f172a 100%
            );

            box-shadow:
            18px 0 40px rgba(15,23,42,.12);
        }

        .brand-link{

            border-bottom:
            1px solid rgba(255,255,255,.08)!important;
        }

        .brand-text,
        .sidebar-dark-primary
        .nav-sidebar
        > .nav-item
        > .nav-link{

            color:
            rgba(255,255,255,.88)!important;
        }

        /* =========================
           USER
        ========================= */

        .user-panel{

            border-bottom:
            1px solid rgba(255,255,255,.08);
        }

        .user-avatar{

            width:42px;
            height:42px;

            border-radius:14px;

            display:grid;
            place-items:center;

            background:
            linear-gradient(
                135deg,
                #3b82f6,
                #22c55e
            );

            color:#fff;

            font-weight:700;
        }

        /* =========================
           CONTENT
        ========================= */

        .content-wrapper{

            background:transparent;
        }

        .content-header{

            padding:
            1.2rem .75rem .25rem;
        }

        .content-header h1{

            font-size:1.7rem;

            font-weight:800;

            color:var(--text-main);
        }

        .page-note{

            color:var(--text-muted);

            font-size:.95rem;
        }

        /* =========================
           CARD
        ========================= */

        .card,
        .small-box{

            border:
            1px solid var(--panel-border);

            box-shadow:
            var(--shadow-soft);

            border-radius:1.25rem;

            overflow:hidden;

            background:var(--panel);

            transition:.25s;
        }

        .card:hover,
        .small-box:hover{

            transform:
            translateY(-4px);

            box-shadow:
            var(--shadow-hover);
        }

        .card-header{

            background:
            rgba(255,255,255,.55);

            border-bottom:
            1px solid rgba(148,163,184,.12);
        }

        body.dark-mode
        .card-header{

            background:
            rgba(30,41,59,.9);
        }

        /* =========================
           TABLE
        ========================= */

        .table{

            background:
            rgba(255,255,255,.55);

            border-radius:1rem;

            overflow:hidden;
        }

        body.dark-mode
        .table{

            color:#fff;

            background:
            rgba(15,23,42,.85);
        }

        body.dark-mode
        .table thead th{

            background:
            rgba(255,255,255,.08);

            color:#fff;
        }

        .table td,
        .table th{

            vertical-align:middle;
        }

        /* =========================
           BUTTON
        ========================= */

        .btn{

            border-radius:.85rem;
        }

        /* =========================
           SIDEBAR MENU
        ========================= */

        .nav-sidebar .nav-link{

            border-radius:.85rem;

            margin:.15rem .65rem;

            padding:.72rem .9rem;

            transition:.2s;
        }

        .nav-sidebar .nav-link:hover{

            background:
            rgba(255,255,255,.08);
        }

        .nav-sidebar
        > .nav-item
        > .nav-link.active{

            background:
            linear-gradient(
                135deg,
                rgba(59,130,246,.22),
                rgba(34,197,94,.16)
            );

            color:#fff!important;
        }

        /* =========================
           TOGGLE BUTTON
        ========================= */

        .theme-toggle{

            border:none;

            background:
            linear-gradient(
                135deg,
                #2563eb,
                #1d4ed8
            );

            color:#fff;

            width:42px;
            height:42px;

            border-radius:12px;

            cursor:pointer;

            transition:.3s;
        }

        .theme-toggle:hover{

            transform:scale(1.05);
        }

    </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed accent-primary">

<div class="wrapper">

    <!-- NAVBAR -->

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

        <ul class="navbar-nav">

            <li class="nav-item">

                <a class="nav-link"
                   data-widget="pushmenu"
                   href="#">

                    <i class="fas fa-bars"></i>

                </a>

            </li>

            <li class="nav-item d-none d-sm-inline-block">

                <span class="nav-link text-dark font-weight-bold">

                    Perpustakaan Digital

                </span>

            </li>

        </ul>

        <ul class="navbar-nav ml-auto align-items-center">

            <!-- DARK MODE -->

            <li class="nav-item mr-2">

                <button
                    id="toggleTheme"
                    class="theme-toggle">

                    <i class="fas fa-moon"></i>

                </button>

            </li>

            <!-- USER -->

            <li class="nav-item d-none d-sm-inline-block">

                <span class="nav-link text-muted">

                    <i class="far fa-user mr-1"></i>

                    <?php echo e($sidebarUserName); ?>

                </span>

            </li>

            <!-- LOGOUT -->

            <li class="nav-item d-none d-sm-inline-block">

                <a href="logout.php"
                   class="nav-link text-danger">

                    <i class="fas fa-right-from-bracket mr-1"></i>

                    Logout

                </a>

            </li>

        </ul>

    </nav>

    <!-- SIDEBAR -->

    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <a href="index.php"
           class="brand-link">

            <span class="brand-text font-weight-bold">

                Perpus Digital

            </span>

        </a>

        <div class="sidebar">

            <!-- USER PANEL -->

            <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">

                <div class="image">

                    <div class="user-avatar">

                        <?php echo e($initial); ?>

                    </div>

                </div>

                <div class="info">

                    <a href="#"
                       class="d-block font-weight-bold">

                        <?php echo e($sidebarUserName); ?>

                    </a>

                    <small class="text-light">

                        <?php echo e($sidebarRole); ?>

                    </small>

                </div>

            </div>

            <!-- MENU -->

            <nav class="mt-2">

                <ul class="nav nav-pills nav-sidebar flex-column">

                    <li class="nav-item">

                        <a href="index.php?page=home"
                           class="nav-link <?php echo $page === 'home' ? 'active' : ''; ?>">

                            <i class="nav-icon fas fa-chart-pie"></i>

                            <p>Dashboard</p>

                        </a>

                    </li>

                    <li class="nav-item">

                        <a href="index.php?page=kategori"
                           class="nav-link <?php echo substr($page,0,8)==='kategori' ? 'active' : ''; ?>">

                            <i class="nav-icon fas fa-tags"></i>

                            <p>Kategori</p>

                        </a>

                    </li>

                    <li class="nav-item">

                        <a href="index.php?page=buku"
                           class="nav-link <?php echo substr($page,0,4)==='buku' ? 'active' : ''; ?>">

                            <i class="nav-icon fas fa-book-open"></i>

                            <p>Buku</p>

                        </a>

                    </li>

                    <li class="nav-item">

                        <a href="index.php?page=peminjaman"
                           class="nav-link <?php echo $page==='peminjaman' ? 'active' : ''; ?>">

                            <i class="nav-icon fas fa-book"></i>

                            <p>Peminjaman</p>

                        </a>

                    </li>

                    <li class="nav-item">

                        <a href="index.php?page=ulasan"
                           class="nav-link <?php echo $page==='ulasan' ? 'active' : ''; ?>">

                            <i class="nav-icon fas fa-star"></i>

                            <p>Ulasan</p>

                        </a>

                    </li>

                    <li class="nav-item mt-2">

                        <a href="logout.php"
                           class="nav-link text-danger">

                            <i class="nav-icon fas fa-arrow-right-from-bracket"></i>

                            <p>Keluar</p>

                        </a>

                    </li>

                </ul>

            </nav>

        </div>

    </aside>

    <!-- CONTENT -->

    <div class="content-wrapper">

        <div class="content-header">

            <div class="container-fluid">

                <div class="row mb-2 align-items-end">

                    <div class="col-sm-6">

                        <h1>

                            <?php echo e($title); ?>

                        </h1>

                        <div class="page-note">

                            ✨

                        </div>

                    </div>

                    <div class="col-sm-6">

                        <ol class="breadcrumb float-sm-right">

                            <li class="breadcrumb-item">

                                <a href="index.php">

                                    Home

                                </a>

                            </li>

                            <li class="breadcrumb-item active">

                                <?php echo e($title); ?>

                            </li>

                        </ol>

                    </div>

                </div>

            </div>

        </div>

        <!-- PAGE -->

        <div class="content pb-4">

            <div class="container-fluid">

                <?php include $page . '.php'; ?>

            </div>

        </div>

    </div>

    <!-- FOOTER -->

    <footer class="main-footer">

        <strong>

            Perpustakaan Digital

        </strong>

        <div class="float-right d-none d-sm-inline-block">

            <span class="text-muted">

                Admin Panel

            </span>

        </div>

    </footer>

</div>

<!-- SCRIPT -->

<script>

const toggleTheme =
document.getElementById('toggleTheme');

if(localStorage.getItem('theme') === 'dark'){

    document.body.classList.add('dark-mode');

    toggleTheme.innerHTML =
    '<i class="fas fa-sun"></i>';
}

toggleTheme.addEventListener('click', function(){

    document.body.classList.toggle('dark-mode');

    if(document.body.classList.contains('dark-mode')){

        localStorage.setItem('theme', 'dark');

        this.innerHTML =
        '<i class="fas fa-sun"></i>';

    }else{

        localStorage.setItem('theme', 'light');

        this.innerHTML =
        '<i class="fas fa-moon"></i>';
    }

});

</script>

<script src="plugins/jquery/jquery.min.js"></script>

<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="js/adminlte.min.js"></script>

</body>
</html>