<?php

namespace App\Models;

class Pasien
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    // Menampilkan seluruh data pasien
    public function tampil()
    {
        $query = "SELECT * FROM pasien ORDER BY idpasien DESC";

        return mysqli_query($this->koneksi, $query);
    }

    // Mengambil satu data pasien berdasarkan ID
    public function ambil($id)
    {
        $query = "SELECT * FROM pasien WHERE idpasien = ?";

        $stmt = mysqli_prepare($this->koneksi, $query);

        mysqli_stmt_bind_param($stmt, "i", $id);

        mysqli_stmt_execute($stmt);

        $hasil = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_assoc($hasil);
    }

    // Menambahkan data pasien
    public function tambah($data)
    {
        $query = "INSERT INTO pasien
                  (namapasien, username, password, usia, alergi,
                   jeniskelamin, alamat, nohp, foto)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($this->koneksi, $query);

        $password = password_hash(
            $data['password'],
            PASSWORD_DEFAULT
        );

        mysqli_stmt_bind_param(
            $stmt,
            "sssisssss",
            $data['namapasien'],
            $data['username'],
            $password,
            $data['usia'],
            $data['alergi'],
            $data['jeniskelamin'],
            $data['alamat'],
            $data['nohp'],
            $data['foto']
        );

        return mysqli_stmt_execute($stmt);
    }

    // Mengubah data pasien
    public function ubah($id, $data)
    {
        if (!empty($data['password'])) {

            $query = "UPDATE pasien SET
                      namapasien = ?,
                      username = ?,
                      password = ?,
                      usia = ?,
                      alergi = ?,
                      jeniskelamin = ?,
                      alamat = ?,
                      nohp = ?,
                      foto = ?
                      WHERE idpasien = ?";

            $stmt = mysqli_prepare($this->koneksi, $query);

            $password = password_hash(
                $data['password'],
                PASSWORD_DEFAULT
            );

            mysqli_stmt_bind_param(
                $stmt,
                "sssisssssi",
                $data['namapasien'],
                $data['username'],
                $password,
                $data['usia'],
                $data['alergi'],
                $data['jeniskelamin'],
                $data['alamat'],
                $data['nohp'],
                $data['foto'],
                $id
            );

        } else {

            $query = "UPDATE pasien SET
                      namapasien = ?,
                      username = ?,
                      usia = ?,
                      alergi = ?,
                      jeniskelamin = ?,
                      alamat = ?,
                      nohp = ?,
                      foto = ?
                      WHERE idpasien = ?";

            $stmt = mysqli_prepare($this->koneksi, $query);

            mysqli_stmt_bind_param(
                $stmt,
                "ssisssssi",
                $data['namapasien'],
                $data['username'],
                $data['usia'],
                $data['alergi'],
                $data['jeniskelamin'],
                $data['alamat'],
                $data['nohp'],
                $data['foto'],
                $id
            );
        }

        return mysqli_stmt_execute($stmt);
    }

    // Menghapus data pasien
    public function hapus($id)
    {
        $query = "DELETE FROM pasien WHERE idpasien = ?";

        $stmt = mysqli_prepare($this->koneksi, $query);

        mysqli_stmt_bind_param($stmt, "i", $id);

        return mysqli_stmt_execute($stmt);
    }
}
