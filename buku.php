<div class="card">
    <div class="card-header d-flex flex-column flex-md-row align-items-md-center justify-content-between">
        <div>
            <h3 class="card-title mb-1 font-weight-bold">Data Buku</h3>
            <div class="text-muted small">
                Kelola daftar buku dengan tampilan yang lebih clean.
            </div>
        </div>

        <a href="?page=buku_tambah" class="btn btn-primary mt-3 mt-md-0">
            <i class="fas fa-plus mr-2"></i>Tambah Data
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">

            <table class="table table-hover table-striped mb-0"
                   id="datatable"
                   width="100%"
                   cellspacing="0">

                <thead>
                    <tr>
                        <th style="width:60px;">No</th>
                        <th style="width:120px;">Foto</th>
                        <th>Nama Kategori</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th style="width:110px;">Tahun</th>
                        <th>Deskripsi</th>
                        <th style="width:160px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                <?php
                $i = 1;

                $query = mysqli_query($koneksi, "
                    SELECT buku.*, kategori.kategori AS nama_kategori
                    FROM buku
                    LEFT JOIN kategori
                    ON buku.id_kategori = kategori.id_kategori
                    ORDER BY buku.id_buku DESC
                ");

                if ($query && mysqli_num_rows($query) > 0):

                    while ($data = mysqli_fetch_assoc($query)):

                        $desc = $data['deskripsi'] ?? '';
                ?>

                    <tr>

                        <td><?php echo $i++; ?></td>

                        <td>
                            <?php if(!empty($data['foto'])){ ?>

                                <img src="uploads/<?php echo $data['foto']; ?>"
                                     width="70"
                                     height="90"
                                     style="object-fit:cover; border-radius:10px;">

                            <?php }else{ ?>

                                <span class="text-muted small">
                                    Tidak ada foto
                                </span>

                            <?php } ?>
                        </td>

                        <td>
                            <span class="badge badge-light px-3 py-2">
                                <?php echo htmlspecialchars($data['nama_kategori'] ?? '-', ENT_QUOTES, 'UTF-8'); ?>
                            </span>
                        </td>

                        <td class="font-weight-bold">
                            <?php echo htmlspecialchars($data['judul'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($data['penulis'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($data['penerbit'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($data['tahun_terbit'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
                        </td>

                        <td style="max-width:260px;">
                            <span class="d-inline-block text-truncate"
                                  style="max-width:240px;"
                                  title="<?php echo htmlspecialchars($desc, ENT_QUOTES, 'UTF-8'); ?>">

                                <?php echo htmlspecialchars($desc, ENT_QUOTES, 'UTF-8'); ?>

                            </span>
                        </td>

                        <td>
                            <div class="btn-group btn-group-sm" role="group">

                                <a href="?page=buku_ubah&id=<?php echo (int)$data['id_buku']; ?>"
                                   class="btn btn-info">

                                    <i class="fas fa-pen mr-1"></i>Ubah

                                </a>

                                <a onclick="return confirm('Apakah Anda yakin menghapus data ini?');"
                                   href="?page=buku_hapus&id=<?php echo (int)$data['id_buku']; ?>"
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
                        <td colspan="9">

                            <div class="empty-panel p-4 text-center">

                                <div class="h5 font-weight-bold mb-2">
                                    Belum ada data buku
                                </div>

                                <div class="text-muted mb-3">
                                    Klik tombol tambah data untuk mulai mengisi koleksi.
                                </div>

                                <a href="?page=buku_tambah" class="btn btn-primary">
                                    Tambah Buku Pertama
                                </a>

                            </div>

                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>
    </div>
</div>