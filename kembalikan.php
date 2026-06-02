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
   CEK ID PEMINJAMAN
========================= */

if (!isset($_GET['id'])) {

    echo "
    <script>

        alert('Data peminjaman tidak ditemukan');

        window.location='buku_saya.php';

    </script>
    ";

    exit;

}

$id_peminjaman = (int) $_GET['id'];

$id_user = $_SESSION['user']['id_user'];

/* =========================
   CEK DATA PEMINJAMAN
========================= */

$cek = mysqli_query($koneksi, "

    SELECT *

    FROM peminjaman

    WHERE id_peminjaman='$id_peminjaman'
    AND id_user='$id_user'

");

if (mysqli_num_rows($cek) == 0) {

    echo "
    <script>

        alert('Data tidak ditemukan');

        window.location='buku_saya.php';

    </script>
    ";

    exit;

}

$data = mysqli_fetch_assoc($cek);

/* =========================
   CEK STATUS
========================= */

if ($data['status'] == 'dikembalikan') {

    echo "
    <script>

        alert('Buku sudah dikembalikan');

        window.location='buku_saya.php';

    </script>
    ";

    exit;

}

/* =========================
   UPDATE STATUS
========================= */

$update = mysqli_query($koneksi, "

    UPDATE peminjaman

    SET status='dikembalikan'

    WHERE id_peminjaman='$id_peminjaman'

");

/* =========================
   HASIL
========================= */

if ($update) {

    echo "
    <script>

        alert('Buku berhasil dikembalikan');

        window.location='buku_saya.php';

    </script>
    ";

} else {

    echo "
    <script>

        alert('Gagal mengembalikan buku');

        window.location='buku_saya.php';

    </script>
    ";

}
?>