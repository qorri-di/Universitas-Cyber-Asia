<?php
class Mahasiswa{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllMahasiswa()
    {
        $query = "SELECT * FROM mahasiswa";
        $result = pg_query($this->conn, $query);
        $mahasiswaList = pg_fetch_all($result);

        return $mahasiswaList;
    }

    public function getMahasiswaById($id)
    {
        $query = "SELECT * FROM mahasiswa WHERE id = $id";
        $result = pg_query($this->conn, $query);
        $mahasiswa = pg_fetch_assoc($result);

        return $mahasiswa;
    }

    public function createMahasiswa($nama, $nim, $programStudi)
    {
        $nama = pg_escape_string($nama);
        $nim = pg_escape_string($nim);
        $programStudi = pg_escape_string($programStudi);

        $query = "INSERT INTO mahasiswa (nama, nim, program_studi) VALUES ('$nama', '$nim', '$programStudi')";
        $result = pg_query($this->conn, $query);

        return $result;
    }

    public function updateMahasiswa($id, $nama, $nim, $programStudi)
    {
        $nama = pg_escape_string($nama);
        $nim = pg_escape_string($nim);
        $programStudi = pg_escape_string($programStudi);

        $query = "UPDATE mahasiswa SET nama = '$nama', nim = '$nim', program_studi = '$programStudi' WHERE id = $id";
        $result = pg_query($this->conn, $query);

        return $result;
    }

    public function deleteMahasiswa($id)
    {
        $query = "DELETE FROM mahasiswa WHERE id = $id";
        $result = pg_query($this->conn, $query);

        return $result;
    }
}
