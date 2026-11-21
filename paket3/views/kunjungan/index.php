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
    <title>Data Kunjungan - Kliniksevenna</title>

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

        .table th, .table td {
            padding: 7px;
            vertical-align: middle;
            white-space: nowrap;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="index.php?module=pasien&action=index">
            <i class="bi bi-hospital"></i> Kliniksevenna
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
                Aplikasi Kliniksevenna Paket 3
            </span>
        </div>
    </div>
</nav>

<div class="container-fluid my-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h5 class="fw-bold mb-1">Data Kunjungan</h5>
            <span class="text-muted">Daftar riwayat kunjungan pasien</span>
        </div>

        <a href="index.php?module=kunjungan&action=create"
           class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Kunjungan
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover mb-0">

                    <thead class="table-primary">
                        <tr>
                            <th>No.</th>
                            <th>Nama Pasien</th>
                            <th>Tanggal Kunjungan</th>
                            <th>Keluhan</th>
                            <th>Diagnosis</th>
                            <th>Total Kunjungan</th>
                            <th>Jumlah Bayar</th>
                            <th>Kembalian</th>
                            <th>Status Pembayaran</th>
                            <th>Status Kunjungan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1; ?>

                        <?php while ($row = mysqli_fetch_assoc($dataKunjungan)) : ?>

                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= e($row['namapasien']); ?></td>
                                <td><?= e($row['tanggalkunjungan']); ?></td>
                                <td><?= e($row['keluhan']); ?></td>
                                <td><?= e($row['diagnosis']); ?></td>

                                <td>
                                    Rp <?= number_format((int) $row['totalkunjungan'], 0, ',', '.'); ?>
                                </td>

                                <td>
                                    Rp <?= number_format((int) $row['jumlahbayar'], 0, ',', '.'); ?>
                                </td>

                                <td>
                                    Rp <?= number_format((int) $row['kembalian'], 0, ',', '.'); ?>
                                </td>

                                <td>
                                    <?php if ($row['statuspembayaran'] === 'Lunas') : ?>
                                        <span class="badge bg-success">
                                            Lunas
                                        </span>
                                    <?php else : ?>
                                        <span class="badge bg-danger">
                                            Belum Bayar
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?php if ($row['statuskunjungan'] === 'Selesai') : ?>
                                        <span class="badge bg-success">
                                            Selesai
                                        </span>
                                    <?php else : ?>
                                        <span class="badge bg-warning text-dark">
                                            Proses
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">

                                        <a href="index.php?module=kunjungan&action=show&id=<?= (int) $row['idkunjungan']; ?>"
                                           class="btn btn-info btn-sm text-white"
                                           title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="index.php?module=kunjungan&action=edit&id=<?= (int) $row['idkunjungan']; ?>"
                                           class="btn btn-warning btn-sm"
                                           title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <a href="index.php?module=kunjungan&action=delete&id=<?= (int) $row['idkunjungan']; ?>"
                                           class="btn btn-danger btn-sm"
                                           title="Hapus"
                                           onclick="return confirm('Yakin ingin menghapus kunjungan ini?')">
                                            <i class="bi bi-trash"></i>
                                        </a>

                                    </div>
                                </td>
                            </tr>

                        <?php endwhile; ?>

                        <?php if (mysqli_num_rows($dataKunjungan) === 0) : ?>
                            <tr>
                                <td colspan="11" class="text-center text-muted">
                                    Belum ada data kunjungan.
                                </td>
                            </tr>
                        <?php endif; ?>

                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
