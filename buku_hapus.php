<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'koneksi.php';

// cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// cek id
if (!isset($_GET['id'])) {
    die("ID tidak ditemukan");
}

$id = intval($_GET['id']);

// ambil data (opsional tapi bagus untuk validasi)
$cek = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku = $id");

if (mysqli_num_rows($cek) == 0) {
    die("Data tidak ditemukan");
}

// hapus data
$hapus = mysqli_query($koneksi, "DELETE FROM buku WHERE id_buku = $id");

if ($hapus) {
    echo "<script>
            alert('Data buku berhasil dihapus');
            location.href='index.php?page=buku';
          </script>";
} else {
    die("Gagal hapus data: " . mysqli_error($koneksi));
}
?>