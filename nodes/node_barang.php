<?php
class Barang {
    public $barang_id;
    public $barang_name;
    public $barang_stock;
    public $barang_supplier;
    public $barang_status;
    public $create_at;

    public function __construct($id, $name, $stock, $supplier, $status, $create_at) {
        $this->barang_id = $id;
        $this->barang_name = $name;
        $this->barang_stock = $stock;
        $this->barang_supplier = $supplier;
        $this->barang_status = $status;
        $this->create_at = $create_at;
    }
}
?>
