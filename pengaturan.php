<?php
session_start();
include 'koneksi.php';

/* =========================
   CEK LOGIN
========================= */
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['user']['id_user'];

/* =========================
   AMBIL DATA USER
========================= */
$data = mysqli_query($koneksi, "
    SELECT * FROM user WHERE id_user='$id'
");

$user = mysqli_fetch_assoc($data);

/* =========================
   UPLOAD FOTO
========================= */
if (isset($_POST['upload'])) {

    if (!empty($_FILES['foto']['name'])) {

        $namaFile = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];

        $ext = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($ext, $allowed)) {

            $newName = "user_" . $id . "_" . time() . "." . $ext;

            if (!is_dir("uploads")) {
                mkdir("uploads", 0777, true);
            }

            move_uploaded_file($tmp, "uploads/" . $newName);

            mysqli_query($koneksi, "
                UPDATE user 
                SET foto='$newName' 
                WHERE id_user='$id'
            ");

            /* 🔥 UPDATE SESSION BIAR LANGSUNG BERUBAH */
            $_SESSION['user']['foto'] = $newName;

            header("Location: pengaturan.php");
            exit;

        } else {
            echo "<script>alert('Format file tidak didukung!');</script>";
        }
    }
}

/* =========================
   UPDATE USERNAME (FITUR BARU)
========================= */
if (isset($_POST['update_username'])) {

    $username_baru = $_POST['username'];

    mysqli_query($koneksi, "
        UPDATE user 
        SET username='$username_baru' 
        WHERE id_user='$id'
    ");

    /* 🔥 UPDATE SESSION */
    $_SESSION['user']['username'] = $username_baru;

    header("Location: pengaturan.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Pengaturan</title>

<link rel="stylesheet" href="css/adminlte.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
body{
    background:#f4f6f9;
    transition:.3s;
}

.dark-mode{
    background:#111827;
    color:white;
}

.setting-card{
    border:none;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.profile-img{
    width:120px;
    height:120px;
    border-radius:50%;
    object-fit:cover;
    border:4px solid #fff;
    box-shadow:0 5px 15px rgba(0,0,0,.15);
}

.menu-btn{
    border-radius:14px;
    padding:12px;
    text-align:left;
}
</style>
</head>

<body>

<div class="container py-5">
<div class="row justify-content-center">
<div class="col-md-6">

<div class="card setting-card">
<div class="card-body text-center p-4">

<!-- FOTO PROFIL -->
<?php if (!empty($user['foto'])) { ?>
    <img src="uploads/<?= $user['foto'] ?>" class="profile-img mb-3">
<?php } else { ?>
    <img src="https://ui-avatars.com/api/?name=User" class="profile-img mb-3">
<?php } ?>

<h4 class="fw-bold">
    <?= $user['nama'] ?>
</h4>

<p class="text-muted">
    @<?= $user['username'] ?>
</p>

<!-- =========================
     FORM GANTI USERNAME (BARU)
========================= -->
<form method="POST">

    <div class="mb-3">
        <input type="text" name="username" class="form-control"
               value="<?= $user['username'] ?>" required>
    </div>

    <button type="submit" name="update_username" class="btn btn-success w-100 mb-3">
        Ganti Username
    </button>

</form>

<!-- FORM UPLOAD FOTO -->
<form method="POST" enctype="multipart/form-data">

    <div class="mb-3">
        <input type="file" name="foto" class="form-control" required>
    </div>

    <button type="submit" name="upload" class="btn btn-primary w-100">
        <i class="fas fa-camera"></i> Ganti Foto Profil
    </button>

</form>

<hr>

<!-- MENU -->
<div class="d-grid gap-3">

    <a href="katalog.php" class="btn btn-secondary menu-btn">
        <i class="fas fa-arrow-left"></i> Kembali ke Menu
    </a>

    <a href="riwayat.php" class="btn btn-light menu-btn">
        <i class="fas fa-clock-rotate-left"></i> Riwayat Peminjaman
    </a>

    <a href="logout.php" class="btn btn-danger menu-btn">
        <i class="fas fa-right-from-bracket"></i> Logout
    </a>

</div>

</div>
</div>

</div>
</div>
</div>

<script>
function toggleDarkMode(){
    document.body.classList.toggle('dark-mode');

    localStorage.setItem(
        'darkMode',
        document.body.classList.contains('dark-mode')
    );
}

if(localStorage.getItem('darkMode') === 'true'){
    document.body.classList.add('dark-mode');
}
</script>

</body>
</html>