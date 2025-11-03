<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Update Stok - PT Big</title>
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
    </style>
</head>
<body>
    <header>
        <h1>Update Stok Produk</h1>
    </header>
    <div class="container">
        <form id="update-stock-form">
            @csrf
            <div class="flex flex-wrap gap-4 mb-6">
                <div class="flex-1">
                    <label class="block font-medium mb-1">Cari Produk</label>
                    <input type="text" id="product-search" class="w-full border rounded px-3 py-2" placeholder="Nama produk...">
                </div>
                <div class="flex-1">
                    <label class="block font-medium mb-1">Filter Kategori</label>
                    <select id="category-filter" class="w-full border rounded px-3 py-2">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1">
                    <label class="block font-medium mb-1">Filter Lokasi</label>
                    <select id="location-filter" class="w-full border rounded px-3 py-2">
                        <option value="">Semua Lokasi</option>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Stok Saat Ini</th>
                            <th>Update Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td data-category-id="{{ $product->category->id }}">{{ $product->category->name }}</td>
                            <td data-location-id="{{ $product->location->id }}">{{ $product->location->name }}</td>
                            <td class="current-stock">{{ $product->quantity }}</td>
                            <td>
                                <div class="flex flex-col space-y-2">
                                    <div class="flex space-x-2">
                                        <select class="border rounded px-3 py-2 action-select" data-product-id="{{ $product->id }}" onchange="toggleInput(this)">
                                            <option value="">Pilih Aksi</option>
                                            <option value="in">Masuk</option>
                                            <option value="out">Keluar</option>
                                        </select>
                                        <input type="number" class="border rounded px-3 py-2 w-full focus:ring-2 focus:ring-blue-400 focus:border-blue-400 quantity-input hidden" 
                                               placeholder="Jumlah" min="1" oninput="validateStock(this, {{ $product->quantity }})" data-product-id="{{ $product->id }}">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button type="button" class="button mt-4" id="submit-all">Simpan Perubahan</button>
        </form>
    </div>

    <script>
        function toggleInput(select) {
            const input = select.nextElementSibling;
            input.classList.toggle('hidden', select.value === "");
        }

        function validateStock(input, currentStock) {
            const action = input.previousElementSibling.value;
            if (action === "out" && parseInt(input.value) > currentStock) {
                alert('Jumlah keluar tidak boleh lebih besar dari stok yang ada.');
                input.value = '';
            }
        }

        document.querySelectorAll('.action-select').forEach(select => {
            select.addEventListener('change', function() {
                const productId = this.getAttribute('data-product-id');
                const quantityInput = this.nextElementSibling;

                if (this.value && quantityInput.value) {
                    const quantity = quantityInput.value;

                    // Send AJAX request to update stock
                    fetch('/products/updatestock', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            action: this.value,
                            quantity: quantity
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Stok berhasil diperbarui!');
                            location.reload(); // Refresh the page to see the updated stock
                        } else {
                            alert('Terjadi kesalahan: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat memperbarui stok.');
                    });
                }
            });
        });

        document.getElementById('submit-all').addEventListener('click', function() {
            const stockData = {};
            const rows = document.querySelectorAll('.table tbody tr');

            rows.forEach(row => {
                const productId = row.querySelector('.action-select').getAttribute('data-product-id');
                const action = row.querySelector('.action-select').value;
                const quantity = row.querySelector('.quantity-input').value;

                if (action && quantity) {
                    stockData[productId] = {
                        action: action,
                        quantity: quantity
                    };
                }
            });

            if (Object.keys(stockData).length === 0) {
                alert('Tidak ada perubahan untuk disimpan.');
                return;
            }

            // Send AJAX request to update all stocks
            fetch('/products/updatestock', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ stock: stockData })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Semua stok berhasil diperbarui!');
                    location.reload(); // Refresh the page to see the updated stock
                } else {
                    alert('Terjadi kesalahan: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memperbarui stok.');
            });
        });

        document.getElementById('product-search').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('.table tbody tr');

            rows.forEach(row => {
                const productName = row.cells[0].textContent.toLowerCase();
                row.style.display = productName.includes(searchTerm) ? '' : 'none';
            });
        });

        document.getElementById('category-filter').addEventListener('change', updateFilters);
        document.getElementById('location-filter').addEventListener('change', updateFilters);

        function updateFilters() {
            const categoryId = document.getElementById('category-filter').value;
            const locationId = document.getElementById('location-filter').value;
            const rows = document.querySelectorAll('.table tbody tr');

            rows.forEach(row => {
                const rowCategoryId = row.cells[1].getAttribute('data-category-id');
                const rowLocationId = row.cells[2].getAttribute('data-location-id');
                
                const categoryMatch = categoryId === "" || rowCategoryId === categoryId;
                const locationMatch = locationId === "" || rowLocationId === locationId;
                
                row.style.display = (categoryMatch && locationMatch) ? '' : 'none';
            });
        }
    </script>
</body>
</html>
