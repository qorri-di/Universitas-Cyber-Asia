<?php

require_once 'app/model/Mahasiswa.php';

class MahasiswaController
{
    private $model;

    public function __construct($conn)
    {
        $this->model = new Mahasiswa($conn);
    }

    public function index()
    {
        $mahasiswaList = $this->model->getAllMahasiswa();
        include 'app/view/mahasiswa/mahasiswa.index.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $_POST['nama'];
            $nim = $_POST['nim'];
            $programStudi = $_POST['program_studi'];

            $result = $this->model->createMahasiswa($nama, $nim, $programStudi);

            if ($result) {
                header("Location: mahasiswa/");
                exit();
            } else {
                echo "Error: Gagal menambahkan data mahasiswa.";
            }
        }

        include 'app/view/mahasiswa/mahasiswa.add.php';
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $_POST['nama'];
            $nim = $_POST['nim'];
            $programStudi = $_POST['program_studi'];

            $result = $this->model->updateMahasiswa($id, $nama, $nim, $programStudi);

            if ($result) {
                header("Location: mahasiswa/");
                exit();
            } else {
                echo "Error: Gagal mengupdate data mahasiswa.";
            }
        }

        $mahasiswa = $this->model->getMahasiswaById($id);
        include 'app/view/mahasiswa/mahasiswa.edit.php';
    }

    public function delete($id)
    {
        $result = $this->model->deleteMahasiswa($id);

        if ($result) {
            header("Location: mahasiswa/");
            exit();
        } else {
            echo "Error: Gagal menghapus data mahasiswa.";
        }
    }
}
