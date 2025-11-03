<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - PT Big</title>
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
    </style>
</head>
<body>
    <header>
        <h1 class="text-xl font-semibold">PT Big - Inventory Dashboard</h1>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="text-white">Dashboard</a>
            <a href="{{ route('products.index') }}" class="text-white">Produk</a>
            <a href="{{ route('products.create') }}" class="text-white">Tambah Produk</a>
            <a href="{{ route('products.showUpdateStockForm') }}" class="text-white">Update Stok</a>
        </nav>
    </header>
    <div class="container">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                <p>{{ session('success') }}</p>
            </div>
        @endif
        @yield('content')
    </div>
</body>
</html>