<?php
$kategoriCount = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kategori"));
$bukuCount     = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM buku"));
$ulasanCount   = @mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM ulasan"));
$userCount     = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM user"));
?>

<div class="row">
    <div class="col-12">
        <div class="card glass-card mb-4">
            <div class="card-body p-4 p-md-5">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <span class="badge badge-primary badge-pill px-3 py-2 mb-3">Selamat datang</span>
                        <h2 class="font-weight-bold mb-2">Dashboard perpustakaan</h2>
                        <p class="text-muted mb-4" style="max-width: 720px;">
                            DATA
                        </p>
                        <div class="d-flex flex-wrap" style="gap:.75rem;">
                            <a href="index.php?page=buku" class="btn btn-primary px-4">
                                <i class="fas fa-book-open mr-2"></i>Lihat Buku
                            </a>
                            <a href="index.php?page=kategori" class="btn btn-soft px-4">
                                <i class="fas fa-tags mr-2"></i>Kelola Kategori
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 mt-4 mt-lg-0">
                        <div class="empty-panel p-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div>
                                    <div class="text-muted small">Status hari ini</div>
                                    <div class="h3 font-weight-bold mb-0">Aktif</div>
                                </div>
                                <div class="text-primary"><i class="fas fa-sparkles fa-2x"></i></div>
                            </div>
                            <div class="progress mb-2" style="height:8px; border-radius:999px;">
                                <div class="progress-bar bg-gradient-navy" style="width:78%"></div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-gradient-blue">
            <div class="inner">
                <h3><?php echo $kategoriCount; ?></h3>
                <p>Total Kategori</p>
            </div>
            <div class="icon"><i class="fas fa-tags"></i></div>
            <a href="index.php?page=kategori" class="small-box-footer">Buka data <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-gradient-amber">
            <div class="inner">
                <h3><?php echo $bukuCount; ?></h3>
                <p>Total Buku</p>
            </div>
            <div class="icon"><i class="fas fa-book-open"></i></div>
            <a href="index.php?page=buku" class="small-box-footer">Buka data <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-gradient-green">
            <div class="inner">
                <h3><?php echo (int)$ulasanCount; ?></h3>
                <p>Total Ulasan</p>
            </div>
            <div class="icon"><i class="fas fa-comments"></i></div>
            <a href="#" class="small-box-footer">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-gradient-navy">
            <div class="inner">
                <h3><?php echo $userCount; ?></h3>
                <p>Total User</p>
            </div>
            <div class="icon"><i class="fas fa-users"></i></div>
            <a href="#" class="small-box-footer">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row mt-1">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title mb-0 font-weight-bold">Ringkasan cepat</h3>
                <span class="badge badge-light">Realtime</span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="p-3 rounded-lg border h-100" style="background:rgba(37,99,235,.04);">
                            <div class="text-primary mb-2"><i class="fas fa-layer-group"></i></div>
                            <div class="h4 font-weight-bold mb-1"><?php echo $kategoriCount; ?></div>
                            <div class="text-muted small">Kategori sudah tertata</div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="p-3 rounded-lg border h-100" style="background:rgba(245,158,11,.06);">
                            <div class="text-warning mb-2"><i class="fas fa-book"></i></div>
                            <div class="h4 font-weight-bold mb-1"><?php echo $bukuCount; ?></div>
                            <div class="text-muted small">Data buku siap dikelola</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 rounded-lg border h-100" style="background:rgba(34,197,94,.05);">
                            <div class="text-success mb-2"><i class="fas fa-user-shield"></i></div>
                            <div class="h4 font-weight-bold mb-1"><?php echo $userCount; ?></div>
                            <div class="text-muted small">Akun pengguna aktif</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title mb-0 font-weight-bold">Catatan tampilan</h3>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-3 d-flex">
                        <i class="fas fa-circle text-primary mt-1 mr-3" style="font-size:.5rem;"></i>
                        <span class="text-muted">.</span>
                    </li>
                    <li class="mb-3 d-flex">
                        <i class="fas fa-circle text-success mt-1 mr-3" style="font-size:.5rem;"></i>
                        <span class="text-muted">.</span>
                    </li>
                    <li class="d-flex">
                        <i class="fas fa-circle text-warning mt-1 mr-3" style="font-size:.5rem;"></i>
                        <span class="text-muted">.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
