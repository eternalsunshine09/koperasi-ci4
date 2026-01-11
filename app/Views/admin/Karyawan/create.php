<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
    /* Membuat background gelap transparan seperti modal */
    body {
        background-color: rgba(0, 0, 0, 0.5);
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', sans-serif;
    }

    .card-modal {
        background: white;
        width: 100%;
        max-width: 600px;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        position: relative;
    }

    .form-control,
    .form-select {
        border-radius: 12px;
        padding: 12px;
        border: 1px solid #e0e0e0;
        background-color: #f9f9f9;
    }

    .form-control:focus {
        border-color: #6f42c1;
        box-shadow: none;
        background: white;
    }

    .btn-gradient {
        background: linear-gradient(135deg, #6f42c1 0%, #4e73df 100%);
        border: none;
        color: white;
        padding: 12px;
        border-radius: 12px;
        font-weight: 600;
        width: 100%;
    }

    .btn-cancel {
        background: white;
        border: 2px solid #e0e0e0;
        color: #555;
        padding: 12px;
        border-radius: 12px;
        font-weight: 600;
        width: 100%;
    }
    </style>
</head>

<body>

    <div class="card-modal">
        <div class="d-flex align-items-center mb-4">
            <i class="bi bi-plus-lg fs-4 text-primary me-2"></i>
            <h4 class="fw-bold mb-0">Tambah Karyawan Baru</h4>
        </div>

        <form action="<?= base_url('karyawan/save') ?>" method="post">

            <div class="mb-3">
                <label class="fw-bold small mb-1">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan nama lengkap"
                    required>
            </div>

            <input type="hidden" name="username" value="user<?= time() ?>">

            <div class="mb-3">
                <label class="fw-bold small mb-1">Jabatan</label>
                <select name="jabatan" class="form-select">
                    <option value="petugas">Petugas</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="fw-bold small mb-1">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="contoh@email.com">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="fw-bold small mb-1">Telepon</label>
                    <input type="text" name="telepon" class="form-control" placeholder="08xxxxxxxx">
                </div>
            </div>

            <div class="mb-4">
                <label class="fw-bold small mb-1">Gaji (Rp)</label>
                <input type="number" name="gaji" class="form-control" placeholder="0">
            </div>

            <div class="row">
                <div class="col-6">
                    <a href="<?= base_url('karyawan') ?>"
                        class="btn btn-cancel text-center text-decoration-none">Batal</a>
                </div>
                <div class="col-6">
                    <button type="submit" class="btn btn-gradient">Simpan</button>
                </div>
            </div>
        </form>
    </div>

</body>

</html>