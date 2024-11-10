<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/@heroicons/react@1.0.6/solid" defer></script>
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
            <h1 class="text-3xl font-semibold text-gray-700">Dashboard</h1>

            <!-- Profile and Logout -->
            <div class="flex items-center space-x-4">
                <button class="flex items-center bg-green-500 text-white px-4 py-2 rounded-full hover:bg-green-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 2a5 5 0 100 10 5 5 0 000-10zm0 12c-3.25 0-5 2.25-5 5h10c0-2.75-1.75-5-5-5z" clip-rule="evenodd"/>
                    </svg>
                    Abiyyu Ardilian
                </button>
                <button class="bg-red-500 text-white px-4 py-2 rounded-full transform transition hover:scale-105 hover:shadow-lg">Logout</button>
            </div>
        </header>

        <!-- Dashboard Container -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-5">
            <!-- Manage Role Card -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:bg-indigo-100 transition">
                <img src="./image/s1.jpg" alt="Role Image" class="w-full h-48 object-cover rounded-md mb-4">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Manage Role</h2>
                <p class="text-gray-500 mb-4">Manage user roles and permissions within the system.</p>
                <a href="index.php?modul=role&fitur=list" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition">Go to Role Management</a>
            </div>

            <!-- Manage User Card -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:bg-indigo-100 transition">
                <img src="./image/s3.webp" alt="User Image" class="w-full h-48 object-cover rounded-md mb-4">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Manage User</h2>
                <p class="text-gray-500 mb-4">Add, edit, and delete users for managing system access.</p>
                <a href="index.php?modul=user&fitur=list" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition">Go to User Management</a>
            </div>

            <!-- Inventory Management Card -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:bg-indigo-100 transition">
                <img src="./image/s4.webp" alt="Inventory Image" class="w-full h-48 object-cover rounded-md mb-4">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Inventory Management</h2>
                <p class="text-gray-500 mb-4">Track and manage your inventory items.</p>
                <a href="index.php?modul=barang&fitur=list" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition">Go to Inventory Management</a>
            </div>

            <!-- Transaction Management Card -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:bg-indigo-100 transition">
                <img src="./image/s5.jpg" alt="Transaction Image" class="w-full h-48 object-cover rounded-md mb-4">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Transaction Management</h2>
                <p class="text-gray-500 mb-4">Track and manage transactions and purchases.</p>
                <a href="index.php?modul=transaksi&fitur=list" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition">Go to Transaction Management</a>
            </div>
        </div>
    </main>
</body>
</html>