<?php
require_once 'models/model_user.php';
require_once 'models/model_barang.php';
require_once 'models/model_transaksi.php';

class ControllerTransaksi {
    private $userModel;
    private $barangModel;
    private $transaksiModel;

    public function __construct() {
        $this->userModel = new modelUser();
        $this->barangModel = new modelBarang();
        $this->transaksiModel = new modelTransaction();
    }

    public function handleRequestTransaction($fitur) {
        switch ($fitur) {
            case 'add':
                $this->addTransaksi();
                break;
            case 'view':
                $this->viewTransaksi();
                break;
            default:
            $this->listTransaksi();
                break;
        }
    }

    private function addTransaksi() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_POST['user_id'];
            $transaction_date = date('Y-m-d H:i:s');
            $transaction_status = 'completed';
            $barang_ids = $_POST['barang_id'];
            $barang_quantities = $_POST['barang_quantity'];
        
            $detailBarang = [];
            foreach ($barang_ids as $index => $barang_id) {
                $quantity = $barang_quantities[$index];
                $barang = $this->barangModel->getBarangById($barang_id);
                if ($barang) {
                    $barang_name = $barang->barang_name;
                    $barang_harga = $barang->barang_harga;
                    $detailBarang[] = [
                        'Id_Barang' => $barang_id,
                        'Jumlah_Barang' => $quantity,
                        'Harga_Barang' => $barang_harga
                    ];
                }
            }
            $this->transaksiModel->addTransaksi($user_id, $transaction_date, $transaction_status, $detailBarang);
            $_SESSION['message'] = "Transaksi berhasil ditambahkan!";
            header('Location: index.php?modul=transaksi&fitur=list');
            exit();
        }
        $users = $this->userModel->getAllUsers();
        $barangs = $this->barangModel->getAllBarangs();
        include 'views/transaksi_add.php';
    }

    private function viewTransaksi() {
        if (isset($_GET['transaksi_id'])) {
            $transaksi_id = $_GET['transaksi_id'];
            $transaksi = $this->transaksiModel->getTransactionById($transaksi_id);
            include 'views/transaksi_view.php';
        } else {
            $_SESSION['message'] = "Transaksi tidak ditemukan.";
            header('Location: index.php?modul=transaksi&fitur=list');
            exit();
        }
    }

    private function listTransaksi() {
        $transactions = $this->transaksiModel->getAllTransaction();
        include 'views/transaksi_list.php';
    }
}