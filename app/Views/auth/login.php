<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Koperasi Sejahtera</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #fff;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', sans-serif;
    }

    .login-container {
        width: 100%;
        max-width: 400px;
        padding: 20px;
        text-align: center;
    }

    .btn-purple {
        background-color: #6f42c1;
        color: white;
        border: none;
        font-weight: 600;
    }

    .btn-purple:hover {
        background-color: #5a32a3;
        color: white;
    }

    .btn-outline-purple {
        color: #6f42c1;
        border: 2px solid #6f42c1;
        font-weight: 600;
    }

    .btn-outline-purple:hover {
        background-color: #6f42c1;
        color: white;
    }

    .form-control {
        border-radius: 8px;
        padding: 12px;
        border: 1px solid #ced4da;
    }

    .title-text {
        color: #6f42c1;
        /* Warna ungu */
        font-weight: 700;
    }
    </style>
</head>

<body>

    <div class="login-container">
        <h2 class="title-text mb-1">Koperasi Simpan Pinjam<br>Sejahtera</h2>
        <p class="text-muted mb-4">Sistem Manajemen Koperasi</p>

        <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger text-start py-2 fs-6"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success text-start py-2 fs-6"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('auth/loginProcess') ?>" method="post">
            <div class="mb-3 text-start">
                <label class="fw-bold small mb-1">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
            </div>

            <div class="mb-4 text-start">
                <label class="fw-bold small mb-1">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="btn btn-purple w-100 py-2 mb-4">Masuk</button>
        </form>

        <div class="mb-3">
            <small class="text-muted">Belum punya akun?</small>
        </div>

        <a href="<?= base_url('register') ?>" class="btn btn-outline-purple w-100 py-2">Daftar Akun Baru</a>

        <div class="mt-5 text-muted small">
            <p class="mb-0">NIM: 2024010001</p>
            <p>Nama: Nama Mahasiswa</p>
        </div>
    </div>

</body>

</html>