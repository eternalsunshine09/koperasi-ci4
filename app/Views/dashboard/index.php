<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard' ?> - Koperasi Sejahtera</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
    :root {
        --primary-color: #3b71db;
        --sidebar-width: 280px;
    }

    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Sidebar Styling */
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

    /* Main Content Styling */
    .main-content {
        margin-left: var(--sidebar-width);
        padding: 30px;
    }

    /* Card Styling */
    .stat-card {
        border: none;
        border-radius: 15px;
        transition: transform 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .icon-box {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 15px;
    }

    /* Utility Colors */
    .bg-soft-green {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .bg-soft-blue {
        background: #e3f2fd;
        color: #1565c0;
    }

    .bg-soft-orange {
        background: #fff3e0;
        color: #ef6c00;
    }

    .bg-soft-purple {
        background: #f3e5f5;
        color: #7b1fa2;
    }

    /* Hover Effect for Action Cards */
    .hover-scale {
        transition: transform 0.2s;
    }

    .hover-scale:hover {
        transform: translateY(-5px);
        filter: brightness(1.05);
    }
    </style>
</head>

<body>

    <div class="sidebar d-flex flex-column p-3">
        <div class="d-flex align-items-center mb-4 px-2">
            <i class="bi bi-bank2 fs-2 me-2"></i>
            <div>
                <h5 class="mb-0 fw-bold">Koperasi Sejahtera</h5>
                <small style="font-size: 0.7rem; opacity: 0.8;">Bersama Membangun Kesejahteraan</small>
            </div>
        </div>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="<?= base_url('dashboard') ?>" class="nav-link active"> <i class="bi bi-grid-1x2-fill me-2"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="<?= base_url('anggota') ?>" class="nav-link text-white">
                    <i class="bi bi-people-fill me-2"></i> Data Anggota
                </a>
            </li>
            <li>
                <a href="<?= base_url('karyawan') ?>" class="nav-link text-white">
                    <i class="bi bi-person-badge-fill me-2"></i> Data Karyawan
                </a>
            </li>

            <li class="mt-2 mb-1 ms-3 text-white-50 small fw-bold">KEUANGAN</li>
            <li>
                <a href="<?= base_url('simpanan') ?>" class="nav-link text-white">
                    <i class="bi bi-piggy-bank-fill me-2"></i> Simpanan
                </a>
            </li>
            <li>
                <a href="<?= base_url('pinjaman') ?>" class="nav-link text-white">
                    <i class="bi bi-cash-stack me-2"></i> Pinjaman
                </a>
            </li>
            <li class="mt-2 mb-1 ms-3 text-white-50 small fw-bold">LAINNYA</li>
            <li>
                <a href="<?= base_url('laporan') ?>" class="nav-link text-white">
                    <i class="bi bi-file-earmark-bar-graph-fill me-2"></i> Laporan
                </a>
            </li>
        </ul>
        <hr>
        <div class="px-3 mb-3">
            <div class="d-flex align-items-center mb-3">
                <div class="bg-light rounded-circle p-2 me-2 text-dark">
                    <i class="bi bi-person-fill"></i>
                </div>
                <div>
                    <p class="mb-0 fw-bold small"><?= session()->get('nama_lengkap') ?></p>
                    <p class="mb-0 text-white-50 small" style="font-size: 0.7rem;"><?= session()->get('role') ?></p>
                </div>
            </div>
            <a href="<?= base_url('logout') ?>" class="btn btn-light w-100 btn-sm fw-bold shadow-sm">Keluar</a>
        </div>
    </div>


    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-0">Dashboard</h2>
                <p class="text-muted">Selamat datang kembali!</p>
            </div>
            <div class="text-end">
                <p class="mb-0 small text-muted">NIM: 2024010001</p>
                <p class="mb-0 fw-bold">Nama Mahasiswa</p>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card stat-card shadow-sm p-3 border-0">
                    <div class="d-flex justify-content-between">
                        <div class="icon-box bg-soft-green"><i class="bi bi-cash-coin fs-4"></i></div>
                        <span class="badge bg-success-subtle text-success align-self-start">Simpanan</span>
                    </div>
                    <h3 class="fw-bold">Rp <?= number_format($total_simpanan, 0, ',', '.') ?></h3>
                    <p class="text-muted small">Total Simpanan</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card stat-card shadow-sm p-3 border-0">
                    <div class="d-flex justify-content-between">
                        <div class="icon-box bg-soft-blue"><i class="bi bi-wallet2 fs-4"></i></div>
                        <span class="badge bg-primary-subtle text-primary align-self-start">Pinjaman</span>
                    </div>
                    <h3 class="fw-bold">Rp <?= number_format($total_pinjaman, 0, ',', '.') ?></h3>
                    <p class="text-muted small">Total Pinjaman Cair</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card stat-card shadow-sm p-3 border-0">
                    <div class="d-flex justify-content-between">
                        <div class="icon-box bg-soft-orange"><i class="bi bi-hourglass-split fs-4"></i></div>
                        <span class="badge bg-warning-subtle text-warning align-self-start">Aktif</span>
                    </div>
                    <h3 class="fw-bold">Rp <?= number_format($pinjaman_berjalan, 0, ',', '.') ?></h3>
                    <p class="text-muted small">Pinjaman Berjalan</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card stat-card shadow-sm p-3 border-0">
                    <div class="d-flex justify-content-between">
                        <div class="icon-box bg-soft-purple"><i class="bi bi-people-fill fs-4"></i></div>
                        <span class="badge bg-info-subtle text-info align-self-start">Anggota</span>
                    </div>
                    <h3 class="fw-bold"><?= $total_anggota ?></h3>
                    <p class="text-muted small">Total Anggota</p>
                </div>
            </div>
        </div>

        <h5 class="fw-bold mb-3">Akses Cepat</h5>
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <a href="<?= base_url('simpanan/create') ?>" class="text-decoration-none">
                    <div class="card border-0 shadow-sm p-4 text-center hover-scale"
                        style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white; border-radius: 15px;">
                        <i class="bi bi-plus-circle-fill fs-1 mb-2"></i>
                        <h5 class="fw-bold">Tambah Simpanan</h5>
                        <p class="small opacity-75 mb-0">Input setoran tunai anggota</p>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="<?= base_url('pinjaman/create') ?>" class="text-decoration-none">
                    <div class="card border-0 shadow-sm p-4 text-center hover-scale"
                        style="background: linear-gradient(135deg, #007bff 0%, #6610f2 100%); color: white; border-radius: 15px;">
                        <i class="bi bi-file-earmark-plus-fill fs-1 mb-2"></i>
                        <h5 class="fw-bold">Ajukan Pinjaman</h5>
                        <p class="small opacity-75 mb-0">Buat pengajuan pinjaman baru</p>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="<?= base_url('pinjaman') ?>" class="text-decoration-none">
                    <div class="card border-0 shadow-sm p-4 text-center hover-scale"
                        style="background: linear-gradient(135deg, #fd7e14 0%, #f76707 100%); color: white; border-radius: 15px;">
                        <i class="bi bi-wallet-fill fs-1 mb-2"></i>
                        <h5 class="fw-bold">Bayar Angsuran</h5>
                        <p class="small opacity-75 mb-0">Cek pinjaman aktif & bayar</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="card border-0 shadow-sm p-4 rounded-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">Aktivitas Terbaru</h5>
                <a href="<?= base_url('laporan') ?>" class="text-decoration-none small">Lihat Semua →</a>
            </div>
            <div class="text-center py-5 text-muted">
                <i class="bi bi-clipboard-data fs-1 opacity-25"></i>
                <p>Belum ada aktivitas transaksi hari ini.</p>
            </div>
        </div>

        <footer class="mt-5 text-center text-muted small">
            <p>© 2024 Koperasi Sejahtera Bersama<br>Dikembangkan oleh Nama Mahasiswa (2024010001)</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>