<?php
class DetailTransaksi {
    public $transaksi_id;
    public $id_detail;
    public $id_barang;
    public $quantity;
    public $price_barang;
    public $total_amount;
    public $user_id; //hapus
    public function __construct($transaksi_id, $id_detail, $id_barang, $quantity, $price_barang, $user_id) {
        $this->transaksi_id = $transaksi_id;
        $this->id_detail = $id_detail;
        $this->id_barang = $id_barang;
        $this->quantity = $quantity;
        $this->price_barang = $price_barang;
        $this->total_amount = is_numeric($quantity) && is_numeric($price_barang) ? $quantity * $price_barang : 0;
        $this->user_id = $user_id;
    }
}
