<?php

require_once 'core/Database.php';
require_once 'app/controller/MahasiswaController.php';
require_once 'app/controller/MatakuliahController.php';
require_once 'app/controller/DosenController.php';

$conn = pg_connect("host=localhost dbname=siakad user=postgres password=root");

// Routing
$route = $_GET['menu'] ?? '';

if ($route === 'mahasiswa') {
    $mahasiswaController = new MahasiswaController($conn);

    $action = $_GET['action'] ?? '';

    if ($action === 'create') {
        $mahasiswaController->create();
    } elseif ($action === 'edit') {
        $id = $_GET['id'] ?? '';
        $mahasiswaController->edit($id);
    } elseif ($action === 'delete') {
        $id = $_GET['id'] ?? '';
        $mahasiswaController->delete($id);
    } else {
        $mahasiswaController->index();
    }
} elseif ($route === 'matakuliah') {
    $matakuliahController = new MatakuliahController($conn);

    $action = $_GET['action'] ?? '';

    if ($action === 'create') {
        $matakuliahController->create();
    } elseif ($action === 'edit') {
        $id = $_GET['id'] ?? '';
        $matakuliahController->edit($id);
    } elseif ($action === 'delete') {
        $id = $_GET['id'] ?? '';
        $matakuliahController->delete($id);
    } else {
        $matakuliahController->index();
    }
} elseif ($route === 'dosen') {
    $dosenController = new DosenController($conn);

    $action = $_GET['action'] ?? '';

    if ($action === 'create') {
        $dosenController->create();
    } elseif ($action === 'edit') {
        $id = $_GET['id'] ?? '';
        $dosenController->edit($id);
    } elseif ($action === 'delete') {
        $id = $_GET['id'] ?? '';
        $dosenController->delete($id);
    } else {
        $dosenController->index();
    }
} else {
    echo "Halaman tidak ditemukan";
}