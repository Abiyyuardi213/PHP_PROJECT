<?php
$users = $obj_user->getAllUsers();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/@heroicons/react@1.0.6/solid" defer></script>
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
                    <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h4a1 1 0 100-2H4V6h12v8h-3a1 1 0 100 2h4a1 1 0 001-1V5a1 1 0 00-1-1H3z"/>
                    <path d="M9 12a1 1 0 01.707-.293h.586a1 1 0 01.707.293l4 4a1 1 0 01-1.414 1.414L10 14.414l-2.293 2.293a1 1 0 01-1.414-1.414l4-4z"/>
                </svg>
                <span>Manage Role</span>
            </a>
            <a href="index.php?modul=user&fitur=list" class="flex items-center gap-2 py-3 px-4 rounded-lg hover:bg-indigo-700 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h4a1 1 0 100-2H4V6h12v8h-3a1 1 0 100 2h4a1 1 0 001-1V5a1 1 0 00-1-1H3z"/>
                    <path d="M9 12a1 1 0 01.707-.293h.586a1 1 0 01.707.293l4 4a1 1 0 01-1.414 1.414L10 14.414l-2.293 2.293a1 1 0 01-1.414-1.414l4-4z"/>
                </svg>
                <span>Manage User</span>
            </a>
        </nav>
        <footer class="p-4 text-center mt-auto">
            <button class="bg-red-500 text-white px-4 py-2 rounded-full transform transition hover:scale-105 hover:shadow-lg">Logout</button>
        </footer>
    </aside>

    <main class="flex-grow p-6">
        <header class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-700">Manage User</h1>
        </header>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                <?= htmlspecialchars($_SESSION['message']) ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <div class="mb-4 flex justify-end">
            <a href="index.php?modul=user&fitur=add" class="bg-gradient-to-r from-green-400 to-green-500 text-white px-5 py-2 rounded-full shadow-md transform transition hover:scale-105 hover:shadow-lg">
                Add New User
            </a>
        </div>
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
            <table class="min-w-full bg-white">
                <thead class="bg-indigo-100 text-indigo-600 uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">User ID</th>
                        <th class="py-3 px-6 text-left">User Name</th>
                        <th class="py-3 px-6 text-left">Username</th>
                        <th class="py-3 px-6 text-left">Password</th>
                        <th class="py-3 px-6 text-left">Role Name</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <?php if (empty($users)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">No users found</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($users as $user): ?>
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($user->user_id) ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($user->user_name) ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($user->username) ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($user->password) ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($obj_role->getRoleNameById($user->role_id)) ?></td> <!-- Menampilkan nama role -->
                            <td class="py-3 px-6 text-center">
                                <a href="index.php?modul=user&fitur=update&user_id=<?= htmlspecialchars($user->user_id) ?>" class="bg-yellow-400 text-white px-3 py-1 rounded-full transform transition hover:scale-110 hover:bg-yellow-500">Update</a>
                                <button onclick="window.location.href='index.php?modul=user&fitur=delete&id=<?= htmlspecialchars($user->user_id) ?>'" class="bg-red-500 text-white px-3 py-1 rounded-full transform transition hover:scale-110 hover:bg-red-600">Delete</button>
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