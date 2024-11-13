<?php
require_once 'nodes/node_transaksi.php';
require_once 'models/model_detailTransaksi.php';
require_once 'models/model_barang.php';
require_once 'models/model_user.php';

class modelTransaction {
    private $transactionList = [];
    private $nextId = 1;
    private $transactionDetailModel;
    private $barangModel;
    private $userModel;

    public function __construct() {
        $this->transactionDetailModel = new modelDetailTransaction();
        $this->barangModel = new modelBarang();
        $this->userModel = new modelUser();
        
        if (isset($_SESSION['transaksi'])) {
            $this->transactionList = unserialize($_SESSION['transaksi']);
            $this->nextId = count($this->transactionList) + 1;
        } else {
            $this->transactionList = [];
            $this->nextId = 1;
        }
    }

    public function addTransaksi($user_id, $transaction_date, $transaction_status, $detailBarang) {
        $user = $this->userModel->getUserById($user_id);
        if ($user === null) {
            return false;
        }

        $transaksi = new Transaksi($this->nextId++, $user_id, $transaction_date, $transaction_status);
        $transaksi->itemDetail = $detailBarang;
            
        foreach ($detailBarang as $detail) {
            $barang = $this->barangModel->getBarangById($detail['Id_Barang']); 
            if ($barang) {
                $detailObj = new DetailTransaksi(
                    $transaksi->transaksi_id,
                    $this->transactionDetailModel->getNextId(), // Gunakan ID detail yang benar
                    $barang,
                    $detail['Jumlah_Barang'],
                    $detail['Harga_Barang'],
                );
                $transaksi->addDetailBarang($detailObj);

                $this->transactionDetailModel->addTransactionDetail($transaksi, $detail['Id_Barang'], $detail['Jumlah_Barang'], $detail['Harga_Barang']);
            }
        }

        $this->transactionList[] = $transaksi;
        $this->saveToSession();
        return true;
    }

    public function getTransactionById($transaksi_id) {
        if (isset($_SESSION['transaksi'])) {
            $transactions = unserialize($_SESSION['transaksi']);
        } else {
            $transactions = [];
        }
        
        foreach ($transactions as $transaksi) {
            if ($transaksi->transaksi_id == $transaksi_id) {
                return $transaksi;
            }
        }
        return null;
    }

    public function getAllTransaction() {
        return $this->transactionList;
    }

    private function saveToSession() {
        $_SESSION['transaksi'] = serialize($this->transactionList);
    }
}
