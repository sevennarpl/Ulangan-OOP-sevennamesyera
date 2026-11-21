<?php
function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pasien - KlinikAhmadi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
          rel="stylesheet">

    <style>
        body {
            font-size: 11px;
            background-color: #f5f6fa;
        }

        .navbar, .btn, .form-control, .form-select, .form-label {
            font-size: 11px;
        }

        .container-fluid {
            padding-left: 18px;
            padding-right: 18px;
        }

        .foto-pasien {
            width: 110px;
            height: 110px;
            object-fit: cover;
            border-radius: 7px;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="index.php?module=pasien&action=index">
            <i class="bi bi-hospital"></i> KlinikAhmadi
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active"
                       href="index.php?module=pasien&action=index">
                        <i class="bi bi-people"></i> Data Pasien
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                       href="index.php?module=kunjungan&action=index">
                        <i class="bi bi-clipboard2-pulse"></i> Data Kunjungan
                    </a>
                </li>
            </ul>

            <span class="navbar-text text-white">
                Aplikasi KlinikAhmadi Paket 3
            </span>
        </div>
    </div>
</nav>

<div class="container-fluid my-4">

    <div class="mb-3">
        <h5 class="fw-bold mb-1">Edit Pasien</h5>
        <span class="text-muted">Perbarui informasi pasien</span>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="index.php?module=pasien&action=update&id=<?= (int) $pasien['idpasien']; ?>"
                  method="POST"
                  enctype="multipart/form-data">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Pasien</label>
                        <input type="text"
                               name="namapasien"
                               class="form-control"
                               maxlength="100"
                               value="<?= e($pasien['namapasien']); ?>"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Username</label>
                        <input type="text"
                               name="username"
                               class="form-control"
                               maxlength="100"
                               value="<?= e($pasien['username']); ?>"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Password Baru</label>
                        <input type="password"
                               name="password"
                               class="form-control">

                        <small class="text-muted">
                            Kosongkan jika tidak ingin mengubah password.
                        </small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Usia</label>
                        <input type="number"
                               name="usia"
                               class="form-control"
                               min="1"
                               value="<?= e($pasien['usia']); ?>"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Alergi Obat</label>
                        <input
                            type="text"
                            name="alergi"
                            class="form-control"
                            maxlength="255"
                            placeholder="Contoh: Mual, Gatal, Bengkak, Sesak Napas"
                            value="<?= e($pasien['alergi']); ?>"
                            required
                        >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jeniskelamin"
                                class="form-select"
                                required>

                            <option value="">-- Pilih Jenis Kelamin --</option>

                            <option value="Laki-laki"
                                <?= $pasien['jeniskelamin'] === 'Laki-laki' ? 'selected' : ''; ?>>
                                Laki-laki
                            </option>

                            <option value="Perempuan"
                                <?= $pasien['jeniskelamin'] === 'Perempuan' ? 'selected' : ''; ?>>
                                Perempuan
                            </option>

                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat"
                                  class="form-control"
                                  rows="3"><?= e($pasien['alamat']); ?></textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nomor HP</label>
                        <input type="text"
                               name="nohp"
                               class="form-control"
                               maxlength="15"
                               value="<?= e($pasien['nohp']); ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label d-block">Foto Saat Ini</label>

                        <img src="assets/images/pasien/<?= e($pasien['foto']); ?>"
                             class="foto-pasien mb-2"
                             alt="Foto pasien">

                        <label class="form-label d-block mt-2">
                            Ganti Foto Pasien
                        </label>

                        <input type="file"
                               name="foto"
                               class="form-control"
                               accept=".jpg,.jpeg,.png,.webp">

                        <small class="text-muted">
                            Kosongkan jika tidak ingin mengganti foto.
                            Maksimal 2 MB.
                        </small>
                    </div>

                </div>

                <hr>

                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-save"></i> Perbarui
                </button>

                <a href="index.php?module=pasien&action=index"
                   class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>

            </form>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
