<?php
if (isset($_POST['submit'])) {
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);

    if ($kategori !== '') {
        $query = mysqli_query($koneksi, "INSERT INTO kategori (kategori) VALUES ('$kategori')");
        if ($query) {
            echo "<script>alert('Tambah data berhasil!'); window.location.href='?page=kategori';</script>";
            exit;
        }
        echo "<script>alert('Tambah data gagal!');</script>";
    } else {
        echo "<script>alert('Kategori tidak boleh kosong!');</script>";
    }
}
?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title mb-1 font-weight-bold">Tambah Kategori</h3>
        <div class="text-muted small">Buat kategori baru supaya data buku lebih rapi.</div>
    </div>
    <div class="card-body">
        <form method="post">
            <div class="row">
                <div class="col-lg-8 mb-3">
                    <label class="font-weight-bold">Nama Kategori</label>
                    <input type="text" class="form-control" name="kategori" placeholder="Contoh: Fiksi, Referensi, Pelajaran" required>
                </div>
            </div>

            <div class="d-flex flex-wrap" style="gap:.75rem;">
                <button type="submit" class="btn btn-primary" name="submit">
                    <i class="fas fa-save mr-2"></i>Simpan
                </button>
                <button type="reset" class="btn btn-secondary">
                    <i class="fas fa-rotate-left mr-2"></i>Reset
                </button>
                <a href="?page=kategori" class="btn btn-danger">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </form>
    </div>
</div>
