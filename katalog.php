<?php
session_start();
require_once 'koneksi.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

if ($_SESSION['user']['role'] == 'admin') {
    header('Location: index.php');
    exit;
}

function e($value): string
{
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

$id = $_SESSION['user']['id_user'];

$q = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id'");
$user = mysqli_fetch_assoc($q);

$username = $user['username'] ?? 'Peminjam';

$data = mysqli_query($koneksi, "

    SELECT
        buku.*,
        kategori.kategori

    FROM buku

    LEFT JOIN kategori
    ON kategori.id_kategori = buku.id_kategori

    ORDER BY buku.id_buku DESC

");

$initial = strtoupper(
    substr(
        preg_replace('/[^a-zA-Z0-9]/', '', $username) ?: 'P',
        0,
        1
    )
);
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Pinjam Buku</title>

    <link rel="stylesheet"
          href="css/adminlte.min.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>

        :root{
            --bg:#f4f7fb;
            --card:rgba(255,255,255,.80);
            --border:rgba(255,255,255,.50);
            --text:#0f172a;
            --muted:#64748b;
            --sidebar:#111827;
        }

        body.dark-mode{
            --bg:#0f172a;
            --card:rgba(30,41,59,.92);
            --border:rgba(255,255,255,.08);
            --text:#f8fafc;
            --muted:#cbd5e1;
            --sidebar:#020617;
        }

        body{
            background:
                linear-gradient(
                    180deg,
                    #f8fbff 0%,
                    var(--bg) 100%
                );

            color:var(--text);
        }

        body.dark-mode{
            background:
                linear-gradient(
                    180deg,
                    #020617 0%,
                    #0f172a 100%
                );
        }

        .main-header.navbar,
        .main-footer{
            background:rgba(255,255,255,.85)!important;
            backdrop-filter:blur(14px);
            border-bottom:1px solid #e2e8f0;
        }

        body.dark-mode .main-header.navbar,
        body.dark-mode .main-footer{
            background:#1e293b!important;
            border-color:#334155;
        }

        .main-sidebar{
            background:
                linear-gradient(
                    180deg,
                    #111827 0%,
                    #1e293b 100%
                );
        }

        body.dark-mode .main-sidebar{
            background:
                linear-gradient(
                    180deg,
                    #020617 0%,
                    #0f172a 100%
                );
        }

        .brand-link{
            border-bottom:1px solid rgba(255,255,255,.08)!important;
        }

        .brand-text{
            color:#fff!important;
            font-weight:700;
        }

        .user-panel{
            border-bottom:1px solid rgba(255,255,255,.08);
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
        }

        .content-wrapper{
            background:transparent;
        }

        .content-header h1{
            font-size:1.8rem;
            font-weight:800;
            color:var(--text);
        }

        .page-note{
            color:var(--muted);
        }

        .search-box{
            height:50px;
            border:none;
            border-radius:16px;
            box-shadow:0 8px 20px rgba(0,0,0,.05);
        }

        body.dark-mode .search-box{
            background:#1e293b;
            color:#fff;
        }

        .book-card{
            height:100%;
            border-radius:22px;
            overflow:hidden;

            background:var(--card);

            border:1px solid var(--border);

            backdrop-filter:blur(14px);

            box-shadow:
                0 15px 35px rgba(0,0,0,.08);

            transition:.25s;
        }

        .book-card:hover{
            transform:translateY(-5px);
        }

        .book-cover{
            width:100%;
            height:280px;
            object-fit:cover;
        }

        .empty-cover{
            height:280px;

            display:flex;
            align-items:center;
            justify-content:center;

            background:#e2e8f0;

            font-size:60px;
            color:#64748b;
        }

        body.dark-mode .empty-cover{
            background:#334155;
            color:#cbd5e1;
        }

        .badge-custom{
            background:rgba(59,130,246,.12);
            color:#2563eb;

            padding:.45rem .9rem;

            border-radius:999px;

            font-size:.75rem;
            font-weight:600;
        }

        .btn-detail{
            border-radius:12px;
        }

        .nav-sidebar .nav-link{
            border-radius:12px;
            margin:.15rem .6rem;
            color:#fff!important;
        }

        .nav-sidebar .nav-link:hover{
            background:rgba(255,255,255,.08);
        }

        .nav-sidebar .nav-link.active{
            background:
                linear-gradient(
                    135deg,
                    rgba(59,130,246,.25),
                    rgba(34,197,94,.20)
                );
        }

        .theme-btn{
            border:none;
            background:#f1f5f9;
            width:42px;
            height:42px;
            border-radius:12px;
        }

        body.dark-mode .theme-btn{
            background:#334155;
            color:#fff;
        }

        body.dark-mode h5,
        body.dark-mode p,
        body.dark-mode .text-dark,
        body.dark-mode .card-body{
            color:#f8fafc!important;
        }

        body.dark-mode .text-muted{
            color:#cbd5e1!important;
        }

    </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

    <!-- NAVBAR -->

    <nav class="main-header navbar navbar-expand navbar-light">

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

                    <?php echo e($username); ?>

                </span>

            </li>

           

        </ul>

    </nav>

    <!-- SIDEBAR -->

    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <a href="katalog.php"
           class="brand-link text-center">

            <span class="brand-text">
                Perpus Digital
            </span>

        </a>

        <div class="sidebar">

            <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">

               <?php if (!empty($user['foto'])) { ?>
                    <img src="uploads/<?php echo e($user['foto']); ?>?v=<?php echo time(); ?>" 
                        style="width:45px;height:45px;border-radius:14px;object-fit:cover;">
                <?php } else { ?>
                    <div class="user-avatar">
                        <?php echo e($initial); ?>
                    </div>
                <?php } ?>

                <div class="info">

                    <a href="#"
                       class="d-block text-white font-weight-bold">

                        <?php echo e($username); ?>

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
                           class="nav-link active">

                            <i class="nav-icon fas fa-book-open"></i>

                            <p>Home</p>

                        </a>

                    </li>

                    <li class="nav-item">

                        <a href="buku_saya.php"
                           class="nav-link">

                            <i class="nav-icon fas fa-book"></i>

                            <p>Buku Saya</p>

                        </a>

                    </li>

                   
                    <li class="nav-item">

                        <a href="pengaturan.php"
                        class="nav-link">

                            <i class="nav-icon fas fa-user-cog"></i>

                            <p>
                                Pengaturan
                            </p>

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

                <div class="row mb-3 align-items-end">

                    <div class="col-md-6">

                        <h1>Daftar Buku</h1>

                        <div class="page-note">
                            Temukan buku favoritmu 📚
                        </div>

                    </div>

                    <div class="col-md-6">

                        <input
                            type="text"
                            id="searchInput"
                            class="form-control search-box"
                            placeholder="Cari buku...">

                    </div>

                </div>

            </div>

        </div>

        <div class="content pb-4">

            <div class="container-fluid">

                <div class="row"
                     id="bookContainer">

                    <?php while($d = mysqli_fetch_assoc($data)) { ?>

                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4 book-item">

                        <div class="book-card">

                            <?php if(!empty($d['foto'])) { ?>

                                <img
                                    src="uploads/<?php echo e($d['foto']); ?>"
                                    class="book-cover">

                            <?php } else { ?>

                                <div class="empty-cover">

                                    <i class="fas fa-book"></i>

                                </div>

                            <?php } ?>

                            <div class="card-body d-flex flex-column">

                                <div class="mb-2">

                                    <span class="badge-custom">

                                        <?php echo e($d['kategori'] ?? 'Tidak Ada Kategori'); ?>

                                    </span>

                                </div>

                                <h5 class="font-weight-bold">

                                    <?php echo e($d['judul']); ?>

                                </h5>

                                <p class="text-muted mb-3">

                                    <?php echo e($d['penulis']); ?>

                                </p>

                                <div class="mt-auto">

                                    <a href="detail_buku.php?id=<?php echo e($d['id_buku']); ?>"
                                       class="btn btn-primary btn-block btn-detail mb-2">

                                        <i class="fas fa-eye mr-1"></i>
                                        Detail Buku

                                    </a>

                                    <a href="pinjam.php?id=<?php echo e($d['id_buku']); ?>"
                                       class="btn btn-success btn-block btn-detail mb-2"
                                       onclick="return confirm('Yakin ingin meminjam buku ini?')">

                                        <i class="fas fa-book-reader mr-1"></i>
                                        Pinjam Buku

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                    <?php } ?>

                </div>

            </div>

        </div>

    </div>

    <!-- FOOTER -->

    <footer class="main-footer">

        <strong>Perpustakaan Digital</strong>

        <div class="float-right d-none d-sm-inline-block">

            <span class="text-muted">
                Halaman peminjam
            </span>

        </div>

    </footer>

</div>

<script>

const searchInput =
document.getElementById('searchInput');

searchInput.addEventListener('keyup', function(){

    let filter =
    this.value.toLowerCase();

    let items =
    document.querySelectorAll('.book-item');

    items.forEach(item => {

        let text =
        item.innerText.toLowerCase();

        item.style.display =
        text.includes(filter)
        ? ''
        : 'none';

    });

});

/* DARK MODE */

const toggleTheme =
document.getElementById('toggleTheme');

if(localStorage.getItem('theme') === 'dark'){

    document.body.classList.add('dark-mode');

    toggleTheme.innerHTML =
    '<i class="fas fa-sun"></i>';

}

toggleTheme.addEventListener('click', () => {

    document.body.classList.toggle('dark-mode');

    if(document.body.classList.contains('dark-mode')){

        localStorage.setItem('theme', 'dark');

        toggleTheme.innerHTML =
        '<i class="fas fa-sun"></i>';

    }else{

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