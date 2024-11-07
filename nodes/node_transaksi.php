<?php
require_once 'models/model_user.php';
require_once 'models/model_barang.php';

class Transaksi {
    public $transaksi_id;
    public $user_id;
    public $user_name;
    public $items = [];
    public $transaksi_status;
    public $transaksi_date;
    private $totalAmount;

    public function __construct($transaksi_id, $user_id, $transaksi_status, $userModel) {
        $this->transaksi_id = $transaksi_id;
        $this->user_id = $user_id;
        $this->transaksi_status = $transaksi_status;
        $this->transaksi_date = date("Y-m-d H:i:s");
        $this->user_name = $userModel->getUserNameById($user_id);
    }

    public function addItem($barang_id, $quantity, $barang_harga, $barang_name) {
        $itemTotal = $quantity * $barang_harga;
        $this->items[] = [
            'barang_id' => $barang_id,
            'barang_name' => $barang_name,
            'quantity' => $quantity,
            'barang_harga' => $barang_harga,
            'total' => $itemTotal
        ];
        $this->totalAmount += $itemTotal;
    }

    public function setTotalAmount($amount) {
        $this->totalAmount = $amount;
    }

    public function getTotalAmount() {
        return $this->totalAmount;
    }
}
?>