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
   AMBIL ID BUKU
========================= */

$id = isset($_GET['id'])
    ? (int) $_GET['id']
    : 0;

/* =========================
   QUERY DETAIL BUKU
========================= */

$query = mysqli_query(

    $koneksi,

    "SELECT 
        buku.*,
        kategori.kategori

     FROM buku

     LEFT JOIN kategori
     ON kategori.id_kategori = buku.id_kategori

     WHERE buku.id_buku = '$id'

     LIMIT 1"

);

$data = mysqli_fetch_assoc($query);

/* =========================
   JIKA BUKU TIDAK ADA
========================= */

if (!$data) {

    echo "

    <script>

        alert('Buku tidak ditemukan');

        window.location='katalog.php';

    </script>

    ";

    exit;
}

/* =========================
   USER LOGIN
========================= */

$user = $_SESSION['user'];

$username =
$user['username'] ?? 'Peminjam';

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

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Detail Buku
    </title>

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
                #eef4ff 100%
            );

            min-height:100vh;
        }

        .navbar-custom{

            background:
            linear-gradient(
                135deg,
                #0f172a,
                #1d4ed8
            );
        }

        .detail-card{

            border:none;

            border-radius:24px;

            overflow:hidden;

            background:#fff;

            box-shadow:
            0 18px 40px rgba(0,0,0,.08);
        }

        .book-cover{

            width:100%;
            height:100%;

            min-height:500px;

            object-fit:cover;
        }

        .empty-cover{

            height:500px;

            display:flex;
            align-items:center;
            justify-content:center;

            background:#e2e8f0;

            color:#64748b;

            font-size:90px;
        }

        .badge-kategori{

            background:#dbeafe;

            color:#2563eb;

            padding:.6rem 1rem;

            border-radius:999px;

            font-size:.85rem;

            font-weight:700;
        }

        .book-title{

            font-size:35px;

            font-weight:800;

            color:#0f172a;
        }

        .book-info{

            color:#64748b;

            font-size:16px;

            line-height:1.9;
        }

        .book-desc{

            line-height:1.9;

            color:#334155;
        }

        .btn-custom{

            border-radius:14px;

            padding:12px 20px;

            font-weight:600;
        }

        .info-box{

            background:#f8fafc;

            border-radius:18px;

            padding:20px;

            border:1px solid #e2e8f0;
        }

   /* =========================
   DARK MODE
========================= */

body.dark-mode{

    background:
    linear-gradient(
        180deg,
        #020617 0%,
        #0f172a 100%
    ) !important;

    color:#f8fafc;
}

body.dark-mode .detail-card{

    background:#1e293b !important;

    border:1px solid #334155;
}

body.dark-mode .navbar-custom{

    background:
    linear-gradient(
        135deg,
        #020617,
        #1e293b
    );
}

body.dark-mode .book-title,
body.dark-mode .book-info,
body.dark-mode .book-desc,
body.dark-mode h1,
body.dark-mode h2,
body.dark-mode h3,
body.dark-mode h4,
body.dark-mode h5,
body.dark-mode p,
body.dark-mode span{

    color:#f8fafc !important;
}

body.dark-mode .info-box{

    background:#0f172a;

    border-color:#334155;
}

body.dark-mode .empty-cover{

    background:#334155;

    color:#cbd5e1;
}

body.dark-mode .badge-kategori{

    background:#1d4ed8;

    color:#fff;
}

    </style>

</head>

<body>

<!-- NAVBAR -->

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">

    <div class="container">

        <a class="navbar-brand fw-bold"
           href="katalog.php">

            <i class="fas fa-book-open"></i>

            Perpustakaan Digital

        </a>

        <div class="ms-auto d-flex gap-2">

            <a href="katalog.php"
               class="btn btn-light btn-sm">

                <i class="fas fa-arrow-left"></i>

                Kembali

            </a>

            <a href="logout.php"
               class="btn btn-danger btn-sm">

                <i class="fas fa-right-from-bracket"></i>

                Logout

            </a>

        </div>

    </div>

</nav>

<!-- CONTENT -->

<div class="container py-5">

    <div class="card detail-card">

        <div class="row g-0">

            <!-- FOTO -->

            <div class="col-lg-4">

                <?php if(!empty($data['foto'])){ ?>

                    <img
                        src="uploads/<?= e($data['foto']); ?>"
                        class="book-cover">

                <?php } else { ?>

                    <div class="empty-cover">

                        <i class="fas fa-book"></i>

                    </div>

                <?php } ?>

            </div>

            <!-- DETAIL -->

            <div class="col-lg-8">

                <div class="card-body p-5">

                    <!-- KATEGORI -->

                    <div class="mb-3">

                        <span class="badge-kategori">

                            <?= e($data['kategori'] ?? 'Tidak Ada Kategori'); ?>

                        </span>

                    </div>

                    <!-- JUDUL -->

                    <h1 class="book-title mb-3">

                        <?= e($data['judul']); ?>

                    </h1>

                    <!-- INFO -->

                    <div class="book-info mb-4">

                        <div>

                            <i class="fas fa-user-edit me-2"></i>

                            Penulis :
                            <b><?= e($data['penulis']); ?></b>

                        </div>

                        <div>

                            <i class="fas fa-layer-group me-2"></i>

                            Kategori :
                            <b><?= e($data['kategori'] ?? 'Tidak Ada Kategori'); ?></b>

                        </div>

                    </div>

                    <!-- DESKRIPSI -->

                    <div class="info-box mb-4">

                        <h5 class="fw-bold mb-3">

                            Deskripsi Buku :

                        </h5>

                        <div class="book-desc">

                            <?= !empty($data['deskripsi'])
                                ? nl2br(e($data['deskripsi']))
                                : 'Belum ada deskripsi buku.'; ?>

                        </div>

                    </div>

                    <!-- BUTTON -->

                    <div class="row">

                        <!-- PINJAM -->

                        <div class="col-md-4 mb-3">

                            <a
                                href="pinjam.php?id=<?= $data['id_buku']; ?>"
                                class="btn btn-success w-100 btn-custom"
                                onclick="return confirm('Yakin ingin meminjam buku ini?')">

                                <i class="fas fa-book-reader me-1"></i>

                                Pinjam Buku

                            </a>

                        </div>

                        <!-- BACA -->

                        <?php if(!empty($data['link_buku'])){ ?>

                        <div class="col-md-4 mb-3">

                            <a
                                href="<?= e($data['link_buku']); ?>"
                                target="_blank"
                                class="btn btn-primary w-100 btn-custom">

                                <i class="fas fa-book-open me-1"></i>

                                Baca Buku

                            </a>

                        </div>

                        <?php } ?>

                        <!-- ULASAN -->

                        <div class="col-md-4 mb-3">

                            <a
                                href="ulasan.php?id=<?= $data['id_buku']; ?>"
                                class="btn btn-warning w-100 btn-custom">

                                <i class="fas fa-star me-1"></i>

                                Ulasan

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
<script>

const toggleTheme =
document.getElementById('toggleTheme');

/* LOAD */

if(localStorage.getItem('theme') === 'dark'){

    document.body.classList.add('dark-mode');

    toggleTheme.innerHTML =
    '<i class="fas fa-sun"></i>';

}

/* TOGGLE */

toggleTheme.addEventListener('click', () => {

    document.body.classList.toggle('dark-mode');

    if(document.body.classList.contains('dark-mode')){

        localStorage.setItem('theme','dark');

        toggleTheme.innerHTML =
        '<i class="fas fa-sun"></i>';

    } else {

        localStorage.setItem('theme','light');

        toggleTheme.innerHTML =
        '<i class="fas fa-moon"></i>';

    }

});

</script>
</html>