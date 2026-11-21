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
    <title>Detail Kunjungan - KlinikAhmadi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
          rel="stylesheet">

    <style>
        body {
            font-size: 11px;
            background-color: #f5f6fa;
        }

        .navbar, .btn, .table {
            font-size: 11px;
        }

        .container-fluid {
            padding-left: 18px;
            padding-right: 18px;
        }

        .table th {
            width: 190px;
        }

        .table th, .table td {
            padding: 8px;
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

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h5 class="fw-bold mb-1">Detail Kunjungan</h5>
            <span class="text-muted">Informasi lengkap riwayat kunjungan pasien</span>
        </div>

        <a href="index.php?module=kunjungan&action=index"
           class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm mb-3">
        <div class="card-header bg-primary text-white fw-bold">
            <i class="bi bi-clipboard2-pulse"></i> Informasi Kunjungan
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered mb-0">

                    <tr>
                        <th class="table-light">ID Kunjungan</th>
                        <td><?= (int) $kunjungan['idkunjungan']; ?></td>
                    </tr>

                    <tr>
                        <th class="table-light">Nama Pasien</th>
                        <td><?= e($kunjungan['namapasien']); ?></td>
                    </tr>

                    <tr>
                        <th class="table-light">Tanggal Kunjungan</th>
                        <td><?= e($kunjungan['tanggalkunjungan']); ?></td>
                    </tr>

                    <tr>
                        <th class="table-light">Keluhan</th>
                        <td><?= nl2br(e($kunjungan['keluhan'])); ?></td>
                    </tr>

                    <tr>
                        <th class="table-light">Diagnosis</th>
                        <td><?= nl2br(e($kunjungan['diagnosis'])); ?></td>
                    </tr>

                    <tr>
                        <th class="table-light">Status Kunjungan</th>
                        <td>
                            <?php if ($kunjungan['statuskunjungan'] === 'Selesai') : ?>
                                <span class="badge bg-success">Selesai</span>
                            <?php else : ?>
                                <span class="badge bg-warning text-dark">Proses</span>
                            <?php endif; ?>
                        </td>
                    </tr>

                </table>
            </div>

        </div>
    </div>

    <div class="card shadow-sm mb-3">
        <div class="card-header bg-success text-white fw-bold">
            <i class="bi bi-cash-coin"></i> Informasi Pembayaran
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered mb-0">

                    <tr>
                        <th class="table-light">Total Kunjungan</th>
                        <td>
                            Rp <?= number_format((int) $kunjungan['totalkunjungan'], 0, ',', '.'); ?>
                        </td>
                    </tr>

                    <tr>
                        <th class="table-light">Jumlah Bayar</th>
                        <td>
                            Rp <?= number_format((int) $kunjungan['jumlahbayar'], 0, ',', '.'); ?>
                        </td>
                    </tr>

                    <tr>
                        <th class="table-light">Kembalian</th>
                        <td>
                            Rp <?= number_format((int) $kunjungan['kembalian'], 0, ',', '.'); ?>
                        </td>
                    </tr>

                    <tr>
                        <th class="table-light">Status Pembayaran</th>
                        <td>
                            <?php if ($kunjungan['statuspembayaran'] === 'Lunas') : ?>
                                <span class="badge bg-success">Lunas</span>
                            <?php else : ?>
                                <span class="badge bg-danger">Belum Bayar</span>
                            <?php endif; ?>
                        </td>
                    </tr>

                </table>
            </div>

        </div>
    </div>

    <a href="index.php?module=kunjungan&action=edit&id=<?= (int) $kunjungan['idkunjungan']; ?>"
       class="btn btn-warning">
        <i class="bi bi-pencil-square"></i> Edit Kunjungan
    </a>

    <a href="index.php?module=kunjungan&action=index"
       class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
