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
   AMBIL DATA USER
========================= */

$id_user = $_SESSION['user']['id_user'];

/* =========================
   CEK ID BUKU
========================= */

if (!isset($_GET['id'])) {

    echo "
    <script>

        alert('Buku tidak ditemukan');

        window.location='katalog.php';

    </script>
    ";

    exit;

}

$id_buku = (int) $_GET['id'];

/* =========================
   CEK BUKU ADA ATAU TIDAK
========================= */

$cekBuku = mysqli_query($koneksi, "
    SELECT *
    FROM buku
    WHERE id_buku='$id_buku'
");

if (mysqli_num_rows($cekBuku) == 0) {

    echo "
    <script>

        alert('Buku tidak tersedia');

        window.location='katalog.php';

    </script>
    ";

    exit;

}

$buku = mysqli_fetch_assoc($cekBuku);

/* =========================
   CEK APAKAH SUDAH DIPINJAM
========================= */

$cekPinjam = mysqli_query($koneksi, "

    SELECT *

    FROM peminjaman

    WHERE id_user='$id_user'
    AND id_buku='$id_buku'
    AND status='dipinjam'

");

if (mysqli_num_rows($cekPinjam) > 0) {

    echo "
    <script>

        alert('Buku ini sudah kamu pinjam');

        window.location='katalog.php';

    </script>
    ";

    exit;

}

/* =========================
   TANGGAL PINJAM
========================= */

$tanggal_pinjam = date('Y-m-d');

$tanggal_kembali = date(
    'Y-m-d',
    strtotime('+7 days')
);

/* =========================
   SIMPAN PEMINJAMAN
========================= */

$simpan = mysqli_query($koneksi, "

    INSERT INTO peminjaman
    (
        id_user,
        id_buku,
        tanggal_pinjam,
        tanggal_kembali,
        status
    )

    VALUES
    (
        '$id_user',
        '$id_buku',
        '$tanggal_pinjam',
        '$tanggal_kembali',
        'dipinjam'
    )

");

/* =========================
   HASIL
========================= */

if ($simpan) {

    echo "
    <script>

        alert('Buku berhasil dipinjam');

        window.location='katalog.php';

    </script>
    ";

} else {

    echo "
    <script>

        alert('Gagal meminjam buku');

        window.location='katalog.php';

    </script>
    ";

}
?>