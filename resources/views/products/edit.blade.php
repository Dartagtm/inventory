<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Produk - PT Big</title>
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
            max-width: 600px;
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
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #2980b9;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .barcode-display {
            margin-top: 10px;
            text-align: center;
            padding: 15px;
            border: 1px dashed #3498db;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .barcode-text {
            margin-top: 10px;
            font-family: monospace;
            font-size: 16px;
            color: #2c3e50;
            font-weight: bold;
        }
        .barcode-img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <header>
        <h1>Edit Produk</h1>
    </header>
    <div class="container">
        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="product-name">Nama Produk</label>
                <input type="text" name="name" id="product-name" value="{{ $product->name }}" required>
            </div>

            <div class="form-group">
                <label for="category_id">Kategori</label>
                <select name="category_id" id="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="location_id">Lokasi</label>
                <select name="location_id" id="location_id" required>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}" {{ $location->id == $product->location_id ? 'selected' : '' }}>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="quantity">Jumlah Stok:</label>
                <input type="number" name="quantity" id="quantity" value="{{ $product->quantity }}" required min="0">
            </div>

            <div class="form-group">
                <label>Barcode Produk:</label>
                <div class="barcode-display">
                    <img src="https://barcode.tec-it.com/barcode.ashx?data={{ $product->barcode }}&code=Code128&dpi=96&imagetype=Gif" 
                         alt="{{ $product->barcode }}" class="barcode-img">
                    <p class="barcode-text">{{ $product->barcode }}</p>
                </div>
            </div>

            <button type="submit" class="button">Simpan Perubahan</button>
            @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
        </form>
    </div>
</body>
</html>
