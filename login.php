<?php
session_start();
require_once 'koneksi.php';

if (isset($_SESSION['user'])) {

    if ($_SESSION['user']['role'] == 'admin') {
        header('Location: index.php');
    } else {
        header('Location: katalog.php');
    }

    exit;
}

if (isset($_POST['login'])) {

    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    $data = mysqli_query($koneksi, "
        SELECT * FROM user
        WHERE username='$username'
        LIMIT 1
    ");

    $user = mysqli_fetch_assoc($data);

    if ($user) {

        $storedPassword = $user['password'] ?? '';

        $isValid =
            password_verify($password, $storedPassword)
            ||
            hash_equals((string)$storedPassword, (string)$password);

        if ($isValid) {

            $_SESSION['user'] = $user;

            /* =========================
               LOGIN ADMIN
            ========================= */

            if ($user['role'] == 'admin') {

                echo "
                <script>
                    alert('Login Admin berhasil');
                    window.location='index.php';
                </script>
                ";

            }

            /* =========================
               LOGIN PEMINJAM
            ========================= */

            else {

                echo "
                <script>
                    alert('Login Peminjam berhasil');
                    window.location='katalog.php';
                </script>
                ";

            }

            exit;
        }

        $error = 'Password salah';

    } else {

        $error = 'Username tidak ditemukan';

    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1">

    <title>Login - Perpustakaan Digital</title>

    <link rel="stylesheet"
        href="css/adminlte.min.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>

        body {

            min-height: 100vh;

            background:
                radial-gradient(circle at top left, rgba(59,130,246,.25), transparent 26%),
                radial-gradient(circle at bottom right, rgba(34,197,94,.20), transparent 24%),
                linear-gradient(135deg, #0f172a 0%, #111827 48%, #0b1220 100%);

            overflow: hidden;
        }

        .login-shell {

            position: relative;

            min-height: 100vh;

            display: grid;

            place-items: center;

            padding: 1.5rem;
        }

        .login-shell::before,
        .login-shell::after {

            content: '';

            position: absolute;

            border-radius: 999px;

            filter: blur(10px);

            opacity: .35;

            pointer-events: none;

            animation: floaty 9s ease-in-out infinite;
        }

        .login-shell::before {

            width: 220px;

            height: 220px;

            background: rgba(59,130,246,.28);

            top: 8%;

            left: 8%;
        }

        .login-shell::after {

            width: 280px;

            height: 280px;

            background: rgba(34,197,94,.22);

            bottom: 4%;

            right: 4%;

            animation-delay: -2s;
        }

        @keyframes floaty {

            0%, 100% {
                transform: translateY(0) scale(1);
            }

            50% {
                transform: translateY(-18px) scale(1.03);
            }

        }

        .login-card {

            width: min(100%, 460px);

            position: relative;

            z-index: 1;

            border: 1px solid rgba(255,255,255,.14);

            background: rgba(255,255,255,.88);

            backdrop-filter: blur(18px);

            border-radius: 1.4rem;

            box-shadow: 0 24px 60px rgba(0,0,0,.28);

            overflow: hidden;
        }

        .login-top {

            padding: 1.5rem 1.5rem 0;
        }

        .brand-chip {

            display: inline-flex;

            align-items: center;

            gap: .5rem;

            padding: .5rem .85rem;

            border-radius: 999px;

            background: rgba(37,99,235,.10);

            color: #1d4ed8;

            font-weight: 700;

            font-size: .88rem;
        }

        .login-body {

            padding: 1.5rem;
        }

        .login-title {

            font-weight: 800;

            letter-spacing: -.03em;

            margin: .9rem 0 .35rem;
        }

        .login-subtitle {

            color: #64748b;

            margin-bottom: 1.5rem;
        }

        .form-control {

            border-radius: .9rem;

            height: calc(1.5em + 1.1rem + 2px);
        }

        .btn {

            border-radius: .9rem;

            padding: .7rem 1rem;
        }

        .alert {

            border-radius: .9rem;
        }

        .login-footer {

            padding: 0 1.5rem 1.5rem;

            color: #64748b;
        }

    </style>

</head>

<body>

<div class="login-shell">

    <div class="login-card">

        <div class="login-top">

            <span class="brand-chip">

                <i class="fas fa-book-open"></i>

                Perpustakaan Digital

            </span>

            <h1 class="login-title h3">

                Masuk ke dashboard

            </h1>

        </div>

        <div class="login-body">

            <?php if (!empty($error)): ?>

                <div class="alert alert-danger">

                    <i class="fas fa-circle-exclamation mr-2"></i>

                    <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>

                </div>

            <?php endif; ?>

            <form method="post">

                <div class="form-group mb-3">

                    <label class="font-weight-bold">

                        Username

                    </label>

                    <input
                        type="text"
                        name="username"
                        class="form-control"
                        placeholder="Masukkan username"
                        required>

                </div>

                <div class="form-group mb-4">

                    <label class="font-weight-bold">

                        Password

                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Masukkan password"
                        required>

                </div>

                <button
                    type="submit"
                    name="login"
                    class="btn btn-primary btn-block">

                    <i class="fas fa-right-to-bracket mr-2"></i>

                    Login

                </button>

            </form>

        </div>

        <div class="login-footer d-flex flex-column flex-sm-row justify-content-between align-items-sm-center">

            <small>

                Belum punya akun?

            </small>

            <a href="register.php"
               class="font-weight-bold">

                Daftar sekarang

            </a>

        </div>

    </div>

</div>

</body>
</html>