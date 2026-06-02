<div class="card">
    <div class="card-header d-flex flex-column flex-md-row align-items-md-center justify-content-between">
        <div>
            <h3 class="card-title mb-1 font-weight-bold">Kategori Buku</h3>
            <div class="text-muted small">Daftar kategori dibuat lebih ringkas dan bersih.</div>
        </div>
        <a href="?page=kategori_tambah" class="btn btn-primary mt-3 mt-md-0">
            <i class="fas fa-plus mr-2"></i>Tambah Data
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0" id="datatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width:60px;">No</th>
                        <th>Nama Kategori</th>
                        <th style="width:160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $query = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY id_kategori DESC");

                    if ($query && mysqli_num_rows($query) > 0):
                        while ($data = mysqli_fetch_assoc($query)):
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td class="font-weight-bold"><?php echo htmlspecialchars($data['kategori'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="?page=kategori_ubah&id=<?php echo (int)$data['id_kategori']; ?>" class="btn btn-info">
                                    <i class="fas fa-pen mr-1"></i>Ubah
                                </a>
                                <a onclick="return confirm('Apakah Anda yakin menghapus data ini?');"
                                   href="?page=kategori_hapus&id=<?php echo (int)$data['id_kategori']; ?>"
                                   class="btn btn-danger">
                                    <i class="fas fa-trash mr-1"></i>Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php
                        endwhile;
                    else:
                    ?>
                    <tr>
                        <td colspan="3">
                            <div class="empty-panel p-4 text-center">
                                <div class="h5 font-weight-bold mb-2">Belum ada kategori</div>
                                <div class="text-muted mb-3">Tambah kategori dulu supaya data buku lebih terstruktur.</div>
                                <a href="?page=kategori_tambah" class="btn btn-primary">Tambah Kategori</a>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
