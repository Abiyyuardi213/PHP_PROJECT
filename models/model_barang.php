<?php
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
            $this->addBarang("Keyboard", "100", "Abiyyu", 1);
        }
    }

    public function addBarang($barang_name, $barang_stock, $barang_supplier, $barang_status) {
        $newIdBarang = $this->getLastIDBarang() + 1;
        $brg = new Barang($newIdBarang, $barang_name, $barang_stock, $barang_supplier, $barang_status);
        $this->barangs[] = $brg;
        $this->saveToSession();
    }

    public function saveToSession() {
        $_SESSION['barangs'] = serialize($this->barangs);
    }

    public function getAllBarangs() {
        return $this->barangs;
    }
}
?>