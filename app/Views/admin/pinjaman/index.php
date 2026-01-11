<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pinjaman - Koperasi Sejahtera</title>
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
    }

    .nav-link {
        color: rgba(255, 255, 255, 0.8);
        margin: 5px 15px;
        border-radius: 8px;
    }

    .nav-link:hover,
    .nav-link.active {
        background: rgba(255, 255, 255, 0.2);
        color: white;
    }

    .main-content {
        margin-left: 280px;
        padding: 30px;
    }

    .stat-card {
        border: none;
        border-radius: 15px;
        transition: transform 0.2s;
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
                <h2 class="fw-bold text-dark mb-0">Data Pinjaman</h2>
                <p class="text-muted mb-0">Kelola pengajuan dan pembayaran pinjaman</p>
            </div>
            <div class="text-end">
                <p class="mb-0 small text-muted">NIM: 2024010001</p>
                <p class="mb-0 fw-bold text-dark">Nama Mahasiswa</p>
            </div>
        </div>

        <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <div class="card card-custom bg-white p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0">Daftar Pinjaman</h4>
                <a href="<?= base_url('pinjaman/create') ?>" class="btn btn-gradient shadow">
                    <i class="bi bi-plus-lg me-2"></i> Buat Pengajuan
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover align-middle">
                    <thead style="border-bottom: 2px solid #4e73df;">
                        <tr>
                            <th>No</th>
                            <th>Anggota</th>
                            <th>Jumlah Pinjaman</th>
                            <th>Tenor</th>
                            <th>Bunga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($pinjaman)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">Belum ada data pinjaman.</td>
                        </tr>
                        <?php else: ?>
                        <?php $no = 1; foreach($pinjaman as $row): ?>
                        <tr style="border-bottom: 1px solid #f0f0f0;">
                            <td><?= $no++ ?></td>
                            <td>
                                <span class="fw-bold"><?= $row['nama_lengkap'] ?></span>
                            </td>
                            <td class="fw-bold text-primary">Rp
                                <?= number_format($row['jumlah_pinjaman'], 0, ',', '.') ?></td>
                            <td><?= $row['tenor_bulan'] ?> Bulan</td>
                            <td><?= $row['bunga_persen'] ?>%</td>
                            <td>
                                <?php 
                                    // Logika Badge Warna Status
                                    $badgeClass = 'bg-secondary';
                                    $statusLabel = ucfirst($row['status']);
                                    
                                    if($row['status'] == 'pending') {
                                        $badgeClass = 'bg-warning text-dark';
                                    } elseif($row['status'] == 'disetujui') {
                                        $badgeClass = 'bg-success';
                                    } elseif($row['status'] == 'lunas') {
                                        $badgeClass = 'bg-primary';
                                    } elseif($row['status'] == 'ditolak') {
                                        $badgeClass = 'bg-danger';
                                    }
                                ?>
                                <span class="badge rounded-pill <?= $badgeClass ?> px-3 py-2">
                                    <?= $statusLabel ?>
                                </span>
                            </td>
                            <td>
                                <a href="<?= base_url('pinjaman/detail/'.$row['id_pinjaman']) ?>"
                                    class="btn btn-sm btn-outline-primary fw-bold">
                                    <i class="bi bi-eye-fill me-1"></i> Detail & Bayar
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <footer class="mt-5 text-center text-muted small">
            <p>&copy; 2024 Koperasi Sejahtera Bersama. All rights reserved.</p>
        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>