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

$user_name = '';
if ($transaction->user_id) {
    $obj_user = new modelUser();
    $user = $obj_user->getUserById($transaction->user_id);
    if ($user) {
        $user_name = $user->user_name;
    } else {
        $user_name = "Unknown User";
    }
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
<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-b from-blue-700 to-indigo-800 text-white min-h-screen flex flex-col shadow-lg">
        <div class="p-6 text-center">
            <h2 class="text-3xl font-bold mb-4">Warehouse Management System</h2>
        </div>
        <nav class="flex-grow px-4">
            <!-- Links in Sidebar -->
            <a href="index.php?modul=dashboard" class="flex items-center gap-2 py-3 px-4 rounded-lg hover:bg-indigo-700 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 11a1 1 0 11-2 0V9a1 1 0 112 0v4zm-1-7a1 1 0 100 2 1 1 0 000-2z"/>
                </svg>
                <span>Dashboard</span>
            </a>
            <a href="index.php?modul=role&fitur=list" class="flex items-center gap-2 py-3 px-4 rounded-lg hover:bg-indigo-700 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.5 2a1 1 0 011 1v1.32a6.992 6.992 0 012.905 1.287l.936-.937a1 1 0 011.414 1.414l-.937.936A6.992 6.992 0 0116.68 9.5H18a1 1 0 110 2h-1.32a6.992 6.992 0 01-1.287 2.905l.937.936a1 1 0 01-1.414 1.414l-.936-.937A6.992 6.992 0 0111.5 16.68V18a1 1 0 11-2 0v-1.32a6.992 6.992 0 01-2.905-1.287l-.936.937a1 1 0 01-1.414-1.414l.937-.936A6.992 6.992 0 013.32 11.5H2a1 1 0 110-2h1.32a6.992 6.992 0 011.287-2.905l-.937-.936a1 1 0 111.414-1.414l.936.937A6.992 6.992 0 019.5 4.32V3a1 1 0 011-1zM10 7a3 3 0 100 6 3 3 0 000-6z" clip-rule="evenodd"/>
                </svg>
                <span>Manage Role</span>
            </a>
            <a href="index.php?modul=user&fitur=list" class="flex items-center gap-2 py-3 px-4 rounded-lg hover:bg-indigo-700 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 6a2 2 0 100-4 2 2 0 000 4zm-6 8a6 6 0 1112 0H4z" clip-rule="evenodd"/>
                </svg>
                <span>Manage User</span>
            </a>
            <a href="index.php?modul=barang&fitur=list" class="flex items-center gap-2 py-3 px-4 rounded-lg hover:bg-indigo-700 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M4 3a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V4a1 1 0 00-1-1H4zm0 2h12v3H4V5zm0 5h12v5H4v-5z"/>
                </svg>
                <span>Inventory</span>
            </a>
            <a href="index.php?modul=transaksi&fitur=list" class="flex items-center gap-2 py-3 px-4 rounded-lg hover:bg-indigo-700 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M6 2a1 1 0 00-1 1v14a1 1 0 001 1h8a1 1 0 001-1V3a1 1 0 00-1-1H6zM7 4h6v12H7V4zM9 9.5A1.5 1.5 0 1110.5 8 1.5 1.5 0 009 9.5zm3 3a1.5 1.5 0 10-1.5-1.5 1.5 1.5 0 001.5 1.5z"/>
                </svg>
                <span>Transaction</span>
            </a>
        </nav>
    </aside>

    <!-- Main content -->
    <main class="flex-grow p-6">
        <header class="mb-6 flex justify-between items-center">
            <h1 class="text-3xl font-semibold text-gray-700">Transaction Details</h1>
        </header>

        <div class="bg-white p-5 rounded-lg shadow-lg max-w-4xl mt-8">
            <h1 class="text-2xl font-bold mb-4 text-gray-800">Detail Transaksi ID: <?= $transaction->transaksi_id ?></h1>
            <p class="text-lg text-gray-600">User : <span class="font-semibold"><?= htmlspecialchars($user_name) ?></span></p>
            <p class="text-lg text-gray-600">Tanggal : <span class="font-semibold"><?= $transaction->transaksi_date ?></span></p>
            <p class="text-lg text-gray-600">Status : <span class="font-semibold text-green-600"><?= $transaction->transaksi_status ?></span></p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg mt-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Detail Barang:</h2>
        <div class="overflow-x-auto bg-gray-50 rounded-lg shadow-md">
            <table class="min-w-full table-auto text-left">
                <thead class="bg-indigo-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium text-gray-100 uppercase tracking-wider">Nama Barang</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-100 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-100 uppercase tracking-wider">Jumlah</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-100 uppercase tracking-wider">Total</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php 
                    $barangTersedia = false;
                    foreach ($transaction->itemDetail as $item) : 
                        if (is_object($item) && isset($item->id_barang->barang_name)) :
                            $barangTersedia = true;
                    ?>
                            <tr class="hover:bg-gray-100 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-gray-700"><?= htmlspecialchars($item->id_barang->barang_name) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-700"><?= number_format($item->price_barang) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-700"><?= $item->quantity ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-700"><?= number_format($item->total_amount) ?></td>
                            </tr>
                    <?php 
                        endif;
                    endforeach;

                    if (!$barangTersedia) : 
                    ?>
                        <tr>
                            <td colspan="4" class="px-6 py-4 whitespace-nowrap text-gray-700">Data barang tidak tersedia</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    </main>

</body>
</html>
