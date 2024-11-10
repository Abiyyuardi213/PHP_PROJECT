<?php
require_once 'models/model_transaksi.php';
require_once 'models/model_user.php';
require_once 'models/model_barang.php';
require_once 'models/model_role.php';

$roleModel = new modelRole();
$userModel = new modelUser();
$barangModel = new modelBarang();
$transaksiModel = new modelTransaction();

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
</head>
<body class="bg-gray-100 flex">
<aside class="w-64 bg-gradient-to-b from-blue-700 to-indigo-800 text-white min-h-screen flex flex-col shadow-lg">
    <!-- Sidebar content here -->
</aside>

<main class="flex-grow p-8">
    <header class="mb-6 text-center">
        <h1 class="text-3xl font-semibold text-gray-700">Add New Transaction</h1>
        <p class="text-gray-500">Manage your transactions efficiently</p>
    </header>

    <form action="index.php?modul=transaksi&fitur=add" method="POST">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white p-8 rounded-lg shadow-md w-full max-w-4xl mx-auto">
            <!-- Left Container: Form Inputs -->
            <div class="space-y-6">
                <div>
                    <label for="user_id" class="block text-gray-700">User Name</label>
                    <select id="user_id" name="user_id" class="mt-2 p-2 w-full border border-gray-300 rounded-lg" required>
                        <?php foreach ($users as $user): ?>
                            <option value="<?php echo $user->user_id; ?>"><?php echo $user->user_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label for="barang_id" class="block text-gray-700">Barang Name</label>
                    <select id="barang_id" class="mt-2 p-2 w-full border border-gray-300 rounded-lg" required>
                        <option value="" disabled selected>Select a product</option>
                        <?php foreach ($barangs as $barang): ?>
                            <option value="<?php echo $barang->barang_id; ?>" data-name="<?php echo $barang->barang_name; ?>" data-price="<?php echo $barang->barang_harga; ?>">
                                <?php echo $barang->barang_name; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Right Container: Price and Total Display -->
            <div class="flex flex-col justify-center items-center bg-gray-50 p-6 rounded-lg">
                <h2 class="text-xl font-semibold text-gray-600 mb-4">Transaction Summary</h2>

                <div class="text-center mt-6">
                    <p class="text-gray-500 text-lg">Total to Pay:</p>
                    <p class="text-3xl font-bold text-green-600" id="totalPrice">Rp 0</p>
                </div>

                <input type="hidden" name="total_amount" id="total_amount">
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg mt-6">Save Transaction</button>
            </div>
        </div>

        <!-- Tabel barang yang dipilih -->
        <div class="mt-8 max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Selected Products</h2>
            <table class="w-full bg-white border border-gray-300 rounded-lg">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Barang Name</th>
                        <th class="py-2 px-4 border-b">Price</th>
                        <th class="py-2 px-4 border-b">Quantity</th>
                        <th class="py-2 px-4 border-b">Total</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody id="barangTableBody">
                </tbody>
            </table>
        </div>
    </form>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    let selectedBarangs = [];
    const totalPriceElement = document.getElementById('totalPrice');
    const totalAmountInput = document.getElementById('total_amount');
    const barangSelect = document.getElementById('barang_id');
    const barangTableBody = document.getElementById('barangTableBody');

    barangSelect.addEventListener('change', function (event) {
        const selectedOption = event.target.options[event.target.selectedIndex];
        const barangId = selectedOption.value;
        const barangName = selectedOption.getAttribute('data-name');
        const barangPrice = parseFloat(selectedOption.getAttribute('data-price')) || 0;

        const existingBarang = selectedBarangs.find(barang => barang.id === barangId);
        if (existingBarang) {
            existingBarang.quantity += 1;
        } else {
            selectedBarangs.push({ id: barangId, name: barangName, price: barangPrice, quantity: 1 });
        }
        updateTotal();
        renderBarangTable();
    });

    function renderBarangTable() {
        barangTableBody.innerHTML = '';
        selectedBarangs.forEach((barang, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="py-2 px-4 border-b text-center">${barang.name}</td>
                <td class="py-2 px-4 border-b text-center">Rp ${barang.price}</td>
                <td class="py-2 px-4 border-b text-center">
                    <input type="number" min="1" value="${barang.quantity}" class="border p-1 w-16 text-center" data-index="${index}">
                </td>
                <td class="py-2 px-4 border-b text-center">Rp ${barang.price * barang.quantity}</td>
                <td class="py-2 px-4 border-b text-center">
                    <button type="button" class="text-red-500 hover:text-red-700" onclick="removeBarang(${index})">Remove</button>
                </td>
                <input type="hidden" name="barang_id[]" value="${barang.id}">
                <input type="hidden" name="barang_quantity[]" value="${barang.quantity}">
            `;
            barangTableBody.appendChild(row);

            // Attach event listener for the input field
            const quantityInput = row.querySelector('input[type="number"]');
            quantityInput.addEventListener('input', function (event) {
                updateQuantity(event);
            });
        });
    }

    function updateQuantity(event) {
        const index = event.target.getAttribute('data-index');
        const quantity = parseInt(event.target.value) || 1;
        selectedBarangs[index].quantity = quantity;
        updateTotal();
        renderBarangTable();
    }

    function removeBarang(index) {
        selectedBarangs.splice(index, 1);
        updateTotal();
        renderBarangTable();
    }

    function updateTotal() {
        const total = selectedBarangs.reduce((total, barang) => {
            return total + (barang.price * barang.quantity);
        }, 0);
        totalPriceElement.textContent = `Rp ${total}`;
        totalAmountInput.value = total;
    }
});

</script>

</body>
</html>
