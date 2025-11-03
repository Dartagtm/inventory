<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Produk - PT Big</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #2c3e50;
            color: white;
            padding: 1rem;
            text-align: center;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            margin-bottom: 20px;
        }
        .button {
            padding: 8px 16px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
        }
        .button:hover {
            background-color: #2980b9;
        }
        .button.danger {
            background-color: #e74c3c;
        }
        .button.danger:hover {
            background-color: #c0392b;
        }
        .product-actions {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            align-items: center;
        }
        .search-filter {
            display: flex;
            gap: 10px;
        }
        .search-filter input, 
        .search-filter select {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            min-width: 200px;
        }
        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .product-table th, 
        .product-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        .product-table th {
            background-color: #f2f2f2;
            font-weight: 600;
        }
        .product-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .product-table tr:hover {
            background-color: #f1f1f1;
        }
        .action-buttons {
            display: flex;
            gap: 5px;
        }
        .barcode-img {
            display: block; 
            height: 60px;
            width: 200px;
        }
        .no-products {
            text-align: button;
            padding: 90px;
            color: #666;
        }
    </style>
</head>
<body>
    <header>
        <h1>Daftar Produk</h1>
    </header>
    <div class="container">
        <div class="product-actions">
            <div class="flex space-x-4 mb-6">
            <a href="/products/create" class="button flex items-center">
                <i class="fas fa-plus mr-2"></i> Tambah Produk</a>
            </a>
            <a href="/products/updatestock" class="button flex items-center bg-green-600 hover:bg-green-700">
                <i class="fas fa-sync-alt mr-2"></i> Update Stok
            </a>
        </div>
            <div class="search-filter">
                <input type="text" placeholder="Cari produk..." id="product-search">
                <select id="category-filter">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <table class="product-table">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Stok</th>
                    <th>Barcode</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td data-category-id="{{ $product->category_id }}">{{ $product->category->name }}</td>
                    <td>{{ $product->location->name }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>
                        <img src="{{ asset('barcodes/' . $product->barcode . '.svg') }}"
                             alt="{{ $product->barcode }}" class="barcode-img">
                             {{ $product->barcode }} 
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('products.edit', $product->id) }}" class="button">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="no-products">Belum ada produk yang tersedia</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        // Simple search functionality
        document.getElementById('product-search').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('.product-table tbody tr');
            
            rows.forEach(row => {
                // Skip the "no products" row if it exists
                if (row.classList.contains('no-products')) return;
                
                const productName = row.cells[0].textContent.toLowerCase();
                if (productName.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Category filter functionality
        document.getElementById('category-filter').addEventListener('change', function() {
            const categoryId = this.value;
            const rows = document.querySelectorAll('.product-table tbody tr');
            let hasVisibleRows = false;
            
            rows.forEach(row => {
                // Skip the "no products" row if it exists
                if (row.classList.contains('no-products')) return;
                
                const rowCategoryId = row.cells[1].getAttribute('data-category-id');
                if (!categoryId || rowCategoryId === categoryId) {
                    row.style.display = '';
                    hasVisibleRows = true;
                } else {
                    row.style.display = 'none';
                }
            });

            // Show/hide "no products" message
            const noProductsRow = document.querySelector('.no-products');
            if (noProductsRow) {
                noProductsRow.style.display = hasVisibleRows ? 'none' : '';
            }
        });
    </script>
</body>
</html>
