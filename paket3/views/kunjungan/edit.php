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
    <title>Edit Kunjungan - KlinikAhmadi</title>

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
                    <a class="nav-link"
                       href="index.php?module=pasien&action=index">
                        <i class="bi bi-people"></i> Data Pasien
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active"
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
        <h5 class="fw-bold mb-1">Edit Kunjungan</h5>
        <span class="text-muted">Perbarui informasi kunjungan pasien</span>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="index.php?module=kunjungan&action=update&id=<?= (int) $kunjungan['idkunjungan']; ?>"
                  method="POST">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Pasien</label>

                        <select name="idpasien"
                                class="form-select"
                                required>

                            <option value="">-- Pilih Pasien --</option>

                            <?php while ($row = mysqli_fetch_assoc($dataPasien)) : ?>

                                <option value="<?= (int) $row['idpasien']; ?>"
                                    <?= (int) $kunjungan['idpasien'] === (int) $row['idpasien'] ? 'selected' : ''; ?>>

                                    <?= e($row['namapasien']); ?>

                                </option>

                            <?php endwhile; ?>

                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Kunjungan</label>

                        <input type="date"
                               name="tanggalkunjungan"
                               class="form-control"
                               value="<?= e($kunjungan['tanggalkunjungan']); ?>"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Keluhan</label>

                        <textarea name="keluhan"
                                  class="form-control"
                                  rows="3"><?= e($kunjungan['keluhan']); ?></textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Diagnosis</label>

                        <textarea name="diagnosis"
                                  class="form-control"
                                  rows="3"><?= e($kunjungan['diagnosis']); ?></textarea>
                    </div>

                </div>

                <hr>

                <h6 class="fw-bold mb-3">
                    <i class="bi bi-cash-coin"></i> Informasi Pembayaran
                </h6>

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Total Kunjungan</label>

                        <input type="number"
                               name="totalkunjungan"
                               class="form-control"
                               min="0"
                               value="<?= e($kunjungan['totalkunjungan']); ?>"
                               required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Jumlah Bayar</label>

                        <input type="number"
                               name="jumlahbayar"
                               class="form-control"
                               min="0"
                               value="<?= e($kunjungan['jumlahbayar']); ?>"
                               required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Kembalian</label>

                        <input type="number"
                               name="kembalian"
                               class="form-control"
                               min="0"
                               value="<?= e($kunjungan['kembalian']); ?>"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status Pembayaran</label>

                        <select name="statuspembayaran"
                                class="form-select"
                                required>

                            <option value="Belum Bayar"
                                <?= $kunjungan['statuspembayaran'] === 'Belum Bayar' ? 'selected' : ''; ?>>
                                Belum Bayar
                            </option>

                            <option value="Lunas"
                                <?= $kunjungan['statuspembayaran'] === 'Lunas' ? 'selected' : ''; ?>>
                                Lunas
                            </option>

                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status Kunjungan</label>

                        <select name="statuskunjungan"
                                class="form-select"
                                required>

                            <option value="Proses"
                                <?= $kunjungan['statuskunjungan'] === 'Proses' ? 'selected' : ''; ?>>
                                Proses
                            </option>

                            <option value="Selesai"
                                <?= $kunjungan['statuskunjungan'] === 'Selesai' ? 'selected' : ''; ?>>
                                Selesai
                            </option>

                        </select>
                    </div>

                </div>

                <hr>

                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-save"></i> Perbarui
                </button>

                <a href="index.php?module=kunjungan&action=index"
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
