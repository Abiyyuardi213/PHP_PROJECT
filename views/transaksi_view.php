<?php
require_once 'models/model_transaksi.php';
require_once 'models/model_user.php';
require_once 'models/model_barang.php';
require_once 'models/model_detailTransaksi.php';

$obj_transaksi = new modelDetailTransaction();
$userModel = new modelUser();
$barangModel = new modelBarang();

$transaction_id = $_GET['id'] ?? null;
$transactionDetails = $obj_transaksi->getTransactionDetailById($transaction_id);

if (empty($transactionDetails)) {
    echo "Transaction not found.";
    exit;
}

// Assuming the first item in $transactionDetails array contains general transaction information
$firstDetail = $transactionDetails[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Details</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-6">Transaction Details</h2>

        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <p><strong>Transaction ID:</strong> <?= htmlspecialchars($firstDetail->transaksi_id) ?></p>
            <p><strong>User:</strong> <?= htmlspecialchars($userModel->getUserById($firstDetail->user_id)->user_name ?? 'Unknown User') ?></p>
            <p><strong>Date:</strong> <?= htmlspecialchars($firstDetail->transaksi_date) ?></p>
            <p><strong>Status:</strong> <?= htmlspecialchars($firstDetail->transaksi_status) ?></p>
        </div>

        <h3 class="text-xl font-semibold mb-4">Products</h3>
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Product Name</th>
                    <th class="py-3 px-6 text-left">Quantity</th>
                    <th class="py-3 px-6 text-left">Price</th>
                    <th class="py-3 px-6 text-left">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactionDetails as $detail): ?>
                    <tr class="border-t">
                        <td class="py-3 px-6"><?= htmlspecialchars($barangModel->getBarangById($detail->barang_id)->barang_name ?? 'Unknown Product') ?></td>
                        <td class="py-3 px-6"><?= htmlspecialchars($detail->jumlah_barang) ?></td>
                        <td class="py-3 px-6"><?= number_format($detail->harga_barang, 2) ?></td>
                        <td class="py-3 px-6"><?= number_format($detail->jumlah_barang * $detail->harga_barang, 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="mt-6">
            <a href="index.php?modul=transaksi&fitur=list" class="bg-blue-500 text-white px-4 py-2 rounded-full">Back to List</a>
        </div>
    </div>
</body>
</html>
