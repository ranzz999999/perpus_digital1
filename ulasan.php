<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'koneksi.php';

/* =========================
   CEK LOGIN
========================= */

if (!isset($_SESSION['user'])) {

    header("Location: login.php");
    exit;

}

/* =========================
   DATA ULASAN
========================= */

$query = mysqli_query($koneksi, "

    SELECT *
    FROM ulasan

    LEFT JOIN user
    ON user.id_user = ulasan.id_user

    LEFT JOIN buku
    ON buku.id_buku = ulasan.id_buku

    ORDER BY id_ulasan DESC

");

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>Data Ulasan Buku</title>

    <!-- ADMIN LTE -->
    <link rel="stylesheet"
    href="css/adminlte.min.css">

    <!-- FONT AWESOME -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>

        :root{

            --bg:#f4f7fb;
            --bg2:#eef4ff;

            --card:#ffffff;

            --text:#0f172a;
            --muted:#64748b;

            --border:#e2e8f0;

            --shadow:
            0 20px 45px rgba(0,0,0,.08);

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
           CONTENT
        ========================= */

        .content-wrapper{

            background:transparent;

            min-height:100vh;

            padding:35px;

        }

        /* =========================
           PAGE TITLE
        ========================= */

        .page-title{

            font-size:38px;

            font-weight:800;

            margin-bottom:5px;

            color:var(--text);

        }

        .page-subtitle{

            color:var(--muted);

            margin-bottom:30px;

            font-size:15px;

        }

        /* =========================
           CARD
        ========================= */

        .card{

            border:none;

            border-radius:24px;

            overflow:hidden;

            background:var(--card);

            box-shadow:var(--shadow);

        }

        .card-header{

            background:transparent;

            border-bottom:
            1px solid var(--border);

            padding:22px 28px;

        }

        .card-header h4{

            margin:0;

            font-size:28px;

            font-weight:700;

            color:var(--text);

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

            border-top:none;

            border-bottom:
            1px solid var(--border);

            color:var(--muted);

            font-size:14px;

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

        body.dark-mode .table-striped tbody tr:nth-of-type(odd){

            background:
            rgba(255,255,255,.02);

        }

        body.dark-mode .table tbody tr:hover{

            background:
            rgba(255,255,255,.03);

        }

        /* =========================
           ICON
        ========================= */

        .user-icon{

            color:#3b82f6;

            margin-right:8px;

        }

        .book-icon{

            color:#22c55e;

            margin-right:8px;

        }

        /* =========================
           RATING
        ========================= */

        .badge-rating{

            display:inline-flex;

            align-items:center;

            gap:6px;

            background:#facc15;

            color:#000;

            padding:8px 16px;

            border-radius:999px;

            font-weight:700;

            font-size:14px;

        }

        /* =========================
           EMPTY DATA
        ========================= */

        .empty-box{

            padding:60px 20px;

            text-align:center;

        }

        .empty-box i{

            font-size:70px;

            color:#cbd5e1;

            margin-bottom:15px;

        }

        .empty-box h5{

            font-weight:700;

            margin-bottom:10px;

        }

        .empty-box p{

            color:var(--muted);

        }

        /* =========================
           DARK MODE BUTTON
        ========================= */

        .theme-btn{

            position:fixed;

            right:25px;
            bottom:25px;

            width:58px;
            height:58px;

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

            .content-wrapper{

                padding:15px;

            }

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

<div class="content-wrapper">

    <!-- TITLE -->

    <div class="mb-4">

        <div class="page-title">
            Ulasan Buku
        </div>

        <div class="page-subtitle">
            Semua review dan rating buku pengguna 📚
        </div>

    </div>

    <!-- CARD -->

    <div class="card">

        <div class="card-header">

            <h4>

                <i class="fas fa-star text-warning mr-2"></i>

                Data Ulasan Buku

            </h4>

        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-striped">

                <thead>

                    <tr>

                        <th width="60">No</th>
                        <th>User</th>
                        <th>Buku</th>
                        <th>Ulasan</th>
                        <th width="130">Rating</th>

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

                            <i class="fas fa-user-circle user-icon"></i>

                            <?= htmlspecialchars($data['username']); ?>

                        </td>

                        <td>

                            <i class="fas fa-book book-icon"></i>

                            <?= htmlspecialchars($data['judul']); ?>

                        </td>

                        <td>

                            <?= htmlspecialchars($data['ulasan']); ?>

                        </td>

                        <td>

                            <span class="badge-rating">

                                ⭐ <?= $data['reting']; ?>/5

                            </span>

                        </td>

                    </tr>

                <?php

                    }

                } else {

                ?>

                    <tr>

                        <td colspan="5">

                            <div class="empty-box">

                                <i class="fas fa-star"></i>

                                <h5>
                                    Belum ada ulasan
                                </h5>

                                <p>
                                    Data ulasan buku masih kosong
                                </p>

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

<button class="theme-btn" id="toggleTheme">

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