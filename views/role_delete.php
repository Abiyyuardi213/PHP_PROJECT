<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        // Simulasi penghapusan role (ganti dengan logika penghapusan Anda)
        function deleteRole() {
            // Tambahkan logika penghapusan di sini

            // Tampilkan pesan sukses
            alert("Data role berhasil dihapus.");

            // Arahkan ke halaman role_list.php setelah 2 detik
            setTimeout(() => {
                window.location.href = "role_list.php"; // Ganti dengan nama file yang sesuai
            }, 2000);
        }

        // Panggil fungsi deleteRole ketika halaman dimuat
        window.onload = deleteRole;
    </script>
</head>
<body class="bg-gray-100 flex">
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
                <span>Inventory</span>
            </a>
        </nav>
        <footer class="p-4 text-center mt-auto">
            <button class="bg-red-500 text-white px-4 py-2 rounded-full transform transition hover:scale-105 hover:shadow-lg">Logout</button>
        </footer>
    </aside>

    <!-- Main Content -->
    <main class="flex-grow p-6">
        <header class="mb-6">
            <h1 class="text-3xl font-semibold text-gray-700">Deleting Role...</h1>
        </header>
    </main>
</body>
</html>
