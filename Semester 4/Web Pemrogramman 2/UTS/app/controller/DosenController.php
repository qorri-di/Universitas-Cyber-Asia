<?php

require_once 'app/model/Dosen.php';

class DosenController{
    private $model;

    public function __construct($conn)
    {
        $this->model = new Dosen($conn);
    }

    public function index()
    {
        $dosenList = $this->model->getAllDosen();
        include 'app/view/dosen/dosen.index.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $_POST['nama'];
            $nidn = $_POST['nidn'];
            $jenjang = $_POST['jenjang'];

            $result = $this->model->createDosen($nama, $nidn, $jenjang);

            if ($result) {
                header("Location: dosen/");
                exit();
            } else {
                echo "Error: Gagal menambahkan data dosen.";
            }
        }

        include 'app/view/dosen/dosen.add.php';
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $_POST['nama'];
            $nidn = $_POST['nidn'];
            $jenjang = $_POST['jenjang'];

            $result = $this->model->updateDosen($id, $nama, $nidn, $jenjang);

            if ($result) {
                header("Location: dosen/");
                exit();
            } else {
                echo "Error: Gagal mengupdate data dosen.";
            }
        }

        $dosen = $this->model->getDosenById($id);
        include 'app/view/dosen/dosen.edit.php';
    }

    public function delete($id)
    {
        $result = $this->model->deleteDosen($id);

        if ($result) {
            header("Location: dosen/");
            exit();
        } else {
            echo "Error: Gagal menghapus data dosen.";
        }
    }
}
