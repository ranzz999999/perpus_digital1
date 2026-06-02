<?php
$id = $_GET['id'];

$query = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku='$id'");
$data = mysqli_fetch_assoc($query);

if(isset($_POST['submit'])){

    $id_kategori = $_POST['id_kategori'];
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $deskripsi = $_POST['deskripsi'];

    $foto = $data['foto'];

    if($_FILES['foto']['name'] != ''){

        $nama_file = time().'_'.$_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];

        move_uploaded_file($tmp, 'uploads/'.$nama_file);

        $foto = $nama_file;
    }

    $update = mysqli_query($koneksi, "UPDATE buku SET
        id_kategori='$id_kategori',
        judul='$judul',
        penulis='$penulis',
        penerbit='$penerbit',
        tahun_terbit='$tahun_terbit',
        deskripsi='$deskripsi',
        foto='$foto'
        WHERE id_buku='$id'
    ");

    if($update){
        echo "<script>alert('Data berhasil diubah');window.location='?page=buku';</script>";
    }
}
?>

<div class="card">
    <div class="card-header">
        <h4>Ubah Buku</h4>
    </div>

    <div class="card-body">

        <form method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label>Kategori</label>

                <select name="id_kategori" class="form-control">

                    <?php
                    $kategori = mysqli_query($koneksi, "SELECT * FROM kategori");

                    while($k = mysqli_fetch_assoc($kategori)){
                    ?>

                    <option value="<?= $k['id_kategori']; ?>"
                        <?= ($k['id_kategori'] == $data['id_kategori']) ? 'selected' : ''; ?>>

                        <?= $k['kategori']; ?>

                    </option>

                    <?php } ?>

                </select>
            </div>

            <div class="mb-3">
                <label>Judul</label>
                <input type="text" name="judul" class="form-control" value="<?= $data['judul']; ?>">
            </div>

            <div class="mb-3">
                <label>Penulis</label>
                <input type="text" name="penulis" class="form-control" value="<?= $data['penulis']; ?>">
            </div>

            <div class="mb-3">
                <label>Penerbit</label>
                <input type="text" name="penerbit" class="form-control" value="<?= $data['penerbit']; ?>">
            </div>

            <div class="mb-3">
                <label>Tahun Terbit</label>
                <input type="number" name="tahun_terbit" class="form-control" value="<?= $data['tahun_terbit']; ?>">
            </div>

            <div class="mb-3">
                <label>Foto Buku</label>
                <input type="file" name="foto" class="form-control">

                <br>

                <?php if($data['foto'] != ''){ ?>
                    <img src="uploads/<?= $data['foto']; ?>" width="120">
                <?php } ?>
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control"><?= $data['deskripsi']; ?></textarea>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">
                Update
            </button>

        </form>

    </div>
</div>
