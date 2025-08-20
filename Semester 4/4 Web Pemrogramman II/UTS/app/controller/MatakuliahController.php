<?php
require_once 'app/model/Matakuliah.php';

class MatakuliahController{
    private $model;

    public function __construct($conn)
    {
        $this->model = new Matakuliah($conn);
    }

    public function index()
    {
        $matakuliahList = $this->model->getAllMatakuliah();
        include 'app/view/matakuliah/matakuliah.index.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $_POST['nama'];
            $kode = $_POST['kode'];
            $deskripsi = $_POST['deskripsi'];

            $result = $this->model->createMatakuliah($nama, $kode, $deskripsi);

            if ($result) {
                header("Location: matakuliah/");
                exit();
            } else {
                echo "Error: Gagal menambahkan data matakuliah.";
            }
        }

        include 'app/view/matakuliah/matakuliah.add.php';
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $_POST['nama'];
            $kode = $_POST['kode'];
            $deskripsi = $_POST['deskripsi'];

            $result = $this->model->updateMatakuliah($id, $nama, $kode, $deskripsi);

            if ($result) {
                header("Location: matakuliah/");
                exit();
            } else {
                echo "Error: Gagal mengupdate data matakuliah.";
            }
        }

        $matakuliah = $this->model->getMatakuliahById($id);
        include 'app/view/matakuliah/matakuliah.edit.php';
    }

    public function delete($id)
    {
        $result = $this->model->deleteMatakuliah($id);

        if ($result) {
            header("Location: matakuliah/");
            exit();
        } else {
            echo "Error: Gagal menghapus data matakuliah.";
        }
    }
}