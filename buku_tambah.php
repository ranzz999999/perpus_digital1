<?php
if (isset($_POST['submit'])) {

    $id_kategori = mysqli_real_escape_string($koneksi, $_POST['id_kategori']);
    $judul       = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $penulis     = mysqli_real_escape_string($koneksi, $_POST['penulis']);
    $penerbit    = mysqli_real_escape_string($koneksi, $_POST['penerbit']);
    $tahun       = mysqli_real_escape_string($koneksi, $_POST['tahun_terbit']);
    $deskripsi   = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    /* =========================
       UPLOAD FOTO
    ========================= */

    $foto = '';

    if (!empty($_FILES['foto']['name'])) {

        $namaFile = $_FILES['foto']['name'];
        $tmpFile  = $_FILES['foto']['tmp_name'];

        $ext = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

        $allowed = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($ext, $allowed)) {

            $namaBaru = time() . '_' . rand(100,999) . '.' . $ext;

            move_uploaded_file(
                $tmpFile,
                'uploads/' . $namaBaru
            );

            $foto = $namaBaru;

        } else {

            echo "
            <script>
                alert('Format foto tidak didukung');
            </script>
            ";
        }
    }

    /* =========================
       INSERT DATA
    ========================= */

    $query = mysqli_query($koneksi, "

        INSERT INTO buku
        (
            id_kategori,
            judul,
            penulis,
            penerbit,
            tahun_terbit,
            deskripsi,
            foto
        )

        VALUES
        (
            '$id_kategori',
            '$judul',
            '$penulis',
            '$penerbit',
            '$tahun',
            '$deskripsi',
            '$foto'
        )

    ");

    if ($query) {

        echo "
        <script>
            alert('Data berhasil ditambahkan');
            window.location.href='index.php?page=buku';
        </script>
        ";

        exit;
    }

    echo "
    <script>
        alert('Gagal menambah data');
    </script>
    ";
}
?>

<div class="card">

    <div class="card-header">

        <h3 class="card-title mb-1 font-weight-bold">
            Tambah Buku Baru
        </h3>

        <div class="text-muted small">
            Isi data dengan lengkap agar katalog lebih tertata.
        </div>

    </div>

    <div class="card-body">

        <form method="post" enctype="multipart/form-data">

            <div class="row">

                <!-- KATEGORI -->

                <div class="col-lg-6 mb-3">

                    <label class="font-weight-bold">
                        Kategori
                    </label>

                    <select
                        name="id_kategori"
                        class="form-control"
                        required>

                        <option value="">
                            -- Pilih Kategori --
                        </option>

                        <?php
                        $kategori = mysqli_query(
                            $koneksi,
                            "SELECT * FROM kategori ORDER BY kategori ASC"
                        );

                        while ($k = mysqli_fetch_assoc($kategori)) :
                        ?>

                        <option value="<?= (int)$k['id_kategori']; ?>">

                            <?= htmlspecialchars(
                                $k['kategori'],
                                ENT_QUOTES,
                                'UTF-8'
                            ); ?>

                        </option>

                        <?php endwhile; ?>

                    </select>

                </div>

                <!-- JUDUL -->

                <div class="col-lg-6 mb-3">

                    <label class="font-weight-bold">
                        Judul
                    </label>

                    <input
                        type="text"
                        name="judul"
                        class="form-control"
                        placeholder="Masukkan judul buku"
                        required>

                </div>

                <!-- PENULIS -->

                <div class="col-lg-6 mb-3">

                    <label class="font-weight-bold">
                        Penulis
                    </label>

                    <input
                        type="text"
                        name="penulis"
                        class="form-control"
                        placeholder="Nama penulis"
                        required>

                </div>

                <!-- PENERBIT -->

                <div class="col-lg-6 mb-3">

                    <label class="font-weight-bold">
                        Penerbit
                    </label>

                    <input
                        type="text"
                        name="penerbit"
                        class="form-control"
                        placeholder="Nama penerbit"
                        required>

                </div>

                <!-- TAHUN -->

                <div class="col-lg-4 mb-3">

                    <label class="font-weight-bold">
                        Tahun Terbit
                    </label>

                    <input
                        type="number"
                        name="tahun_terbit"
                        class="form-control"
                        placeholder="Contoh: 2024"
                        required>

                </div>

                <!-- FOTO -->

                <div class="col-lg-8 mb-3">

                    <label class="font-weight-bold">
                        Foto Buku
                    </label>

                    <input
                        type="file"
                        name="foto"
                        class="form-control">

                    <small class="text-muted">
                        Format: JPG, PNG, WEBP
                    </small>

                </div>

                <!-- DESKRIPSI -->

                <div class="col-lg-12 mb-3">

                    <label class="font-weight-bold">
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi"
                        class="form-control"
                        rows="4"
                        placeholder="Ringkasan singkat buku"
                        required></textarea>

                </div>

            </div>

            <!-- BUTTON -->

            <div class="d-flex flex-wrap" style="gap:.75rem;">

                <button
                    type="submit"
                    name="submit"
                    class="btn btn-primary">

                    <i class="fas fa-save mr-2"></i>
                    Simpan

                </button>

                <a
                    href="?page=buku"
                    class="btn btn-secondary">

                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali

                </a>

            </div>

        </form>

    </div>

</div>