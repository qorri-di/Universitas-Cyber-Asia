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
    include 'public/home.php';
//    echo "Halaman tidak ditemukan";
}

//require_once 'core/Database.php';
//require_once 'app/controller/MahasiswaController.php';
//require_once 'app/controller/MatakuliahController.php';
//require_once 'app/controller/DosenController.php';
//
//$conn = pg_connect("host=localhost dbname=siakad user=postgres password=root");
//
//// Routing
//$route = $_SERVER['REQUEST_URI'];
//
//// Menghapus query string dari URL jika ada
//$route = strtok($route, '?');
//
//// Membagi URL menjadi segmen-segmen
//$segments = explode('/', $route);
//
//// Mengambil segmen pertama sebagai controller
//$controller = $segments[1] ?? '';
//
//// Mengambil segmen kedua sebagai tindakan (action)
//$action = $segments[2] ?? '';
//
//// Mengambil segmen ketiga sebagai ID (jika ada)
//$id = $segments[3] ?? '';
//
//if ($controller === 'mahasiswa') {
//    $mahasiswaController = new MahasiswaController($conn);
//
//    if ($action === 'create') {
//        $mahasiswaController->create();
//    } elseif ($action === 'edit' && !empty($id)) {
//        $mahasiswaController->edit($id);
//    } elseif ($action === 'delete' && !empty($id)) {
//        $mahasiswaController->delete($id);
//    } else {
//        $mahasiswaController->index();
//    }
//} elseif ($controller === 'matakuliah') {
//    $matakuliahController = new MatakuliahController($conn);
//
//    if ($action === 'create') {
//        $matakuliahController->create();
//    } elseif ($action === 'edit' && !empty($id)) {
//        $matakuliahController->edit($id);
//    } elseif ($action === 'delete' && !empty($id)) {
//        $id = array_shift($segments);
//        $matakuliahController->delete($id);
//    } else {
//        $matakuliahController->index();
//    }
//} elseif ($controller === 'dosen') {
//    $dosenController = new DosenController($conn);
//
//    if ($action === 'create') {
//        $dosenController->create();
//    } elseif ($action === 'edit' && !empty($id)) {
//        $dosenController->edit($id);
//    } elseif ($action === 'delete' && !empty($id)) {
//        $dosenController->delete($id);
//    } else {
//        $dosenController->index();
//    }
//} else {
//    include 'public/home.php';
//}