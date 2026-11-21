<?php

namespace App\Controllers;

use App\Models\Kunjungan;

class KunjunganController
{
    private $kunjungan;

    public function __construct($koneksi)
    {
        $this->kunjungan = new Kunjungan($koneksi);
    }

    // Menampilkan seluruh data kunjungan
    public function index()
    {
        $dataKunjungan = $this->kunjungan->tampil();

        require 'views/Kunjungan/index.php';
    }

    // Menampilkan formulir tambah kunjungan
    public function create()
    {
        $dataPasien = $this->kunjungan->tampilPasien();

        require 'views/Kunjungan/create.php';
    }

    // Menyimpan data kunjungan
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die("Akses tidak diizinkan.");
        }

        $idpasien = (int) $_POST['idpasien'];

        $dataPasien = $this->kunjungan->tampilPasien();

        $pasienValid = false;

        while ($row = mysqli_fetch_assoc($dataPasien)) {
            if ((int) $row['idpasien'] === $idpasien) {
                $pasienValid = true;
                break;
            }
        }

        if (!$pasienValid) {
            die("Pasien tidak valid.");
        }

        $tanggal = $_POST['tanggalkunjungan'];

        $tanggalValid = \DateTime::createFromFormat('Y-m-d', $tanggal);

        if (
            !$tanggalValid ||
            $tanggalValid->format('Y-m-d') !== $tanggal
        ) {
            die("Tanggal kunjungan tidak valid.");
        }

        $totalkunjungan = (int) $_POST['totalkunjungan'];
        $jumlahbayar = (int) $_POST['jumlahbayar'];
        $kembalian = (int) $_POST['kembalian'];

        if (
            $totalkunjungan < 0 ||
            $jumlahbayar < 0 ||
            $kembalian < 0
        ) {
            die("Nilai pembayaran tidak boleh negatif.");
        }

        $statusPembayaran = ['Belum Bayar', 'Lunas'];
        $statusKunjungan = ['Proses', 'Selesai'];

        if (!in_array($_POST['statuspembayaran'], $statusPembayaran)) {
            die("Status pembayaran tidak valid.");
        }

        if (!in_array($_POST['statuskunjungan'], $statusKunjungan)) {
            die("Status kunjungan tidak valid.");
        }

        $data = [
            'idpasien' => $idpasien,
            'tanggalkunjungan' => $tanggal,
            'keluhan' => trim($_POST['keluhan']),
            'diagnosis' => trim($_POST['diagnosis']),
            'totalkunjungan' => $totalkunjungan,
            'jumlahbayar' => $jumlahbayar,
            'kembalian' => $kembalian,
            'statuspembayaran' => $_POST['statuspembayaran'],
            'statuskunjungan' => $_POST['statuskunjungan']
        ];

        if ($this->kunjungan->tambah($data)) {
            header("Location: index.php?module=kunjungan&action=index");
            exit;
        }

        die("Gagal menyimpan data kunjungan.");
    }

    // Menampilkan formulir edit kunjungan
    public function edit($id)
    {
        $kunjungan = $this->kunjungan->ambil($id);

        if (!$kunjungan) {
            die("Data kunjungan tidak ditemukan.");
        }

        $dataPasien = $this->kunjungan->tampilPasien();

        require 'views/Kunjungan/edit.php';
    }

    // Memperbarui data kunjungan
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die("Akses tidak diizinkan.");
        }

        $kunjungan = $this->kunjungan->ambil($id);

        if (!$kunjungan) {
            die("Data kunjungan tidak ditemukan.");
        }

        $idpasien = (int) $_POST['idpasien'];

        $dataPasien = $this->kunjungan->tampilPasien();

        $pasienValid = false;

        while ($row = mysqli_fetch_assoc($dataPasien)) {
            if ((int) $row['idpasien'] === $idpasien) {
                $pasienValid = true;
                break;
            }
        }

        if (!$pasienValid) {
            die("Pasien tidak valid.");
        }

        $tanggal = $_POST['tanggalkunjungan'];

        $tanggalValid = \DateTime::createFromFormat('Y-m-d', $tanggal);

        if (
            !$tanggalValid ||
            $tanggalValid->format('Y-m-d') !== $tanggal
        ) {
            die("Tanggal kunjungan tidak valid.");
        }

        $totalkunjungan = (int) $_POST['totalkunjungan'];
        $jumlahbayar = (int) $_POST['jumlahbayar'];
        $kembalian = (int) $_POST['kembalian'];

        if (
            $totalkunjungan < 0 ||
            $jumlahbayar < 0 ||
            $kembalian < 0
        ) {
            die("Nilai pembayaran tidak boleh negatif.");
        }

        $statusPembayaran = ['Belum Bayar', 'Lunas'];
        $statusKunjungan = ['Proses', 'Selesai'];

        if (!in_array($_POST['statuspembayaran'], $statusPembayaran)) {
            die("Status pembayaran tidak valid.");
        }

        if (!in_array($_POST['statuskunjungan'], $statusKunjungan)) {
            die("Status kunjungan tidak valid.");
        }

        $data = [
            'idpasien' => $idpasien,
            'tanggalkunjungan' => $tanggal,
            'keluhan' => trim($_POST['keluhan']),
            'diagnosis' => trim($_POST['diagnosis']),
            'totalkunjungan' => $totalkunjungan,
            'jumlahbayar' => $jumlahbayar,
            'kembalian' => $kembalian,
            'statuspembayaran' => $_POST['statuspembayaran'],
            'statuskunjungan' => $_POST['statuskunjungan']
        ];

        if ($this->kunjungan->ubah($id, $data)) {
            header("Location: index.php?module=kunjungan&action=index");
            exit;
        }

        die("Gagal memperbarui data kunjungan.");
    }

    // Menampilkan detail kunjungan
    public function show($id)
    {
        $kunjungan = $this->kunjungan->ambil($id);

        if (!$kunjungan) {
            die("Data kunjungan tidak ditemukan.");
        }

        require 'views/Kunjungan/show.php';
    }

    // Menghapus data kunjungan
    public function delete($id)
    {
        $kunjungan = $this->kunjungan->ambil($id);

        if (!$kunjungan) {
            die("Data kunjungan tidak ditemukan.");
        }

        if ($this->kunjungan->hapus($id)) {
            header("Location: index.php?module=kunjungan&action=index");
            exit;
        }

        die("Gagal menghapus data kunjungan.");
    }
}
