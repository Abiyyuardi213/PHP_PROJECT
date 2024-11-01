<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
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
            <button class="bg-red-500 text-white px-4 py-2 rounded-full">Logout</button>
        </footer>
    </aside>

    <main class="flex-grow p-6">
        <header class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-700">Update User</h1>
        </header>

        <form method="POST" action="index.php?modul=user&fitur=update&user_id=<?php echo($user_id)?>" class="bg-white p-6 rounded-lg shadow-md">
            <input type="hidden" name="user_id" value="<?= htmlspecialchars($current_user->user_id) ?>">
            
            <div class="mb-4">
                <label class="block text-gray-700">User Name</label>
                <input type="text" name="user_name" class="w-full px-4 py-2 border rounded" value="<?= htmlspecialchars($current_user->user_name) ?>" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Username for Login</label>
                <input type="text" name="username" class="w-full px-4 py-2 border rounded" value="<?= htmlspecialchars($current_user->username) ?>" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Password</label>
                <input type="password" name="password" class="w-full px-4 py-2 border rounded" placeholder="Leave blank to keep current password">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Role</label>
                <select name="role_id" class="w-full px-4 py-2 border rounded">
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= htmlspecialchars($role->role_id) ?>" <?= ($current_user->role_id == $role->role_id) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($role->role_name) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="flex justify-end">
                <a href="index.php?modul=user&fitur=list" class="bg-gray-500 text-white px-4 py-2 rounded-full mr-4">Cancel</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-full">Update</button>
            </div>
        </form>
    </main>
</body>
</html>