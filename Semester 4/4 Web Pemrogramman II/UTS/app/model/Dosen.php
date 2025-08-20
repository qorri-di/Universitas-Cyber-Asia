<?php
class Dosen{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllDosen()
    {
        $query = "SELECT * FROM dosen";
        $result = pg_query($this->conn, $query);
        $dosenList = pg_fetch_all($result);

        return $dosenList;
    }

    public function getDosenById($id)
    {
        $query = "SELECT * FROM dosen WHERE id = $id";
        $result = pg_query($this->conn, $query);
        $dosen = pg_fetch_assoc($result);

        return $dosen;
    }

    public function createDosen($nama, $nidn, $jenjang)
    {
        $nama = pg_escape_string($nama);
        $nidn = pg_escape_string($nidn);
        $jenjang = pg_escape_string($jenjang);

        $query = "INSERT INTO dosen (nama, nidn, jenjang_pendidikan) VALUES ('$nama', '$nidn', '$jenjang')";
        $result = pg_query($this->conn, $query);

        return $result;
    }

    public function updateDosen($id, $nama, $nidn, $jenjang)
    {
        $nama = pg_escape_string($nama);
        $nidn = pg_escape_string($nidn);
        $jenjang = pg_escape_string($jenjang);

        $query = "UPDATE dosen SET nama = '$nama', nidn = '$nidn', jenjang_pendidikan = '$jenjang' WHERE id = $id";
        $result = pg_query($this->conn, $query);

        return $result;
    }

    public function deleteDosen($id)
    {
        $query = "DELETE FROM dosen WHERE id = $id";
        $result = pg_query($this->conn, $query);

        return $result;
    }
}
