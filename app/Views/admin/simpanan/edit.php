<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Simpanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #f3f4f6;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card-form {
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 500px;
        padding: 30px;
    }
    </style>
</head>

<body>

    <div class="card-form">
        <h4 class="fw-bold mb-4">Edit Data Simpanan</h4>

        <div class="alert alert-light border mb-4">
            <small class="text-muted d-block">Nama Anggota:</small>
            <strong><?= $nama_anggota ?></strong>
        </div>

        <form action="<?= base_url('simpanan/update/' . $simpanan['id_simpanan']) ?>" method="post">

            <div class="mb-3">
                <label class="form-label fw-bold small">Jenis Simpanan</label>
                <select name="jenis_simpanan" class="form-select">
                    <option value="pokok" <?= $simpanan['jenis_simpanan'] == 'pokok' ? 'selected' : '' ?>>Simpanan Pokok
                    </option>
                    <option value="wajib" <?= $simpanan['jenis_simpanan'] == 'wajib' ? 'selected' : '' ?>>Simpanan Wajib
                    </option>
                    <option value="sukarela" <?= $simpanan['jenis_simpanan'] == 'sukarela' ? 'selected' : '' ?>>Simpanan
                        Sukarela</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold small">Jumlah (Rp)</label>
                <input type="number" name="jumlah" class="form-control" value="<?= $simpanan['jumlah'] ?>" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold small">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="2"><?= $simpanan['keterangan'] ?></textarea>
            </div>

            <div class="row g-2">
                <div class="col-6">
                    <a href="<?= base_url('simpanan') ?>"
                        class="btn btn-light w-100 border fw-bold text-secondary">Batal</a>
                </div>
                <div class="col-6">
                    <button type="submit" class="btn btn-primary w-100 fw-bold">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>

</body>

</html>