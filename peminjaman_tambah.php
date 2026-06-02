<?php
include 'koneksi.php';

if(isset($_POST['simpan'])){

    $id_user = $_POST['id_user'];
    $id_buku = $_POST['id_buku'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];
    $status = $_POST['status'];

    mysqli_query($koneksi, "INSERT INTO peminjaman
    (id_user,id_buku,tanggal_pinjam,tanggal_kembali,status)
    VALUES
    ('$id_user','$id_buku','$tanggal_pinjam','$tanggal_kembali','$status')
    ");

    echo "<script>alert('Data berhasil disimpan');location.href='?page=peminjaman';</script>";
}

$user = mysqli_query($koneksi,"SELECT * FROM user");
$buku = mysqli_query($koneksi,"SELECT * FROM buku");
?>

<div class="card">
    <div class="card-header">
        <h4>Tambah Peminjaman</h4>
    </div>

    <div class="card-body">

        <form method="post">

            <div class="form-group">
                <label>User</label>
                <select name="id_user" class="form-control" required>
                    <option value="">Pilih User</option>
                    <?php while($u=mysqli_fetch_array($user)){ ?>
                    <option value="<?= $u['id_user']; ?>">
                        <?= $u['nama']; ?>
                    </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label>Buku</label>
                <select name="id_buku" class="form-control" required>
                    <option value="">Pilih Buku</option>
                    <?php while($b=mysqli_fetch_array($buku)){ ?>
                    <option value="<?= $b['id_buku']; ?>">
                        <?= $b['judul']; ?>
                    </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label>Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" class="form-control">
            </div>

            <div class="form-group">
                <label>Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" class="form-control">
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="dipinjam">Dipinjam</option>
                    <option value="dikembalikan">Dikembalikan</option>
                </select>
            </div>

            <button type="submit" name="simpan" class="btn btn-primary">
                Simpan
            </button>

        </form>

    </div>
</div>
