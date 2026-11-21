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
    <title>Data Pasien - KlinikAhmadi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
          rel="stylesheet">

    <style>
        body {
            font-size: 11px;
            background-color: #f5f6fa;
        }

        .navbar, .btn, .form-control, .form-select, .table {
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

        .foto-pasien {
            width: 42px;
            height: 42px;
            object-fit: cover;
            border-radius: 5px;
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
                Aplikasi Kliniksevenna Paket 3
            </span>
        </div>
    </div>
</nav>

<div class="container-fluid my-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h5 class="fw-bold mb-1">Data Pasien</h5>
            <span class="text-muted">Daftar pasien Kliniksevenna</span>
        </div>

        <a href="index.php?module=pasien&action=create"
           class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Pasien
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover mb-0">

                    <thead class="table-primary">
                        <tr>
                            <th>No.</th>
                            <th>Foto</th>
                            <th>Nama Pasien</th>
                            <th>Username</th>
                            <th>Usia</th>
                            <th>Alergi Obat</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>No. HP</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1; ?>

                        <?php while ($row = mysqli_fetch_assoc($dataPasien)) : ?>

                            <tr>
                                <td><?= $no++; ?></td>

                                <td>
                                    <img
                                        src="assets/images/pasien/<?= e($row['foto']); ?>"
                                        class="foto-pasien"
                                        alt="Foto pasien"
                                    >
                                </td>

                                <td><?= e($row['namapasien']); ?></td>
                                <td><?= e($row['username']); ?></td>
                                <td><?= e($row['usia']); ?> tahun</td>
                                <td><?= e($row['alergi']); ?></td>
                                <td><?= e($row['jeniskelamin']); ?></td>
                                <td><?= e($row['alamat']); ?></td>
                                <td><?= e($row['nohp']); ?></td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">

                                        <a href="index.php?module=pasien&action=show&id=<?= (int) $row['idpasien']; ?>"
                                           class="btn btn-info btn-sm text-white"
                                           title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="index.php?module=pasien&action=edit&id=<?= (int) $row['idpasien']; ?>"
                                           class="btn btn-warning btn-sm"
                                           title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <a href="index.php?module=pasien&action=delete&id=<?= (int) $row['idpasien']; ?>"
                                           class="btn btn-danger btn-sm"
                                           title="Hapus"
                                           onclick="return confirm('Yakin ingin menghapus pasien ini?')">
                                            <i class="bi bi-trash"></i>
                                        </a>

                                    </div>
                                </td>
                            </tr>

                        <?php endwhile; ?>

                        <?php if (mysqli_num_rows($dataPasien) === 0) : ?>
                            <tr>
                                <td colspan="10" class="text-center text-muted">
                                    Belum ada data pasien.
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
