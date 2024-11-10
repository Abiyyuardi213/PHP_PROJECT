<?php
require_once('nodes/node_DetailTransaksi.php');
require_once('models/model_transaksi.php');

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

    public function addTransactionDetail($transaksi_id, $barang_id, $quantity, $price_barang, $user_id) {
        $barang = $this->barangModel->getBarangById($barang_id);
        $transactionDetail = new DetailTransaksi(
            $transaksi_id, 
            $this->getNextId(), // Perbaiki ID detail agar unik
            $barang_id, 
            $quantity, 
            $price_barang,
            $user_id
        );
        $this->transactionDetails[] = $transactionDetail;
        $this->saveToSession();
    }

    private function saveToSession() {
        $_SESSION['transactionDetails'] = serialize($this->transactionDetails);
    }

    public function getTransactionDetailById($transaction_id) {
        if (!$transaction_id) {
            return []; // Kembalikan array kosong jika ID tidak ada
        }

        // Misalnya menggunakan session atau database, contoh sederhana:
        $transactionDetails = []; // Ambil detail transaksi berdasarkan ID (session atau DB)
        
        // Contoh data jika memakai session:
        if (isset($_SESSION['transactions'][$transaction_id])) {
            $transactionDetails = $_SESSION['transactions'][$transaction_id];
        }

        return $transactionDetails; 
    }
}
