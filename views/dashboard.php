<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/@heroicons/react@1.0.6/solid" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <span>Manage Users</span>
            </a>
            <a href="index.php?modul=barang&fitur=list" class="flex items-center gap-2 py-3 px-4 rounded-lg hover:bg-indigo-700 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M4 3a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V4a1 1 0 00-1-1H4zm0 2h12v3H4V5zm0 5h12v5H4v-5z"/>
                </svg>
                <span>Inventory</span>
            </a>
            <a href="index.php?modul=transaksi&fitur=list" class="flex items-center gap-2 py-3 px-4 rounded-lg hover:bg-indigo-700 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M6 2a1 1 0 00-1 1v12a1 1 0 001 1h8a1 1 0 001-1V4a1 1 0 00-1-1H6zM7 4h6v12H7V4zM9 9.5A1.5 1.5 0 1110.5 8 1.5 1.5 0 009 9.5zm3 3a1.5 1.5 0 10-1.5-1.5 1.5 1.5 0 001.5 1.5z"/>
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

        <!-- Charts Section -->
        <section class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-5">
            <!-- Product Sales Chart -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <canvas id="salesChart"></canvas>
            </div>
            <div class="bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 p-6 rounded-lg shadow-xl transform hover:scale-105 transition-all duration-300">
                <h2 class="text-2xl font-semibold text-white mb-4">Product Sales Overview</h2>
                <div class="flex justify-between items-center mb-4 text-white">
                    <span class="text-sm">Last 6 months</span>
                    <button class="px-4 py-2 bg-white text-black rounded-lg shadow-md hover:bg-gray-200 transition duration-300">Refresh</button>
                </div>
                <canvas id="myChart"></canvas>
            </div>
        </section>

        <!-- Dashboard Container -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-5">
            <!-- Manage Role Card -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:bg-indigo-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-indigo-600 mb-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v2.5a4.5 4.5 0 114.5 4.5h-.5a1 1 0 110-2h.5a2.5 2.5 0 00-2.5-2.5V3a1 1 0 011-1z" clip-rule="evenodd"/>
                </svg>
                <h2 class="text-xl font-semibold text-gray-800">Manage Roles</h2>
                <p class="mt-2 text-gray-600">Create, edit, and manage roles for users.</p>
                <a href="index.php?modul=role&fitur=list" class="inline-block mt-3 px-6 py-2 bg-indigo-600 text-white rounded-lg shadow-md hover:bg-indigo-700 transform transition hover:scale-105">
                    Go to Role Management
                </a>
            </div>

            <!-- Manage User Card -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:bg-indigo-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-indigo-600 mb-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 2a2 2 0 100-4 2 2 0 000 4zm-6 8a6 6 0 1112 0H4z" clip-rule="evenodd"/>
                </svg>
                <h2 class="text-xl font-semibold text-gray-800">Manage Users</h2>
                <p class="mt-2 text-gray-600">Create, edit, and manage users in the system.</p>
                <a href="index.php?modul=user&fitur=list" class="inline-block mt-3 px-6 py-2 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700 transform transition hover:scale-105">
                    Go to User Management
                </a>
            </div>

            <!-- Inventory Card -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:bg-indigo-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-indigo-600 mb-4" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M4 3a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V4a1 1 0 00-1-1H4zm0 2h12v3H4V5zm0 5h12v5H4v-5z"/>
                </svg>
                <h2 class="text-xl font-semibold text-gray-800">Manage Inventory</h2>
                <p class="mt-2 text-gray-600">Add, update, and track inventory items.</p>
                <a href="index.php?modul=barang&fitur=list" class="inline-block mt-3 px-6 py-2 bg-yellow-600 text-white rounded-lg shadow-md hover:bg-yellow-700 transform transition hover:scale-105">
                    Go to Inventory
                </a>
            </div>

            <!-- Transaction Card -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:bg-indigo-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-indigo-600 mb-4" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M6 2a1 1 0 00-1 1v12a1 1 0 001 1h8a1 1 0 001-1V4a1 1 0 00-1-1H6zM7 4h6v12H7V4zM9 9.5A1.5 1.5 0 1110.5 8 1.5 1.5 0 009 9.5zm3 3a1.5 1.5 0 10-1.5-1.5 1.5 1.5 0 001.5 1.5z"/>
                </svg>
                <h2 class="text-xl font-semibold text-gray-800">Manage Transactions</h2>
                <p class="mt-2 text-gray-600">Track all product transactions with real-time updates.</p>
                <a href="index.php?modul=transaksi&fitur=list" class="inline-block mt-3 px-6 py-2 bg-red-600 text-white rounded-lg shadow-md hover:bg-red-700 transform transition hover:scale-105">
                    Go to Transaction Management
                </a>
            </div>
        </div>

    <script>
        var ctx = document.getElementById('salesChart').getContext('2d');
        var salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Product Sales',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' sales';
                            }
                        }
                    }
                }
            }
        });
    </script>
    <script>
        // Chart.js Script
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',  // Change to 'line' for a line chart
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Product Sales',
                    data: [12, 19, 3, 5, 2, 3],
                    fill: false,
                    borderColor: 'rgba(255, 255, 255, 0.8)',  // White border color for better contrast
                    tension: 0.1,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.2)',  // White gridlines
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.2)',  // White gridlines
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: 'white'  // Set legend text color to white
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.7)',
                        bodyColor: 'white',
                        titleColor: 'white',
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' sales';
                            }
                        }
                    }
                },
                animation: {
                    duration: 1000,  // Duration of animation when the chart appears
                    easing: 'easeInOutQuart'
                }
            }
        });
    </script>
</body>
</html>
