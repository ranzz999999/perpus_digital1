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

// 🔴 CEK apakah kategori masih dipakai di tabel buku
$cek = $koneksi->prepare("SELECT COUNT(*) FROM buku WHERE id_kategori = ?");
$cek->bind_param("i", $id);
$cek->execute();
$cek->bind_result($jumlah);
$cek->fetch();
$cek->close();

if ($jumlah > 0) {
    echo "<script>
            alert('Kategori tidak bisa dihapus karena masih digunakan di data buku');
            location.href='index.php?page=kategori';
          </script>";
    exit;
}

// 🔴 HAPUS kategori
$stmt = $koneksi->prepare("DELETE FROM kategori WHERE id_kategori = ?");

if (!$stmt) {
    die("Prepare gagal: " . $koneksi->error);
}

$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<script>
            alert('Hapus data berhasil');
            location.href='index.php?page=kategori';
          </script>";
} else {
    die("Gagal hapus: " . $stmt->error);
}

$stmt->close();
$koneksi->close();
?>