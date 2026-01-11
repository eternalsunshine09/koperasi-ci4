<!DOCTYPE html>
<html lang="id">

<head>
    <title>Data Simpanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
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

    .btn-gradient {
        background: linear-gradient(135deg, #4e73df 0%, #6f42c1 100%);
        color: white;
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
        <div class="d-flex justify-content-between mb-4">
            <h3>Riwayat Simpanan</h3>
            <a href="<?= base_url('simpanan/create') ?>" class="btn btn-gradient">+ Setor Simpanan</a>
        </div>

        <div class="card p-3 shadow-sm border-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Anggota</th>
                        <th>Tanggal</th>
                        <th>Jenis Simpanan</th>
                        <th>Jumlah (Rp)</th>
                        <th>Keterangan</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($simpanan as $row): ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-initial">
                                    <?= substr($row['nama_lengkap'], 0, 1) ?>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark"><?= $row['nama_lengkap'] ?></div>
                                    <small class="text-muted" style="font-size: 0.75rem;">NIK:
                                        <?= $row['nik'] ?></small>
                                </div>
                            </div>
                        </td>
                        <td class="text-muted"><?= date('d M Y', strtotime($row['tanggal_transaksi'])) ?></td>
                        <td>
                            <?php 
                                    $bg = 'bg-secondary';
                                    if($row['jenis_simpanan'] == 'pokok') $bg = 'bg-primary';
                                    if($row['jenis_simpanan'] == 'wajib') $bg = 'bg-success';
                                    if($row['jenis_simpanan'] == 'sukarela') $bg = 'bg-info text-dark';
                                ?>
                            <span class="badge <?= $bg ?> rounded-pill px-3 py-2 fw-normal">
                                <?= ucfirst($row['jenis_simpanan']) ?>
                            </span>
                        </td>
                        <td class="fw-bold text-dark">Rp <?= number_format($row['jumlah'], 0, ',', '.') ?></td>
                        <td class="text-muted small"><?= $row['keterangan'] ?: '-' ?></td>
                        <td class="text-end pe-4">
                            <a href="<?= base_url('simpanan/edit/'.$row['id_simpanan']) ?>"
                                class="btn btn-sm btn-light text-primary border me-1">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <a href="<?= base_url('simpanan/delete/'.$row['id_simpanan']) ?>"
                                class="btn btn-sm btn-light text-danger border"
                                onclick="return confirm('Yakin ingin menghapus data ini?')">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>