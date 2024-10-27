<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Role</title>
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
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-grow p-6">
        <header class="mb-6 flex justify-between items-center">
            <h1 class="text-3xl font-semibold text-gray-700">Add New Role</h1>
            <a href="index.php?modul=role&fitur=list" class="bg-gray-500 text-white px-4 py-2 rounded-lg">Back to Role List</a>
        </header>

        <form action="index.php?modul=role&fitur=add" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label for="role_name" class="block text-gray-700">Role Name</label>
                <input type="text" id="role_name" name="role_name" class="mt-2 p-2 w-full border border-gray-300 rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="role_description" class="block text-gray-700">Role Description</label>
                <textarea id="role_description" name="role_description" class="mt-2 p-2 w-full border border-gray-300 rounded-lg" required></textarea>
            </div>
            <div class="mb-4">
                <label for="role_salary" class="block text-gray-700">Role Salary</label>
                <input type="number" id="role_salary" name="role_salary" class="mt-2 p-2 w-full border border-gray-300 rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="role_status" class="block text-gray-700">Role Status</label>
                <select id="role_status" name="role_status" class="mt-2 p-2 w-full border border-gray-300 rounded-lg" required>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Add Role</button>
        </form>
    </main>
</body>
</html>
