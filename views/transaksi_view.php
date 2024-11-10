<?php
require_once 'models/model_transaksi.php';
require_once 'models/model_user.php';
require_once 'models/model_barang.php';

$transaksi_id = $_GET['transaksi_id'] ?? null;

if ($transaksi_id) {
    $obj_transaksi = new modelTransaction();
    $transaction = $obj_transaksi->getTransactionById($transaksi_id);
}

if (!$transaction) {
    echo "Transaksi tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
    <h1 class="text-2xl font-bold mb-4">Detail Transaksi ID: <?= $transaction->transaksi_id ?></h1>
    <p>User: <?= $transaction->user_id->user_name ?></p>
    <p>Tanggal: <?= $transaction->transaksi_date ?></p>
    <p>Status: <?= $transaction->transaksi_status ?></p>

    <h2 class="text-xl font-semibold mt-6 mb-2">Detail Barang:</h2>
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($transaction->itemsDetail as $item) : ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap"><?= $item->id_barang->barang_name ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= number_format($item->price_barang) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= $item->quantity ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= number_format($item->total_amount) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
