<?php
require_once 'koneksi.php';

if (isset($_POST['register'])) {

    $username = mysqli_real_escape_string($koneksi, $_POST['username']);

    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );

    // Role otomatis peminjam
    $role = 'peminjaman';

    $cek = mysqli_query(
        $koneksi,
        "SELECT * FROM user 
         WHERE username='$username' 
         LIMIT 1"
    );

    if ($cek && mysqli_num_rows($cek) > 0) {

        $error = 'Username sudah digunakan';

    } else {

        $query = mysqli_query(
            $koneksi,
            "INSERT INTO user
            (
                username,
                password,
                role
            )

            VALUES
            (
                '$username',
                '$password',
                '$role'
            )"
        );

        if ($query) {

            echo "
            <script>
                alert('Register berhasil');
                window.location='login.php';
            </script>
            ";

            exit;
        }

        $error = 'Register gagal';
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        Register - Perpustakaan Digital
    </title>

    <link
        rel="stylesheet"
        href="css/adminlte.min.css"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    >

    <style>

        body{
            min-height:100vh;

            background:
            radial-gradient(
                circle at top right,
                rgba(59,130,246,.18),
                transparent 24%
            ),

            radial-gradient(
                circle at bottom left,
                rgba(34,197,94,.16),
                transparent 24%
            ),

            linear-gradient(
                135deg,
                #eff6ff 0%,
                #f8fafc 45%,
                #eef2ff 100%
            );
        }

        /* =========================
           WRAPPER
        ========================= */

        .auth-shell{
            min-height:100vh;

            display:flex;
            align-items:center;
            justify-content:center;

            padding:20px;
        }

        /* =========================
           CARD
        ========================= */

        .auth-card{
            width:100%;
            max-width:460px;

            background:rgba(255,255,255,.92);

            backdrop-filter:blur(14px);

            border-radius:24px;

            overflow:hidden;

            box-shadow:
            0 25px 60px rgba(15,23,42,.12);
        }

        .auth-head{
            padding:30px 30px 10px;
        }

        .auth-body{
            padding:20px 30px;
        }

        .auth-footer{
            padding:0 30px 30px;
        }

        /* =========================
           TITLE
        ========================= */

        .auth-title{
            font-weight:800;

            margin-top:15px;
            margin-bottom:8px;

            color:#0f172a;
        }

        .auth-subtitle{
            color:#64748b;
            margin-bottom:0;
        }

        /* =========================
           FORM
        ========================= */

        .form-control{
            border-radius:14px;
            height:50px;

            border:1px solid #dbe2ea;
        }

        .form-control:focus{
            box-shadow:none;
            border-color:#2563eb;
        }

        .btn{
            border-radius:14px;
            height:50px;
            font-weight:600;
        }

        /* =========================
           ALERT
        ========================= */

        .alert{
            border-radius:14px;
        }

        /* =========================
           ROLE BOX
        ========================= */

        .role-box{
            background:#eff6ff;
            color:#1d4ed8;

            border-radius:14px;

            padding:14px;

            font-weight:600;

            display:flex;
            align-items:center;
            gap:10px;
        }

        .role-box i{
            font-size:18px;
        }

        /* =========================
           LOGIN LINK
        ========================= */

        .login-link{
            color:#2563eb;

            font-weight:700;

            text-decoration:none;
        }

        .login-link:hover{
            text-decoration:underline;
        }

    </style>

</head>

<body>

<div class="auth-shell">

    <div class="auth-card">

        <!-- =========================
             HEADER
        ========================= -->

        <div class="auth-head">

            <span class="badge badge-primary px-3 py-2">

                <i class="fas fa-user-plus mr-1"></i>

                Buat Akun Baru

            </span>

            <h2 class="auth-title">

                Register Akun

            </h2>

            <p class="auth-subtitle">

                Daftar untuk mulai meminjam buku digital 📚

            </p>

        </div>

        <!-- =========================
             BODY
        ========================= -->

        <div class="auth-body">

            <?php if (!empty($error)): ?>

                <div class="alert alert-danger">

                    <i class="fas fa-circle-exclamation mr-2"></i>

                    <?php echo htmlspecialchars(
                        $error,
                        ENT_QUOTES,
                        'UTF-8'
                    ); ?>

                </div>

            <?php endif; ?>

            <form method="POST">

                <!-- USERNAME -->

                <div class="form-group mb-3">

                    <label class="font-weight-bold mb-2">

                        Username

                    </label>

                    <input
                        type="text"
                        name="username"
                        class="form-control"
                        placeholder="Masukkan username"
                        required
                    >

                </div>

                <!-- PASSWORD -->

                <div class="form-group mb-4">

                    <label class="font-weight-bold mb-2">

                        Password

                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Masukkan password"
                        required
                    >

                </div>

                <!-- ROLE -->

                <div class="mb-4">

                    <label class="font-weight-bold d-block mb-2">

                        Role Akun

                    </label>

                    <div class="role-box">

                        <i class="fas fa-user"></i>

                        Peminjam

                    </div>

                </div>

                <!-- BUTTON -->

                <button
                    type="submit"
                    name="register"
                    class="btn btn-primary btn-block"
                >

                    <i class="fas fa-user-check mr-2"></i>

                    Register Sekarang

                </button>

            </form>

        </div>

        <!-- =========================
             FOOTER
        ========================= -->

        <div class="auth-footer d-flex justify-content-between align-items-center flex-wrap gap-2">

            <small class="text-muted">

                Sudah punya akun?

            </small>

            <a
                href="login.php"
                class="login-link"
            >

                Login sekarang

            </a>

        </div>

    </div>

</div>

</body>
</html>