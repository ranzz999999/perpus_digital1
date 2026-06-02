<?php
include 'koneksi.php';

$query = mysqli_query($koneksi, "
SELECT * FROM peminjaman
LEFT JOIN user ON user.id_user = peminjaman.id_user
LEFT JOIN buku ON buku.id_buku = peminjaman.id_buku
ORDER BY id_peminjaman DESC
");
?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Data Peminjaman</h4>
        <a href="?page=peminjaman_tambah" class="btn btn-primary">
            Tambah Peminjaman
        </a>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while($data = mysqli_fetch_array($query)){
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                  <td><?= $data['username']; ?></td>
                    <td><?= $data['judul']; ?></td>
                    <td><?= $data['tanggal_pinjam']; ?></td>
                    <td><?= $data['tanggal_kembali']; ?></td>
                    <td>
                        <span class="badge badge-success">
                            <?= $data['status']; ?>
                        </span>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
