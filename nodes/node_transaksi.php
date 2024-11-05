<?php
require_once 'models/model_user.php';
require_once 'models/model_barang.php';

class Transaksi {
    public $transaksi_id;
    public $user_name;
    public $user_id;
    public $barang_name;
    public $barang_id;
    public $quantity;
    public $totalAmount;
    public $transaksi_status;
    public $transaksi_date;

    public function __construct($transaksi_id, $user_id, $barang_id, $quantity, $totalAmount, $transaksi_status, $userModel, $barangModel) {
        $this->transaksi_id = $transaksi_id;
        $this->user_id = $user_id;
        $this->barang_id = $barang_id;
        $this->quantity = $quantity;
        $this->totalAmount = $totalAmount;
        $this->transaksi_status = $transaksi_status;
        $this->transaksi_date = date("Y-m-d H:i:s");
        $this->user_name = $userModel->getUserNameById($user_id);
        $this->barang_name = $barangModel->getBarangNameById($barang_id);
    }
}
?>