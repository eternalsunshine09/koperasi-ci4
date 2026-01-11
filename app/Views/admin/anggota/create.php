<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', sans-serif;
    }

    .sidebar {
        width: 280px;
        height: 100vh;
        background: #3b71db;
        color: white;
        position: fixed;
        z-index: 100;
    }

    .nav-link {
        color: rgba(255, 255, 255, 0.8);
        margin: 5px 15px;
        border-radius: 8px;
        padding: 12px 15px;
    }

    .nav-link:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
    }

    .main-content {
        margin-left: 280px;
        padding: 30px;
        min-height: 100vh;
    }

    .card-custom {
        border: none;
        border-radius: 20px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    }

    .btn-gradient {
        background: linear-gradient(135deg, #4e73df 0%, #6f42c1 100%);
        border: none;
        color: white;
        padding: 10px 25px;
        border-radius: 10px;
        font-weight: 600;
    }
    </style>
</head>

<body>

    <div class="sidebar d-flex flex-column p-3">
        <div class="d-flex align-items-center mb-5 px-2 mt-2">
            <i class="bi bi-bank2 fs-1 me-3"></i>
            <h6 class="mb-0 fw-bold text-white">Koperasi Sejahtera</h6>
        </div>
        <ul class="nav nav-pills flex-column mb-auto">
            <li><a href="<?= base_url('dashboard') ?>" class="nav-link text-white"><i
                        class="bi bi-grid-1x2-fill me-2"></i> Dashboard</a></li>
            <li><a href="<?= base_url('anggota') ?>" class="nav-link text-white active"><i
                        class="bi bi-people-fill me-2"></i> Data Anggota</a></li>
        </ul>
    </div>

    <div class="main-content">
        <h2 class="fw-bold mb-4">Tambah Anggota Baru</h2>
        <div class="card card-custom bg-white p-4">
            <form action="<?= base_url('anggota/save') ?>" method="post">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">NIK</label>
                        <input type="number" name="nik" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Password</label>
                        <input type="text" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">No. Telp</label>
                        <input type="text" name="no_telp" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Alamat</label>
                        <input type="text" name="alamat" class="form-control">
                    </div>
                </div>
                <div class="mt-4 text-end">
                    <a href="<?= base_url('anggota') ?>" class="btn btn-light me-2">Batal</a>
                    <button type="submit" class="btn btn-gradient">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>