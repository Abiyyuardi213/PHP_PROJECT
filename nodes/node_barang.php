<?php
class Barang {
    public $barang_id;
    public $barang_name;
    public $barang_stock;
    public $barang_supplier;
    public $create_at;
    public $barang_status;

    function __construct($barang_id, $barang_name, $barang_stock, $barang_supplier, $barang_status) {
        $this->barang_id = $barang_id;
        $this->barang_name = $barang_name;
        $this->barang_stock = $barang_stock;
        $this->barang_supplier = $barang_supplier;
        $this->barang_status = $barang_status;
        $this->create_at = date("Y-m-d H:i:s");
    }
}
?>
