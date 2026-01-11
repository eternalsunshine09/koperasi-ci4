<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Koperasi Sejahtera</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #fff;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', sans-serif;
        padding: 20px;
    }

    .login-container {
        width: 100%;
        max-width: 450px;
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

    .form-control {
        border-radius: 8px;
        padding: 10px;
    }

    .title-text {
        color: #6f42c1;
        font-weight: 700;
    }
    </style>
</head>

<body>

    <div class="login-container">
        <h3 class="title-text mb-2">Pendaftaran Anggota</h3>
        <p class="text-muted mb-4">Silahkan lengkapi data diri Anda</p>

        <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger text-start"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('auth/registerProcess') ?>" method="post">
            <div class="mb-3 text-start">
                <label class="fw-bold small mb-1">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" required>
            </div>

            <div class="mb-3 text-start">
                <label class="fw-bold small mb-1">NIK (Nomor Induk)</label>
                <input type="number" name="nik" class="form-control" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3 text-start">
                    <label class="fw-bold small mb-1">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3 text-start">
                    <label class="fw-bold small mb-1">Password</label>
                    <input type="text" name="password" class="form-control" required>
                </div>
            </div>

            <div class="mb-4 text-start">
                <label class="fw-bold small mb-1">No. Telepon</label>
                <input type="text" name="no_telp" class="form-control">
            </div>

            <button type="submit" class="btn btn-purple w-100 py-2 mb-3">Daftar Sekarang</button>
        </form>

        <a href="<?= base_url('auth') ?>" class="text-decoration-none text-muted small">Sudah punya akun? <b>Login
                disini</b></a>
    </div>

</body>

</html>