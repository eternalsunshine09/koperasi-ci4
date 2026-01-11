<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pengajuan Pinjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
    /* Style Background Gelap Transparan (Efek Modal) */
    body {
        background-color: rgba(0, 0, 0, 0.05);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', sans-serif;
        padding: 20px;
    }

    /* Kartu Form */
    .card-form {
        background: white;
        width: 100%;
        max-width: 600px;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .form-control,
    .form-select {
        border-radius: 10px;
        padding: 12px;
        border: 1px solid #dee2e6;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .btn-simpan {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        border: none;
        color: white;
        padding: 12px;
        border-radius: 10px;
        font-weight: 600;
        width: 100%;
        transition: all 0.2s;
    }

    .btn-simpan:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(37, 99, 235, 0.3);
        color: white;
    }

    .btn-batal {
        background: #f1f5f9;
        color: #64748b;
        border: none;
        padding: 12px;
        border-radius: 10px;
        font-weight: 600;
        width: 100%;
        display: block;
        text-align: center;
        text-decoration: none;
    }

    .btn-batal:hover {
        background: #e2e8f0;
        color: #475569;
    }

    .section-title {
        color: #1e293b;
        font-weight: 700;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }
    </style>
</head>

<body>

    <div class="card-form">
        <h4 class="section-title">
            <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3 text-primary">
                <i class="bi bi-file-earmark-plus-fill"></i>
            </div>
            Form Pengajuan Pinjaman
        </h4>

        <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger py-2 small">
            <?= session()->getFlashdata('error') ?>
        </div>
        <?php endif; ?>

        <form action="<?= base_url('pinjaman/save') ?>" method="post">

            <div class="mb-4">
                <label class="fw-bold small mb-1 text-muted">Data Peminjam</label>
                <select name="id_user" class="form-select" required>
                    <option value="" selected disabled>-- Pilih Anggota --</option>
                    <?php foreach($anggota as $usr): ?>
                    <option value="<?= $usr['id_user'] ?>">
                        <?= $usr['nama_lengkap'] ?> (NIK: <?= $usr['nik'] ?>)
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="fw-bold small mb-1 text-muted">Jumlah Pinjaman (Rp)</label>
                    <input type="number" name="jumlah" class="form-control" placeholder="Contoh: 5000000" min="10000"
                        required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="fw-bold small mb-1 text-muted">Bunga (%)</label>
                    <input type="number" name="bunga" class="form-control" placeholder="Contoh: 2.5" step="0.1"
                        required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="fw-bold small mb-1 text-muted">Jangka Waktu (Bulan)</label>
                    <input type="number" name="tenor" class="form-control" placeholder="Contoh: 12" min="1" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="fw-bold small mb-1 text-muted">Keterangan / Keperluan</label>
                <textarea name="keterangan" class="form-control" rows="2"
                    placeholder="Contoh: Modal usaha warung..."></textarea>
            </div>

            <div class="row g-2">
                <div class="col-6">
                    <a href="<?= base_url('pinjaman') ?>" class="btn-batal">Batal</a>
                </div>
                <div class="col-6">
                    <button type="submit" class="btn-simpan">Ajukan</button>
                </div>
            </div>

        </form>
    </div>

</body>

</html>