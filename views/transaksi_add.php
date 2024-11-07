<?php
require_once 'models/model_transaksi.php';
require_once 'models/model_user.php';
require_once 'models/model_barang.php';
require_once 'models/model_role.php';

$roleModel = new modelRole();
$userModel = new modelUser($roleModel);
$barangModel = new modelBarang();
$transaksiModel = new modelTransaksi($userModel, $barangModel);

$users = $userModel->getAllUsers();
$barangs = $barangModel->getAllBarangs();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Transaction</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.0/dist/alpine.min.js"></script>
</head>
<body class="bg-gray-100 flex">
    <aside class="w-64 bg-gradient-to-b from-blue-700 to-indigo-800 text-white min-h-screen flex flex-col shadow-lg">
        <div class="p-6 text-center">
            <h2 class="text-3xl font-bold mb-4">ITATS Management System</h2>
        </div>
        <nav class="flex-grow px-4">
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
                    <path d="M6 2a1 1 0 00-1 1v14a1 1 0 001 1h8a1 1 0 001-1V3a1 1 0 00-1-1H6zM7 4h6v12H7V4zM9 9.5A1.5 1.5 0 1110.5 8 1.5 1.5 0 019 9.5zm3 3a1.5 1.5 0 10-1.5-1.5 1.5 1.5 0 001.5 1.5z"/>
                </svg>
                <span>Transaction</span>
            </a>
        </nav>
        <footer class="p-4 text-center mt-auto">
            <button class="bg-red-500 text-white px-4 py-2 rounded-full transform transition hover:scale-105 hover:shadow-lg">Logout</button>
        </footer>
    </aside>

    <main class="flex-grow p-8">
        <header class="mb-6 text-center">
            <h1 class="text-3xl font-semibold text-gray-700">Add New Transaction</h1>
            <p class="text-gray-500">Manage your transactions efficiently</p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white p-8 rounded-lg shadow-md w-full max-w-4xl mx-auto" x-data="transactionForm()">
            <!-- Left Container: Form Inputs -->
            <div class="space-y-6">
                <div>
                    <label for="user_id" class="block text-gray-700">User Name</label>
                    <select id="user_id" name="user_id" class="mt-2 p-2 w-full border border-gray-300 rounded-lg" required>
                        <?php foreach ($users as $user): ?>
                            <option value="<?php echo $user->user_id; ?>">
                                <?php echo $user->user_name; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label for="barang_id" class="block text-gray-700">Barang Name</label>
                    <select id="barang_id" name="barang_id" class="mt-2 p-2 w-full border border-gray-300 rounded-lg" x-on:change="updateBarang($event)" required>
                        <option value="" disabled selected>Select a product</option>
                        <?php foreach ($barangs as $barang): ?>
                            <option value="<?php echo $barang->barang_id; ?>" data-price="<?php echo $barang->barang_harga; ?>">
                                <?php echo $barang->barang_name; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label for="quantity" class="block text-gray-700">Quantity</label>
                    <input type="number" id="quantity" name="quantity" class="mt-2 p-2 w-full border border-gray-300 rounded-lg" x-model="quantity" x-on:input="updateTotal" min="1" required>
                </div>
            </div>

            <!-- Right Container: Price and Total Display -->
            <div class="flex flex-col justify-center items-center bg-gray-50 p-6 rounded-lg">
                <h2 class="text-xl font-semibold text-gray-600 mb-4">Transaction Summary</h2>
                
                <div class="text-center">
                    <p class="text-gray-500 text-lg">Selected Barang:</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1" x-text="barangName || 'None Selected'">None Selected</p>
                </div>
                <div class="text-center mt-6">
                    <p class="text-gray-500 text-lg">Price per Unit:</p>
                    <p class="text-2xl font-bold text-gray-800">Rp <span x-text="barangPrice">0</span></p>
                </div>
                <!-- <div>
                    <label class="block text-gray-700">Price</label>
                    <p class="mt-2 p-2 bg-gray-200 rounded-lg">$<span x-text="price">0</span></p>
                </div> -->

                <!-- <div>
                    <label class="block text-gray-700">Total</label>
                    <p class="mt-2 p-2 bg-gray-200 rounded-lg">$<span x-text="total">0</span></p>
                </div> -->

                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg">Save Transaction</button>
            </div>
        </div>
    </main>

    <script>
        function transactionForm() {
            return {
                barangName: '',
                barangPrice: 0,
                quantity: 1,
                totalPrice: 0,

                updateBarang(event) {
                    const selectedOption = event.target.options[event.target.selectedIndex];
                    this.barangName = selectedOption.text;
                    this.barangPrice = parseFloat(selectedOption.getAttribute('data-price')) || 0;
                    this.updateTotal();
                },

                updateTotal() {
                    this.totalPrice = this.barangPrice * this.quantity;
                }
            }
        }
    </script>
</body>
</html>
