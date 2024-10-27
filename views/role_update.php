<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Role</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-b from-blue-700 to-indigo-800 text-white min-h-screen flex flex-col shadow-lg">
        <div class="p-6 text-center">
            <h2 class="text-3xl font-bold mb-4">Warehouse Management System</h2>
        </div>
        <nav class="flex-grow px-4">
            <a href="index.php?modul=dashboard" class="flex items-center gap-2 py-3 px-4 rounded-lg hover:bg-indigo-700 transition-colors">
                <span>Dashboard</span>
            </a>
            <a href="index.php?modul=role&fitur=list" class="flex items-center gap-2 py-3 px-4 rounded-lg hover:bg-indigo-700 transition-colors">
                <span>Manage Role</span>
            </a>
            <a href="#" class="flex items-center gap-2 py-3 px-4 rounded-lg hover:bg-indigo-700 transition-colors">
                <span>Manage User</span>
            </a>
        </nav>
        <footer class="p-4 text-center mt-auto">
            <button class="bg-red-500 text-white px-4 py-2 rounded-full">Logout</button>
        </footer>
    </aside>

    <!-- Main Content -->
    <main class="flex-grow p-6">
        <header class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-700">Update Role</h1>
        </header>

        <!-- Update Role Form -->
        <form method="POST" class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label class="block text-gray-700">Role Name</label>
                <input type="text" name="role_name" class="w-full px-4 py-2 border rounded" value="<?= htmlspecialchars($current_role->role_name) ?>" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Role Description</label>
                <input type="text" name="role_description" class="w-full px-4 py-2 border rounded" value="<?= htmlspecialchars($current_role->role_description) ?>" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Role Salary</label>
                <input type="number" name="role_salary" class="w-full px-4 py-2 border rounded" value="<?= htmlspecialchars($current_role->role_salary) ?>" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Role Status</label>
                <select name="role_status" class="w-full px-4 py-2 border rounded">
                    <option value="1" <?= $current_role->role_status == 1 ? 'selected' : '' ?>>Active</option>
                    <option value="0" <?= $current_role->role_status == 0 ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>
            <div class="flex justify-end">
                <a href="index.php?modul=role&fitur=list" class="bg-gray-500 text-white px-4 py-2 rounded-full mr-4">Cancel</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-full">Update</button>
            </div>
        </form>
    </main>

</body>
</html>
