<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Tambah Simpanan' ?> - Koperasi Sejahtera</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
    :root {
        --primary-color: #3b71db;
        --sidebar-width: 280px;
    }

    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', sans-serif;
    }

    /* Sidebar (Sama seperti Dashboard) */
    .sidebar {
        width: var(--sidebar-width);
        height: 100vh;
        background: var(--primary-color);
        color: white;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
    }

    .nav-link {
        color: rgba(255, 255, 255, 0.8);
        margin: 5px 15px;
        border-radius: 8px;
        transition: all 0.2s;
    }

    .nav-link:hover,
    .nav-link.active {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        font-weight: 500;
    }

    .main-content {
        margin-left: var(--sidebar-width);
        padding: 30px;
    }

    /* Form Styling */
    .form-label {
        font-weight: 600;
        font-size: 0.9rem;
        color: #555;
    }

    .form-control,
    .form-select {
        padding: 0.7rem 1rem;
        border-radius: 8px;
        border: 1px solid #dee2e6;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(59, 113, 219, 0.15);
    }
    </style>
</head>

<body>

    <div class="sidebar d-flex flex-column p-3">
        <div class="d-flex align-items-center mb-4 px-2">
            <i class="bi bi-bank2 fs-2 me-2"></i>
            <div>
                <h6 class="mb-0 fw-bold">Koperasi Sejahtera</h6>
                <small style="font-size: 0.7rem; opacity: 0.8;">Admin Panel</small>
            </div>
        </div>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <?php $uri = service('uri'); ?>
            <li class="nav-item"><a href="<?= base_url('dashboard') ?>" class="nav-link"><i
                        class="bi bi-grid-1x2-fill me-2"></i> Dashboard</a></li>
            <li><a href="<?= base_url('anggota') ?>" class="nav-link"><i class="bi bi-people-fill me-2"></i> Data
                    Anggota</a></li>

            <li class="mt-2 mb-1 ms-3 text-white-50 small fw-bold">KEUANGAN</li>
            <li><a href="<?= base_url('simpanan') ?>" class="nav-link active"><i class="bi bi-piggy-bank-fill me-2"></i>
                    Simpanan</a></li>
            <li><a href="<?= base_url('pinjaman') ?>" class="nav-link"><i class="bi bi-cash-stack me-2"></i>
                    Pinjaman</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-0">Input Setoran Simpanan</h3>
                <p class="text-muted small">Catat transaksi setoran baru anggota</p>
            </div>
            <a href="<?= base_url('simpanan') ?>" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">

                        <form action="<?= base_url('simpanan/store') ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="mb-4">
                                <label for="id_user" class="form-label">Pilih Anggota</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i
                                            class="bi bi-person"></i></span>
                                    <select name="id_user" id="id_user" class="form-select border-start-0 ps-0"
                                        required>
                                        <option value="" selected disabled>-- Cari Nama Anggota --</option>
                                        <?php if(!empty($anggota)) : ?>
                                        <?php foreach($anggota as $user) : ?>
                                        <option value="<?= $user['id_user'] ?>">
                                            <?= $user['nama_lengkap'] ?> (NIK: <?= $user['nik'] ?>)
                                        </option>
                                        <?php endforeach; ?>
                                        <?php else : ?>
                                        <option disabled>Tidak ada data anggota aktif</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="jenis_simpanan" class="form-label">Jenis Simpanan</label>
                                    <select name="jenis_simpanan" id="jenis_simpanan" class="form-select" required>
                                        <option value="pokok">Simpanan Pokok</option>
                                        <option value="wajib" selected>Simpanan Wajib</option>
                                        <option value="sukarela">Simpanan Sukarela</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="jumlah" class="form-label">Jumlah Setoran (Rp)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">Rp</span>
                                        <input type="number" name="jumlah" id="jumlah" class="form-control"
                                            placeholder="0" min="1000" required>
                                    </div>
                                    <small class="text-muted d-none" id="terbilangHelper">Nominal...</small>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="keterangan" class="form-label">Keterangan (Opsional)</label>
                                <textarea name="keterangan" id="keterangan" rows="3" class="form-control"
                                    placeholder="Contoh: Setoran bulan Januari 2026"></textarea>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success fw-bold py-2"
                                    style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border:none;">
                                    <i class="bi bi-save me-2"></i> Simpan Transaksi
                                </button>
                                <a href="<?= base_url('simpanan') ?>" class="btn btn-light text-muted py-2">Batal</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>