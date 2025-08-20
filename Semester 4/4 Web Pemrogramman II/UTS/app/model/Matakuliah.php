<?php
class Matakuliah{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllMatakuliah()
    {
        $query = "SELECT * FROM matakuliah";
        $result = pg_query($this->conn, $query);
        $matakuliahList = pg_fetch_all($result);

        return $matakuliahList;
    }

    public function getMatakuliahById($id)
    {
        $query = "SELECT * FROM matakuliah WHERE id = $id";
        $result = pg_query($this->conn, $query);
        $matakuliah = pg_fetch_assoc($result);

        return $matakuliah;
    }

    public function createMatakuliah($nama, $kode, $deskripsi)
    {
        $nama = pg_escape_string($nama);
        $kode = pg_escape_string($kode);
        $deskripsi = pg_escape_string($deskripsi);

        $query = "INSERT INTO matakuliah (nama, kode_matakuliah, deskripsi) VALUES ('$nama', '$kode', '$deskripsi')";
        $result = pg_query($this->conn, $query);

        return $result;
    }

    public function updateMatakuliah($id, $nama, $kode, $deskripsi)
    {
        $nama = pg_escape_string($nama);
        $kode = pg_escape_string($kode);
        $deskripsi = pg_escape_string($deskripsi);

        $query = "UPDATE matakuliah SET nama = '$nama', kode_matakuliah = '$kode', deskripsi = '$deskripsi' WHERE id = $id";
        $result = pg_query($this->conn, $query);

        return $result;
    }

    public function deleteMatakuliah($id)
    {
        $query = "DELETE FROM matakuliah WHERE id = $id";
        $result = pg_query($this->conn, $query);

        return $result;
    }
}
