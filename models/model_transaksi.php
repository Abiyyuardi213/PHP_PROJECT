<?php
require_once('nodes/node_transaksi.php');
require_once('models/model_detailTransaksi.php');

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
    
        // Memastikan bahwa data transaksi dalam session adalah array atau objek
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

        // Membuat objek Transaksi baru dengan ID unik
        $transaksi = new Transaksi($this->nextId++, $user, $transaction_date, $transaction_status);

        // Menambahkan detail barang ke transaksi
        foreach ($detailBarang as $detail) {
            $barang = $this->barangModel->getBarangById($detail['Id_Barang']); 
            if ($barang) {
                // Membuat objek DetailTransaksi dan menambahkannya ke transaksi
                $detailObj = new DetailTransaksi(
                    $transaksi->transaksi_id,
                    $this->transactionDetailModel->getNextId(), // Gunakan ID detail yang benar
                    $barang,
                    $detail['Jumlah_Barang'],
                    $detail['Harga_Barang'],
                    $user_id
                );
                $transaksi->addDetailBarang($detailObj);

                // Menambahkan detail ke model detail transaksi
                $this->transactionDetailModel->addTransactionDetail($transaksi->transaksi_id, $detail['Id_Barang'], $detail['Jumlah_Barang'], $detail['Harga_Barang'], $user_id);
            }
        }

        $this->transactionList[] = $transaksi;
        $this->saveToSession();
        return true;
    }

    public function getTransactionById($transaksi_id) {
        // Memastikan session transaksi sudah di-unserialize dengan benar
        if (isset($_SESSION['transaksi'])) {
            $transactions = unserialize($_SESSION['transaksi']);
        } else {
            $transactions = [];
        }
    
        // Memeriksa transaksi dalam array
        foreach ($transactions as $transaksi) {
            if ($transaksi->transaksi_id == $transaksi_id) {
                return $transaksi;
            }
        }
        return null; // Jika transaksi tidak ditemukan
    }

    public function getAllTransaction() {
        return $this->transactionList;
    }

    private function saveToSession() {
        $_SESSION['transaksi'] = serialize($this->transactionList);
    }
    
}
