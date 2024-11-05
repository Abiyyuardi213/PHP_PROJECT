<?php
require_once 'nodes/node_transaksi.php';
require_once 'models/model_user.php';
require_once 'models/model_barang.php';

class modelTransaksi {
    private $transactions = [];
    private $userModel;
    private $barangModel;

    public function __construct($userModel, $barangModel) {
        $this->userModel = $userModel;
        $this->barangModel = $barangModel;
        
        if (isset($_SESSION['transactions'])) {
            $this->transactions = unserialize($_SESSION['transactions']);
        } else {
            $this->initializeDefaultTransaction();
        }
    }

    private function getLastTransactionId() {
        $maxIdTransaction = 0;
        foreach ($this->transactions as $transaction) {
            if ($transaction->transaksi_id > $maxIdTransaction) {
                $maxIdTransaction = $transaction->transaksi_id;
            }
        }
        return $maxIdTransaction;
    }

    public function initializeDefaultTransaction() {
        if (empty($this->transactions)) {
            $this->addTransaction(1, 3, 10, 43000, 1);
            $this->saveToSession();
        }
    }

    public function addTransaction($user_id, $barang_id, $quantity, $totalAmount, $transaski_status) {
        try {
            $newTransactionId = $this->getLastTransactionId() + 1;

            $user_name = $this->userModel->getUserNameById($user_id);
            $barang_name = $this->barangModel->getBarangNameById($barang_id);

            if ($user_name === null) {
                $_SESSION['message'] = "User not found";
                return;
            }

            if ($barang_name === null) {
                $_SESSION['message'] = "Barang not found";
                return;
            }

            $transaction = new Transaksi($newTransactionId, $user_id, $barang_id, $quantity, $totalAmount, $transaski_status, $this->userModel, $this->barangModel);
            $this->transactions[] = $transaction;
            $this->saveToSession();
            $_SESSION['message'] = "Transaction added successfully";
        } catch (\Throwable $th) {
            $_SESSION['message'] = "Transaction addition failed";
        }
    }

    public function saveToSession() {
        $_SESSION['transactions'] = serialize($this->transactions);
    }

    public function getAllTransaction() {
        return $this->transactions;
    }

    public function getTransactionById($transaksi_id) {
        foreach ($this->transactions as $transaction) {
            if ($transaction->transaksi_id == $transaksi_id) {
                return $transaction;
            }
        }
        return null;
    }

    public function updateTransaction($transaksi_id, $quantity, $totalAmount, $transaksi_status) {
        foreach ($this->transactions as $transaction) {
            if ($transaction->transaksi_id == $transaksi_id) {
                $transaction->quantity = $quantity;
                $transaction->totalAmount = $totalAmount;
                $transaction->transaski_status = $transaksi_status;
                $this->saveToSession();
                $_SESSION['message'] = "Transaction updated successfully";
                return;
            }
        }
        $_SESSION['message'] = "Transaction not found";
    }

    public function deleteTransaction($transaksi_id) {
        foreach ($this->transactions as $key => $transaction) {
            if ($transaction->transaksi_id == $transaksi_id) {
                unset($this->transactions[$key]);
                $this->transactions = array_values($this->transactions);
                $this->saveToSession();
                $_SESSION['message'] = "Transaction deleted successfully";
                return;
            }
        }
        $_SESSION['message'] = "Transaction not found";
    }
}
?>