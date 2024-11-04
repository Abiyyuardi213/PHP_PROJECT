<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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

    <main class="flex-grow p-6">
        <header class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-700">Manage Role</h1>
            <div class="relative mt-4">
                <input type="text" id="search" placeholder="Search roles..." class="bg-gray-200 text-gray-700 pl-10 pr-4 py-2 rounded-full shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-2.5 h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.9 14.32a7 7 0 111.41-1.41l3.4 3.39a1 1 0 01-1.42 1.42l-3.4-3.4zm-5.9-6.32a5 5 0 100 10 5 5 0 000-10z" clip-rule="evenodd" />
                </svg>
            </div>
        </header>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                <?= htmlspecialchars($_SESSION['message']) ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <div class="mb-4 flex justify-end">
            <a href="index.php?modul=role&fitur=add" class="bg-gradient-to-r from-green-400 to-green-500 text-white px-5 py-2 rounded-full shadow-md transform transition hover:scale-105 hover:shadow-lg flex items-center gap-2">
                <!-- Ikon User Group -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13 7a3 3 0 100-6 3 3 0 000 6zM2 9a5 5 0 0110 0v3h-1v6a1 1 0 11-2 0v-6H5v6a1 1 0 11-2 0v-6H2V9zm10 8a1 1 0 100-2 1 1 0 000 2zM4 17a1 1 0 100-2 1 1 0 000 2z"/>
                </svg>
                Add New Role
            </a>
        </div>
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
            <table class="min-w-full bg-white">
                <thead class="bg-indigo-100 text-indigo-600 uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">Role ID</th>
                        <th class="py-3 px-6 text-left">Role Name</th>
                        <th class="py-3 px-6 text-left">Role Description</th>
                        <th class="py-3 px-6 text-left">Role Salary</th>
                        <th class="py-3 px-6 text-left">Role Status</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <?php if (empty($roles)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">No roles found</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($roles as $role): ?>
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($role->role_id) ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($role->role_name) ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($role->role_description) ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($role->role_salary) ?></td>
                            <td class="py-3 px-6 text-left"><?= $role->role_status == 1 ? 'Active' : 'Inactive' ?></td>
                            <td class="py-3 px-6 text-center">
                                <a href="index.php?modul=role&fitur=update&role_id=<?= htmlspecialchars($role->role_id) ?>" class="bg-yellow-400 text-white px-3 py-1 rounded-full transform transition hover:scale-110 hover:bg-yellow-500">Update</a>
                                <button onclick="window.location.href='index.php?modul=role&fitur=delete&id=<?= htmlspecialchars($role->role_id) ?>'" class="bg-red-500 text-white px-3 py-1 rounded-full transform transition hover:scale-110 hover:bg-red-600">Delete</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
