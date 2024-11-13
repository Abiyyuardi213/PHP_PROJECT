<?php
require_once 'models/model_barang.php';

class ControllerBarang {
    private $obj_barang;

    public function __construct() {
        $this->obj_barang = new modelBarang();
    }

    public function handleRequestBarang($fitur) {
        switch ($fitur) {
            case 'add':
                $this->addBarang();
                break;
            case 'update':
                $this->updateBarang();
                break;
            case 'delete':
                $this->deleteBarang();
                break;
            default:
                $this->listBarangs();
                break;
        }
    }

    private function addBarang() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $barang_name = $_POST['barang_name'];
            $barang_stock = $_POST['barang_stock'];
            $barang_harga = $_POST['barang_harga'];
            $barang_supplier = $_POST['barang_supplier'];
            $barang_status = $_POST['barang_status'];
            $this->obj_barang->addBarang($barang_name, $barang_stock, $barang_harga, $barang_supplier, $barang_status);

            $_SESSION['message'] = 'Inventory added successfully';
            header('Location: index.php?modul=barang&fitur=list');
            exit();
        }
        include 'views/barang_add.php';
    }

    private function updateBarang() {
        if (isset($_GET['barang_id'])) {
            $barang_id = $_GET['barang_id'];
            $barangs = $this->obj_barang->getAllBarangs();
            $current_barang = null;

            foreach ($barangs as $barang) {
                if ($barang->barang_id == $barang_id) {
                    $current_barang = $barang;
                    break;
                }
            }

            if ($current_barang === null) {
                header('Location: index.php?modul=barang&fitur=list');
                exit();
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $barang_name = $_POST['barang_name'];
                $barang_stock = $_POST['barang_stock'];
                $barang_harga = $_POST['barang_harga'];
                $barang_supplier = $_POST['barang_supplier'];
                $barang_status = $_POST['barang_status'];

                $this->obj_barang->updateBarang($barang_id, $barang_name, $barang_stock, $barang_harga, $barang_supplier, $barang_status);
                $_SESSION['message'] = 'Inventory updated successfully';
                header('Location: index.php?modul=barang&fitur=list');
                exit();
            }
            include 'views/barang_update.php';
        } else {
            header('Location: index.php?modul=barang&fitur=list');
            exit();
        }
    }

    private function deleteBarang() {
        if (isset($_GET['id'])) {
            $barang_id = $_GET['id'];
            $this->obj_barang->deleteBarang($barang_id);

            $_SESSION['message'] = 'Inventory deleted successfully';
            header('Location: index.php?modul=barang&fitur=list');
            exit();
        } else {
            header('Location: index.php?modul=barang&fitur=list');
            exit();
        }
    }

    private function listBarangs() {
        $barangs = $this->obj_barang->getAllBarangs();
        include 'views/barang_list.php';
    }
}