<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Admin - PT Big</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }
        header {
            background: linear-gradient(to right, #1e3a8a, #2563eb);
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .container {
            max-width: 1400px;
            margin: 30px auto;
            padding: 25px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        h1 {
            margin-bottom: 20px;
        }
        .button {
            padding: 10px 20px;
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .button:hover {
            background-color: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        .stat {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s;
        }
        .stat:hover {
            transform: translateY(-5px);
        }
        .chart-container {
            margin-top: 20px;
            padding: 16px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            max-height: 300px;
        }
        .chart-container canvas {
            max-height: 250px;
            width: 100% !important;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        .table th {
            background-color: #1e3a8a; /* Dark blue background for header */
            color: #000000; /* Set header text color to black for better visibility */
        }
        .table tr:hover {
            background-color: #f0f9ff;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .stat i {
            color: #3b82f6;
            margin-bottom: 10px;
        }
        .stat div span {
            font-weight: 600;
            font-size: 1.2rem;
            color: #1e3a8a;
        }
    </style>
</head>
<body>
    <header class="sticky top-0 z-50">
        <div class="flex items-center space-x-4">
            <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center">
                <i class="fas fa-box text-blue-600"></i>
            </div>
            <h1 class="text-xl font-semibold">PT Big - Inventory Dashboard</h1>
        </div>
        <div class="flex items-center space-x-6">
            <div class="flex items-center space-x-2">
                <div class="relative">
                    <i class="fas fa-bell text-gray-200 hover:text-white cursor-pointer"></i>
                    <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full"></span>
                </div>
                <i class="fas fa-question-circle text-gray-200 hover:text-white cursor-pointer"></i>
            </div>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-3 bg-blue-900 bg-opacity-30 px-4 py-2 rounded-full">
                    <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/96f43f31-e551-4ee1-ae9c-282705ebe37e.png" alt="Profile" class="w-8 h-8 rounded-full object-cover">
                    <span class="text-sm font-medium">{{ auth()->user()->name ?? 'Admin' }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-gray-300 hover:text-white">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    <div class="container">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="stat" id="total-items">
                <i class="fas fa-boxes text-3xl"></i>
                <div>Total Barang: <span>{{ $products->sum('quantity') }}</span></div>
            </div>
            <div class="stat" id="total-incoming">
                <i class="fas fa-arrow-up text-3xl"></i>
                <div>Barang Masuk: <span>{{ $totalIncoming }}</span></div>
            </div>
            <div class="stat" id="total-items-out">
                <i class="fas fa-truck-moving text-3xl"></i>
                <div>Barang Keluar: <span>{{ $totalOutgoing }}</span></div>
            </div>
        </div> 

        <div class="flex space-x-4 mb-6">
            <a href="/products/create" class="button flex items-center">
                <i class="fas fa-plus mr-2"></i> Tambah Produk</a>
            </a>
            <a href="/products/updatestock" class="button flex items-center bg-green-600 hover:bg-green-700">
                <i class="fas fa-sync-alt mr-2"></i> Update Stok
            </a>
            <button class="button flex items-center" id="print-barcode">
                <i class="fas fa-print mr-2"></i> Cetak Barcode
            </button>
        </div>

        <h2>Daftar Produk</h2>
        <div class="table-responsive">
            <table class="table" id="product-table">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Lokasi Gudang</th>
                        <th>Kategori</th>
                        <th>Singkatan</th>
                        <th>Quantity</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products->take(5) as $product) <!-- Display only the 5 most recent products -->
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->location->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->barcode }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex justify-end mb-4">
            <a href="/products" class="button">Produk Lainnya</a> <!-- Button for more products -->
        </div>

        <div class="chart-container">
            <h2>Grafik Barang Masuk dan Keluar</h2>
            <canvas id="incomingOutgoingChart" height="250"></canvas>
        </div>

        <div class="dashboard-section">
            <h2>Recent Inventory Activities</h2>
            <div class="table-responsive">
                <table class="table" id="activity-table">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>Aktivitas</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentActivities as $activity)
                        <tr>
                            <td>{{ $activity->created_at }}</td>
                            <td>{{ $activity->type == 'in' ? 'Barang Masuk' : 'Barang Keluar' }}</td>
                            <td>{{ $activity->product->name ?? 'Product not found' }} - {{ $activity->quantity }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="dashboard-section">
            <h2>Pesanan untuk Pengiriman</h2>
            <div class="table-responsive">
                <table class="table" id="order-table">
                    <thead>
                        <tr>
                            <th>No. Pesanan</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>No. Plat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->product->name ?? 'Product not found' }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>
                                <input type="text" placeholder="No. Plat" class="border rounded p-1" id="plat-{{ $order->id }}" />
                            </td>
                            <td>
                                <button class="button" onclick="processOrder('{{ $order->id }}')">Muat</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Initialize Chart
        function initChart() {
            const incomingOutgoingCtx = document.getElementById('incomingOutgoingChart').getContext('2d');

            // Create Incoming and Outgoing Chart
            const incomingOutgoingChart = new Chart(incomingOutgoingCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'], // Update labels accordingly
                    datasets: [
                        {
                            label: 'Barang Masuk',
                            data: [30, 50, 40, 60, 70, 80, 90], // Sample data, replace with actual data
                            borderColor: 'rgba(46, 204, 113, 1)',
                            backgroundColor: 'rgba(46, 204, 113, 0.2)',
                            fill: true,
                        },
                        {
                            label: 'Barang Keluar',
                            data: [20, 30, 25, 40, 50, 60, 70], // Sample data, replace with actual data
                            borderColor: 'rgba(231, 76, 60, 1)',
                            backgroundColor: 'rgba(231, 76, 60, 0.2)',
                            fill: true,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Function to process order
        function processOrder(orderId) {
            const platInput = document.getElementById(`plat-${orderId}`);
            if (platInput.value.trim() === "") {
                alert("Silakan isi No. Plat sebelum memproses.");
                return;
            }
            // Change button text to "Proses"
            const button = platInput.closest('tr').querySelector('button');
            button.textContent = "Proses";
            button.disabled = true; // Disable the button after processing
            // Additional processing logic can be added here
        }

        // Show loading state
        document.addEventListener('DOMContentLoaded', function() {
            const loadingEl = document.createElement('div');
            loadingEl.className = 'fixed inset-0 bg-white bg-opacity-75 flex items-center justify-center z-50';
            loadingEl.innerHTML = '<div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>';
            document.body.appendChild(loadingEl);
            
            // Simulate data loading
            setTimeout(() => {
                loadingEl.remove();
                initChart();
            }, 1500);
        });
    </script>
</body>
</html>
