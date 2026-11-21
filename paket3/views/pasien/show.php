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
    <title>Detail Pasien - KlinikAhmadi</title>

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

        .foto-pasien {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border-radius: 8px;
        }

        .table th {
            width: 180px;
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

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h5 class="fw-bold mb-1">Detail Pasien</h5>
            <span class="text-muted">Informasi lengkap pasien</span>
        </div>

        <a href="index.php?module=pasien&action=index"
           class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="text-center mb-4">
                <img src="assets/images/pasien/<?= e($pasien['foto']); ?>"
                     class="foto-pasien"
                     alt="Foto pasien">

                <h5 class="fw-bold mt-2 mb-1">
                    <?= e($pasien['namapasien']); ?>
                </h5>

                <span class="text-muted">
                    ID Pasien: <?= (int) $pasien['idpasien']; ?>
                </span>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">

                    <tr>
                        <th class="table-light">Nama Pasien</th>
                        <td><?= e($pasien['namapasien']); ?></td>
                    </tr>

                    <tr>
                        <th class="table-light">Username</th>
                        <td><?= e($pasien['username']); ?></td>
                    </tr>

                    <tr>
                        <th class="table-light">Usia</th>
                        <td><?= e($pasien['usia']); ?> tahun</td>
                    </tr>

                    <tr>
                        <th class="table-light">Alergi Obat</th>
                        <td><?= e($pasien['alergi']); ?></td>
                    </tr>

                    <tr>
                        <th class="table-light">Jenis Kelamin</th>
                        <td><?= e($pasien['jeniskelamin']); ?></td>
                    </tr>

                    <tr>
                        <th class="table-light">Alamat</th>
                        <td><?= nl2br(e($pasien['alamat'])); ?></td>
                    </tr>

                    <tr>
                        <th class="table-light">Nomor HP</th>
                        <td><?= e($pasien['nohp']); ?></td>
                    </tr>

                </table>
            </div>

            <a href="index.php?module=pasien&action=edit&id=<?= (int) $pasien['idpasien']; ?>"
               class="btn btn-warning">
                <i class="bi bi-pencil-square"></i> Edit Pasien
            </a>

            <a href="index.php?module=pasien&action=index"
               class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
