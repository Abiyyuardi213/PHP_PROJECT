<?php
date_default_timezone_set('Asia/Jakarta');
require_once 'nodes/node_barang.php';

class modelBarang {
    private $barangs = [];

    public function __construct() {
        if (isset($_SESSION['barangs'])) {
            $this->barangs = unserialize($_SESSION['barangs']);
        } else {
            //inisial
        }
    }

    private function getLastIDBarang() {
        $maxIdBarang = 0;
        foreach ($this->barangs as $barang) {
            if ($barang->barang_id > $maxIdBarang) {
                $maxIdBarang = $barang->barang_id;
            }
        }
        return $maxIdBarang;
    }

    public function initializeDefaultBarang() {
        if (empty($this->barangs)) {
            $this->addBarang("Keyboard", "100", "150.000", "Abiyyu", 1);
        }
    }

    public function addBarang($barang_name, $barang_stock, $barang_harga, $barang_supplier, $barang_status) {
        $newIdBarang = $this->getLastIDBarang() + 1;
        $create_at = date("Y-m-d H:i:s");  // Set the current timestamp
        $brg = new Barang($newIdBarang, $barang_name, $barang_stock, $barang_harga, $barang_supplier, $barang_status, $create_at);
        $this->barangs[] = $brg;
        $this->saveToSession();
    }

    public function saveToSession() {
        $_SESSION['barangs'] = serialize($this->barangs);
    }

    public function getAllBarangs() {
        return $this->barangs;
    }

    public function updateBarang($barang_id, $barang_name, $barang_stock, $barang_harga, $barang_supplier, $barang_status) {
        foreach ($this->barangs as $barang) {
            if ($barang->barang_id == $barang_id) {
                $barang->barang_id = $barang_id;
                $barang->barang_name = $barang_name;
                $barang->barang_stock = $barang_stock;
                $barang->barang_harga = $barang_harga;
                $barang->barang_supplier = $barang_supplier;
                $barang->barang_status = $barang_status;
                $this->saveToSession();
                return true;
            }
        }
        return false;
    }

    public function deleteBarang($barang_id) {
        foreach ($this->barangs as $key => $barang) {
            if ($barang->barang_id == $barang_id) {
                unset($this->barangs[$key]);
                $this->barangs = array_values($this->barangs);
                $this->saveToSession();
                return true;
            }
        }
        return false;
    }

    public function getBarangNameById($barang_id) {
        foreach ($this->barangs as $barang) {
            if ($barang->barang_id == $barang_id) {
                return $barang->barang_name;
            }
        }
        return null;
    }
}
?>