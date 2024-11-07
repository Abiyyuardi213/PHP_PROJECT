<?php
require_once 'nodes/node_transaksi.php';
require_once 'models/model_user.php';
require_once 'models/model_barang.php';

class modelTransaksi {
    private $transactions = [];
    private $userModel;
    private  $barangModel;
    

    public function __construct($userModel, $barangModel) {
        $this->userModel = $userModel;
        $this->barangModel = $barangModel;
        
        if (isset($_SESSION['transactions'])) {
            if ($_SESSION['transactions'] == null) {
                $this->transactions = unserialize($_SESSION['transactions']);
            }
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
            $this->addTransaction(1, [
                ['barang_id' => 1, 'quantity' => 10, 'price' => 4300]
            ], 1);
            $this->saveToSession();
        }
    }

    public function addTransaction($user_id, $items, $transaksi_status) {
        try {
            $newTransactionId = $this->getLastTransactionId() + 1;
            $user_name = $this->userModel->getUserNameById($user_id);
    
            if ($user_name === null) {
                $_SESSION['message'] = "User not found";
                return;
            }
    
            // Create the transaction object
            $transaction = new Transaksi($newTransactionId, $user_id, $transaksi_status, $this->userModel);
    
            $totalAmount = 0; // Initialize total amount
    
            // Loop through the items to calculate the total amount
            foreach ($items as $item) {
                $barang_id = $item['barang_id'];
                $quantity = $item['quantity'];
                $barang_harga = $this->barangModel->getBarangHargaById($barang_id); // Get price from modelBarang
    
                if ($barang_harga === null) {
                    $_SESSION['message'] = "Barang with ID $barang_id not found";
                    return;
                }
    
                $barang_name = $this->barangModel->getBarangNameById($barang_id); // Get name from modelBarang
                if ($barang_name === null) {
                    $_SESSION['message'] = "Barang with ID $barang_id not found";
                    return;
                }
    
                // Calculate the total amount
                $totalAmount += $barang_harga * $quantity;
    
                // Add the item to the transaction
                $transaction->addItem($barang_id, $quantity, $barang_harga, $barang_name);
            }
    
            // After calculating the total amount, save the transaction
            $transaction->setTotalAmount($totalAmount); // Assuming you have a method in Transaksi to set the total amount
            $this->transactions[] = $transaction;
    
            // Save to session
            $this->saveToSession();
    
            $_SESSION['message'] = "Transaction added successfully";
        } catch (\Throwable $th) {
            $_SESSION['message'] = "Transaction addition failed: " . $th->getMessage();
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

    public function updateTransaction($transaksi_id, $items, $transaksi_status) {
        foreach ($this->transactions as $transaction) {
            if ($transaction->transaksi_id == $transaksi_id) {
                $transaction->items = [];
                $transaction->totalAmount;

                foreach ($items as $item) {
                    $barang_id = $item['barang_id'];
                    $quantity = $item['quantity'];
                    $barang_harga = $item['barang_harga'];
                    $barang_name = $this->barangModel->getBarangNameById($barang_id);

                    if ($barang_name === null) {
                        $_SESSION['message'] = "Barang dengan ID $barang_id tidak ditemukan";
                        return;
                    }

                    $transaction->addItem($barang_id, $quantity, $barang_harga, $barang_name);
                }
                $transaction->transaski_status = $transaksi_status;
                $this->saveToSession();
                $_SESSION['message'] = "Transaction updated successfully";
                return;
            }
        }
        $_SESSION['message'] = "Transaction not found";
    }
}
