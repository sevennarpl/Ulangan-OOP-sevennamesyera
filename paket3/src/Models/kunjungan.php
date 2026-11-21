<?php

namespace App\Models;

class Kunjungan
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    // Menampilkan seluruh data kunjungan
    public function tampil()
    {
        $query = "SELECT
                    kunjungan.*,
                    pasien.namapasien
                  FROM kunjungan
                  INNER JOIN pasien
                  ON kunjungan.idpasien = pasien.idpasien
                  ORDER BY kunjungan.idkunjungan DESC";

        return mysqli_query($this->koneksi, $query);
    }

    // Mengambil satu data kunjungan berdasarkan ID
    public function ambil($id)
    {
        $query = "SELECT
                    kunjungan.*,
                    pasien.namapasien
                  FROM kunjungan
                  INNER JOIN pasien
                  ON kunjungan.idpasien = pasien.idpasien
                  WHERE kunjungan.idkunjungan = ?";

        $stmt = mysqli_prepare($this->koneksi, $query);

        mysqli_stmt_bind_param($stmt, "i", $id);

        mysqli_stmt_execute($stmt);

        $hasil = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_assoc($hasil);
    }

    // Menampilkan daftar pasien untuk pilihan kunjungan
    public function tampilPasien()
    {
        $query = "SELECT idpasien, namapasien
                  FROM pasien
                  ORDER BY namapasien ASC";

        return mysqli_query($this->koneksi, $query);
    }

    // Menambahkan data kunjungan
    public function tambah($data)
    {
        $query = "INSERT INTO kunjungan
                  (idpasien, tanggalkunjungan, keluhan, diagnosis,
                   totalkunjungan, jumlahbayar, kembalian,
                   statuspembayaran, statuskunjungan)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($this->koneksi, $query);

        mysqli_stmt_bind_param(
            $stmt,
            "isssiiiss",
            $data['idpasien'],
            $data['tanggalkunjungan'],
            $data['keluhan'],
            $data['diagnosis'],
            $data['totalkunjungan'],
            $data['jumlahbayar'],
            $data['kembalian'],
            $data['statuspembayaran'],
            $data['statuskunjungan']
        );

        return mysqli_stmt_execute($stmt);
    }

    // Mengubah data kunjungan
    public function ubah($id, $data)
    {
        $query = "UPDATE kunjungan SET
                  idpasien = ?,
                  tanggalkunjungan = ?,
                  keluhan = ?,
                  diagnosis = ?,
                  totalkunjungan = ?,
                  jumlahbayar = ?,
                  kembalian = ?,
                  statuspembayaran = ?,
                  statuskunjungan = ?
                  WHERE idkunjungan = ?";

        $stmt = mysqli_prepare($this->koneksi, $query);

        mysqli_stmt_bind_param(
            $stmt,
            "isssiiissi",
            $data['idpasien'],
            $data['tanggalkunjungan'],
            $data['keluhan'],
            $data['diagnosis'],
            $data['totalkunjungan'],
            $data['jumlahbayar'],
            $data['kembalian'],
            $data['statuspembayaran'],
            $data['statuskunjungan'],
            $id
        );

        return mysqli_stmt_execute($stmt);
    }

    // Menghapus data kunjungan
    public function hapus($id)
    {
        $query = "DELETE FROM kunjungan
                  WHERE idkunjungan = ?";

        $stmt = mysqli_prepare($this->koneksi, $query);

        mysqli_stmt_bind_param($stmt, "i", $id);

        return mysqli_stmt_execute($stmt);
    }
}
