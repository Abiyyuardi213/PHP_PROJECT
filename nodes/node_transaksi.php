<?php
require_once 'models/model_user.php';
require_once 'models/model_barang.php';
class Transaksi {
    public $transaksi_id;
    public $user_id;
    public $transaksi_date;
    public $transaksi_status;
    public $itemDetail = [];

    public function __construct($transaksi_id, $user_id, $transaksi_date, $transaksi_status) {
        $this->transaksi_id = $transaksi_id;
        $this->user_id = $user_id;
        $this->transaksi_date = $transaksi_date;
        $this->transaksi_status = $transaksi_status;
    }

    public function addDetailBarang($detail) {
        $this->itemDetail[] = $detail;
    }

    public function getTotalAmount() {
        $total = 0;
        foreach ($this->itemDetail as $item) {
            $total += $item->total_amount;
        }
        return $total;
    }
}
