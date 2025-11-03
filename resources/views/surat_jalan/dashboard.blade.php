<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Surat Jalan - PT Big</title>
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
            font-size: 1.5rem;
            font-weight: bold;
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
            background-color: #1e3a8a;
            color: white;
        }
        .table tr:hover {
            background-color: #f0f9ff;
        }
        .logout-button {
            background-color: #e3342f; /* Red color for logout */
            margin-left: auto; /* Push to the right */
        }
    </style>
</head>
<body>
    <header>
        <h1>Input Surat Jalan</h1>
        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="button logout-button">Logout</button>
        </form>
    </header>
    <div class="container">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <form action="{{ route('surat_jalan.store') }}" method="POST" id="order-form">
            @csrf
            <div class="flex flex-wrap gap-4 mb-6">
                <div class="flex-1">
                    <label class="block font-medium mb-1">Nama Toko</label>
                    <input type="text" name="store_location" class="w-full border rounded px-3 py-2" placeholder="Nama Toko" required>
                </div>
            </div>

            <div id="product-fields">
                <div class="flex flex-wrap gap-4 mb-6 product-entry">
                    <div class="flex-1">
                        <label class="block font-medium mb-1">Pilih Produk</label>
                        <select name="products[0][product_id]" class="w-full border rounded px-3 py-2" required>
                            <option value="">-- Pilih Produk --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }} (Stok: {{ $product->quantity }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-1">
                        <label class="block font-medium mb-1">Jumlah Pesanan</label>
                        <input type="number" name="products[0][quantity]" class="w-full border rounded px-3 py-2" placeholder="Jumlah" min="1" required>
                    </div>
                    <div class="flex-1">
                        <button type="button" class="button remove-product" style="margin-top: 30px;">Hapus</button>
                    </div>
                </div>
            </div>

            <button type="button" class="button" id="add-product">Tambah Produk</button>
            <button type="submit" class="button">Kirim Pesanan</button>
        </form>

        <h2 class="mt-8">Log Pembuatan Surat Jalan</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>No. Pesanan</th>
                    <th>Nama Toko</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->store_location }}</td>
                    <td>{{ $order->product ? $order->product->name : 'Produk tidak ditemukan' }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('add-product').addEventListener('click', function() {
            const productFields = document.getElementById('product-fields');
            const productCount = productFields.getElementsByClassName('product-entry').length;

            const newProductEntry = document.createElement('div');
            newProductEntry.className = 'flex flex-wrap gap-4 mb-6 product-entry';
            newProductEntry.innerHTML = `
                <div class="flex-1">
                    <label class="block font-medium mb-1">Pilih Produk</label>
                    <select name="products[${productCount}][product_id]" class="w-full border rounded px-3 py-2" required>
                        <option value="">-- Pilih Produk --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} (Stok: {{ $product->quantity }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1">
                    <label class="block font-medium mb-1">Jumlah Pesanan</label>
                    <input type="number" name="products[${productCount}][quantity]" class="w-full border rounded px-3 py-2" placeholder="Jumlah" min="1" required>
                </div>
                <div class="flex-1">
                    <button type="button" class="button remove-product" style="margin-top: 30px;">Hapus</button>
                </div>
            `;
            productFields.appendChild(newProductEntry);
        });

        document.getElementById('product-fields').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-product')) {
                e.target.closest('.product-entry').remove();
            }
        });
    </script>
</body>
</html>
