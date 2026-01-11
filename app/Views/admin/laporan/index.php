<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan - Koperasi Sejahtera</title>
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

    /* Card Styling */
    .card-fresh {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        background: white;
        overflow: hidden;
    }

    /* Summary Cards */
    .card-summary {
        border: none;
        border-radius: 16px;
        padding: 20px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .bg-gradient-blue {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    }

    .bg-gradient-green {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }

    /* Tabs Styling */
    .nav-tabs {
        border-bottom: 2px solid #f3f4f6;
    }

    .nav-tabs .nav-link {
        border: none;
        color: #6b7280;
        font-weight: 600;
        padding: 15px 25px;
        border-bottom: 3px solid transparent;
    }

    .nav-tabs .nav-link.active {
        color: #2563eb;
        background: none;
        border-bottom: 3px solid #2563eb;
    }

    .nav-tabs .nav-link:hover {
        border-color: transparent;
        color: #2563eb;
    }

    /* Print CSS */
    @media print {

        .sidebar,
        .btn-print,
        .nav-tabs,
        .no-print {
            display: none !important;
        }

        .main-content {
            margin-left: 0 !important;
            padding: 0 !important;
        }

        .card-fresh {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
        }

        .tab-pane {
            display: block !important;
            opacity: 1 !important;
            margin-bottom: 30px;
        }

        body {
            background-color: white !important;
        }
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
                <h3 class="fw-bold text-dark mb-0">Laporan Transaksi</h3>
                <p class="text-muted mb-0">Rekapitulasi keuangan koperasi</p>
            </div>
            <button onclick="window.print()" class="btn btn-primary btn-print shadow-sm">
                <i class="bi bi-printer-fill me-2"></i> Cetak Laporan
            </button>
        </div>

        <?php 
            $totalSimpanan = 0;
            foreach($simpanan as $s) $totalSimpanan += $s['jumlah'];

            $totalPinjaman = 0;
            foreach($pinjaman as $p) {
                // Hitung total pinjaman yang disetujui saja
                if($p['status'] == 'disetujui' || $p['status'] == 'lunas') {
                    $totalPinjaman += $p['jumlah_pinjaman'];
                }
            }
        ?>

        <div class="row mb-4 no-print">
            <div class="col-md-6">
                <div class="card-summary bg-gradient-green shadow-sm">
                    <h5 class="mb-1 opacity-75">Total Simpanan Masuk</h5>
                    <h2 class="fw-bold mb-0">Rp <?= number_format($totalSimpanan, 0, ',', '.') ?></h2>
                    <i class="bi bi-wallet2 position-absolute"
                        style="font-size: 5rem; right: -10px; bottom: -20px; opacity: 0.2;"></i>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-summary bg-gradient-blue shadow-sm">
                    <h5 class="mb-1 opacity-75">Total Pinjaman Disalurkan</h5>
                    <h2 class="fw-bold mb-0">Rp <?= number_format($totalPinjaman, 0, ',', '.') ?></h2>
                    <i class="bi bi-cash-stack position-absolute"
                        style="font-size: 5rem; right: -10px; bottom: -20px; opacity: 0.2;"></i>
                </div>
            </div>
        </div>

        <div class="card card-fresh">

            <ul class="nav nav-tabs px-3 pt-2" id="reportTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="simpanan-tab" data-bs-toggle="tab" data-bs-target="#simpanan"
                        type="button" role="tab">
                        <i class="bi bi-piggy-bank me-2"></i> Laporan Simpanan
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pinjaman-tab" data-bs-toggle="tab" data-bs-target="#pinjaman"
                        type="button" role="tab">
                        <i class="bi bi-cash-coin me-2"></i> Laporan Pinjaman
                    </button>
                </li>
            </ul>

            <div class="card-body p-4">
                <div class="tab-content" id="reportTabContent">

                    <div class="tab-pane fade show active" id="simpanan" role="tabpanel">
                        <h5 class="fw-bold mb-3 d-none d-print-block">Detail Laporan Simpanan</h5>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Anggota</th>
                                        <th>Jenis</th>
                                        <th>Keterangan</th>
                                        <th class="text-end">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($simpanan as $row): ?>
                                    <tr>
                                        <td><?= date('d/m/Y', strtotime($row['tanggal_transaksi'])) ?></td>
                                        <td>
                                            <span class="fw-bold"><?= $row['nama_lengkap'] ?></span><br>
                                            <small class="text-muted"><?= $row['nik'] ?></small>
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-light text-dark border"><?= ucfirst($row['jenis_simpanan']) ?></span>
                                        </td>
                                        <td class="small text-muted"><?= $row['keterangan'] ?: '-' ?></td>
                                        <td class="text-end fw-bold">Rp
                                            <?= number_format($row['jumlah'], 0, ',', '.') ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <td colspan="4" class="text-end fw-bold py-3">TOTAL KESELURUHAN</td>
                                        <td class="text-end fw-bold text-success py-3">Rp
                                            <?= number_format($totalSimpanan, 0, ',', '.') ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pinjaman" role="tabpanel">
                        <h5 class="fw-bold mb-3 d-none d-print-block">Detail Laporan Pinjaman</h5>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tgl Pengajuan</th>
                                        <th>Anggota</th>
                                        <th>Tenor</th>
                                        <th>Bunga</th>
                                        <th>Status</th>
                                        <th class="text-end">Jumlah Pinjaman</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($pinjaman as $row): ?>
                                    <tr>
                                        <td><?= date('d/m/Y', strtotime($row['tanggal_pengajuan'])) ?></td>
                                        <td>
                                            <span class="fw-bold"><?= $row['nama_lengkap'] ?></span><br>
                                            <small class="text-muted"><?= $row['nik'] ?></small>
                                        </td>
                                        <td><?= $row['tenor_bulan'] ?> Bulan</td>
                                        <td><?= $row['bunga_persen'] ?>%</td>
                                        <td>
                                            <?php 
                                                $bg = 'bg-secondary';
                                                if($row['status']=='disetujui') $bg = 'bg-success';
                                                if($row['status']=='pending') $bg = 'bg-warning text-dark';
                                                if($row['status']=='lunas') $bg = 'bg-primary';
                                                if($row['status']=='ditolak') $bg = 'bg-danger';
                                            ?>
                                            <span
                                                class="badge <?= $bg ?> rounded-pill"><?= ucfirst($row['status']) ?></span>
                                        </td>
                                        <td class="text-end fw-bold">Rp
                                            <?= number_format($row['jumlah_pinjaman'], 0, ',', '.') ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <td colspan="5" class="text-end fw-bold py-3">TOTAL YANG DISETUJUI/CAIR</td>
                                        <td class="text-end fw-bold text-primary py-3">Rp
                                            <?= number_format($totalPinjaman, 0, ',', '.') ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="mt-4 text-center text-muted small no-print">
            &copy; 2024 Koperasi Sejahtera Bersama
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>