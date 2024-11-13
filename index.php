<?php
session_start();
require_once 'controllers/controller_role.php';
require_once 'controllers/controller_user.php';
require_once 'controllers/controller_barang.php';
require_once 'controllers/controller_transaksi.php';

if (isset($_GET['modul'])) {
    $modul = $_GET['modul'];
} else {
    $modul = 'dashboard';
}

switch ($modul) {
    case 'dashboard':
        include 'views/dashboard.php';
        break;

    case 'role':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : 'list';
        $controllerRole = new ControllerRole();
        $controllerRole->handleRequestRole($fitur);
        break;

    case 'user':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : 'list';
        $controllerUser = new ControllerUser();
        $controllerUser->handleRequestUser($fitur);
        break;

    case 'barang':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : 'list';
        $controllerBarang = new ControllerBarang();
        $controllerBarang->handleRequestBarang($fitur);
        break;

    case 'transaksi':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : 'list';
        $transaksiController = new ControllerTransaksi();
        $transaksiController->handleRequestTransaction($fitur);
        break;

    default:
        header('Location: index.php?modul=dashboard');
        break;
}

