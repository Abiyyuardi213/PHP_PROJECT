<?php
require_once 'nodes/node_DetailTransaksi.php';
require_once 'models/model_barang.php';

class modelDetailTransaction {
    private $transactionDetails = [];
    private $nextId = 1;
    private $barangModel;

    public function __construct() {
        $this->barangModel = new modelBarang();
        if (isset($_SESSION['transactionDetails'])) {
            $this->transactionDetails = unserialize($_SESSION['transactionDetails']);
            $this->nextId = count($this->transactionDetails) + 1;
        }
    }

    public function getNextId() {
        return $this->nextId++;
    }

    public function addTransactionDetail($transaksi, $barang_id, $quantity, $price_barang) {
        $barang = $this->barangModel->getBarangById($barang_id);
        $transactionDetail = new DetailTransaksi(
            $transaksi->transaksi_id, 
            $this->getNextId(), 
            $barang, 
            $quantity, 
            $price_barang,
        );

        $user_id = $transactionDetail->getUserId($transaksi);
        $this->transactionDetails[] = $transactionDetail;
        $this->saveToSession();
    }

    private function saveToSession() {
        $_SESSION['transactionDetails'] = serialize($this->transactionDetails);
    }

    public function getTransactionDetailById($transaction_id) {
        if (!$transaction_id) {
            return [];
        }

        $transactionDetails = [];
        
        if (isset($_SESSION['transactions'][$transaction_id])) {
            $transactionDetails = $_SESSION['transactions'][$transaction_id];
        }

        return $transactionDetails; 
    }
}
