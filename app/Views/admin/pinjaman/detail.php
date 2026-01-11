<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Pinjaman - Koperasi Sejahtera</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
    body {
        background-color: #f3f4f6;
        font-family: 'Segoe UI', sans-serif;
    }

    /* Sidebar Styling (Sesuai Gambar Kamu) */
    .sidebar {
        width: 280px;
        height: 100vh;
        background: #2563eb;
        color: white;
        position: fixed;
        z-index: 100;
    }

    .nav-link {
        color: rgba(255, 255, 255, 0.8);
        margin: 5px 15px;
        border-radius: 8px;
    }

    .nav-link:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
    }

    .main-content {
        margin-left: 280px;
        padding: 30px;
    }

    /* Card Custom Styling */
    .card-fresh {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        background: white;
        overflow: hidden;
    }

    .card-header-fresh {
        background: white;
        border-bottom: 1px solid #f0f0f0;
        padding: 20px 25px;
        font-weight: 700;
        color: #333;
        display: flex;
        align-items: center;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px dashed #eee;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .label-text {
        color: #6b7280;
        font-size: 0.9rem;
    }

    .value-text {
        font-weight: 600;
        color: #1f2937;
    }

    /* Button Gradients */
    .btn-approve {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border: none;
        color: white;
        font-weight: 600;
        padding: 12px;
        border-radius: 10px;
        width: 100%;
        transition: transform 0.2s;
    }

    .btn-approve:hover {
        transform: translateY(-2px);
        color: white;
        box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
    }

    .btn-pay {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        border: none;
        color: white;
        font-weight: 600;
        padding: 12px;
        border-radius: 10px;
        width: 100%;
    }

    .btn-pay:hover {
        color: white;
        box-shadow: 0 5px 15px rgba(37, 99, 235, 0.3);
    }

    /* Status Badge */
    .badge-status {
        padding: 8px 15px;
        border-radius: 30px;
        font-size: 0.85rem;
    }
    </style>
</head>

<body>

    <div class="sidebar p-3">
        <div class="d-flex align-items-center mb-4 px-2 mt-3">
            <i class="bi bi-bank2 fs-2 me-3"></i>
            <div>
                <h6 class="mb-0 fw-bold">Koperasi Sejahtera</h6>
                <small style="opacity: 0.8;">Detail Transaksi</small>
            </div>
        </div>
        <ul class="nav nav-pills flex-column mb-auto">
            <li><a href="<?= base_url('dashboard') ?>" class="nav-link"><i class="bi bi-grid-1x2-fill me-3"></i>
                    Dashboard</a></li>
            <li><a href="<?= base_url('pinjaman') ?>" class="nav-link text-white fw-bold"
                    style="background: rgba(255,255,255,0.2);"><i class="bi bi-arrow-left-circle me-3"></i> Kembali</a>
            </li>
        </ul>
    </div>

    <div class="main-content">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-0">Detail Pinjaman</h3>
                <p class="text-muted">Informasi lengkap status dan riwayat pembayaran</p>
            </div>

            <?php 
                $statusColor = 'bg-secondary';
                if($pinjaman['status'] == 'pending') $statusColor = 'bg-warning text-dark';
                if($pinjaman['status'] == 'disetujui') $statusColor = 'bg-success';
                if($pinjaman['status'] == 'lunas') $statusColor = 'bg-primary';
            ?>
            <span class="badge <?= $statusColor ?> badge-status shadow-sm">
                Status: <?= ucfirst($pinjaman['status']) ?>
            </span>
        </div>

        <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success border-0 shadow-sm mb-4">
            <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('success') ?>
        </div>
        <?php endif; ?>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="card card-fresh h-100">
                    <div class="card-header-fresh">
                        <i class="bi bi-person-vcard-fill text-primary me-2 fs-5"></i> Data Peminjam
                    </div>
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex justify-content-center align-items-center"
                                style="width: 80px; height: 80px;">
                                <i class="bi bi-person-fill fs-1"></i>
                            </div>
                            <h5 class="fw-bold mt-3 mb-0"><?= $pinjaman['nama_lengkap'] ?></h5>
                            <small class="text-muted">NIK: <?= $pinjaman['nik'] ?></small>
                        </div>

                        <div class="info-row"><span class="label-text">No. Telepon</span> <span
                                class="value-text"><?= $pinjaman['no_telp'] ?? '-' ?></span></div>
                        <div class="info-row"><span class="label-text">Tanggal Pengajuan</span> <span
                                class="value-text"><?= date('d M Y', strtotime($pinjaman['tanggal_pengajuan'])) ?></span>
                        </div>

                        <?php if($pinjaman['status'] == 'pending'): ?>
                        <div class="mt-4 pt-3 border-top">
                            <div
                                class="alert alert-warning small border-0 bg-warning bg-opacity-10 text-warning-emphasis">
                                <i class="bi bi-exclamation-circle me-1"></i> Pinjaman ini menunggu persetujuan.
                            </div>
                            <a href="<?= base_url('pinjaman/approve/'.$pinjaman['id_pinjaman']) ?>"
                                class="btn btn-approve"
                                onclick="return confirm('Apakah Anda yakin menyetujui pinjaman ini?')">
                                <i class="bi bi-check-lg me-2"></i> Setujui Pinjaman
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-fresh h-100">
                    <div class="card-header-fresh">
                        <i class="bi bi-wallet2 text-success me-2 fs-5"></i> Rincian Pinjaman
                    </div>
                    <div class="card-body p-4">
                        <div class="p-3 bg-light rounded-3 mb-3 text-center">
                            <small class="text-muted d-block">Total Pokok Pinjaman</small>
                            <h3 class="fw-bold text-success mb-0">Rp
                                <?= number_format($pinjaman['jumlah_pinjaman'], 0, ',', '.') ?></h3>
                        </div>

                        <div class="info-row"><span class="label-text">Bunga</span> <span
                                class="value-text"><?= $pinjaman['bunga_persen'] ?>%</span></div>
                        <div class="info-row"><span class="label-text">Tenor (Jangka Waktu)</span> <span
                                class="value-text"><?= $pinjaman['tenor_bulan'] ?> Bulan</span></div>
                        <div class="info-row"><span class="label-text">Cicilan per Bulan (Est)</span>
                            <span class="value-text text-primary">
                                <?php 
                                    $pokok = $pinjaman['jumlah_pinjaman'];
                                    $bunga = ($pokok * ($pinjaman['bunga_persen']/100)); // Bunga flat sederhana (opsional)
                                    $total = $pokok + $bunga;
                                    $cicilan = $total / $pinjaman['tenor_bulan'];
                                    echo "Rp " . number_format($cicilan, 0, ',', '.');
                                ?>
                            </span>
                        </div>
                        <div class="info-row"><span class="label-text">Keperluan</span> <span
                                class="value-text"><?= $pinjaman['keterangan'] ?></span></div>

                        <?php if($pinjaman['status'] == 'disetujui'): ?>
                        <div class="mt-4 pt-3 border-top">
                            <h6 class="fw-bold mb-3"><i class="bi bi-cash-coin me-2"></i> Input Pembayaran</h6>
                            <form action="<?= base_url('pinjaman/bayarAngsuran') ?>" method="post">
                                <input type="hidden" name="id_pinjaman" value="<?= $pinjaman['id_pinjaman'] ?>">
                                <input type="hidden" name="id_user" value="<?= $pinjaman['id_user'] ?>">

                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-light border-end-0">Rp</span>
                                    <input type="number" name="jumlah_bayar" class="form-control border-start-0 ps-0"
                                        placeholder="0" required>
                                </div>
                                <button type="submit" class="btn btn-pay">Bayar Angsuran</button>
                            </form>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-fresh h-100">
                    <div class="card-header-fresh">
                        <i class="bi bi-clock-history text-info me-2 fs-5"></i> Riwayat Angsuran
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4 py-3">Ke</th>
                                        <th class="py-3">Tanggal</th>
                                        <th class="py-3 pe-4 text-end">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(empty($angsuran)): ?>
                                    <tr>
                                        <td colspan="3" class="text-center py-5 text-muted small">
                                            <i class="bi bi-receipt fs-1 d-block mb-2 opacity-25"></i>
                                            Belum ada pembayaran
                                        </td>
                                    </tr>
                                    <?php else: ?>
                                    <?php $totalBayar = 0; foreach($angsuran as $row): ?>
                                    <tr>
                                        <td class="ps-4 fw-bold">#<?= $row['angsuran_ke'] ?></td>
                                        <td class="small"><?= date('d/m/y', strtotime($row['tanggal_bayar'])) ?></td>
                                        <td class="pe-4 text-end fw-bold text-success">
                                            + <?= number_format($row['jumlah_bayar'], 0, ',', '.') ?>
                                        </td>
                                    </tr>
                                    <?php $totalBayar += $row['jumlah_bayar']; endforeach; ?>

                                    <tr class="table-light">
                                        <td colspan="2" class="ps-4 fw-bold py-3">Total Terbayar</td>
                                        <td class="pe-4 text-end fw-bold text-primary py-3">
                                            Rp <?= number_format($totalBayar, 0, ',', '.') ?>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>