<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manajemen Produk - PT Big</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: #333;
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
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-bottom: 20px;
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
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .barcode-preview {
            margin-top: 20px;
            padding: 10px;
            border: 1px dashed #3498db;
            text-align: center;
            font-size: 1.2rem;
            color: #3498db;
        }
        .barcode-image {
            margin-top: 20px;
            text-align: center;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <header>
        <h1>Manajemen Produk</h1>
    </header>
    <div class="container">
        <form action="{{ route('products.store') }}" method="POST" id="product-form">
            @csrf
            <div class="form-group">
                <label for="product-name">Nama Produk</label>
                <input type="text" name="name" id="product-name" required>
            </div>
            <div class="form-group">
                <label for="category_id">Kategori</label>
                <select name="category_id" id="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="location_id">Lokasi</label>
                <select name="location_id" id="location_id" required>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="barcode">Barcode:</label>
                <input type="text" name="barcode" id="barcode" readonly>
            </div>
            <div class="barcode-preview" id="barcode-preview"></div>
            <div class="barcode-image" id="barcode-image"></div>
            <div class="form-group">
                <label for="quantity">Jumlah:</label>
                <input type="number" name="quantity" id="quantity" required>
            </div>
            <button type="submit" class="button">Simpan Produk</button>
        </form>
    </div>

    <script>
        // Function to generate abbreviation from product name
        function generateAbbreviation(name) {
            return name.split(' ')
                      .map(word => word.charAt(0).toLowerCase())
                      .join('');
        }

        // Auto-update barcode when product name changes
        document.getElementById('product-name').addEventListener('input', function() {
            const name = this.value.trim();
            if (name) {
                const abbreviation = generateAbbreviation(name);
                const location = document.getElementById('location_id').value;
                const category = document.getElementById('category_id').value;
                const uniqueCode = Math.floor(10000000 + Math.random() * 90000000);
                const barcode = `${location}-${category}-${abbreviation}-${uniqueCode}`;
                document.getElementById('barcode').value = barcode;
                document.getElementById('barcode-preview').textContent = `Barcode: ${barcode}`;
                generateBarcodeImage(barcode);
            }
        });

        // Function to generate barcode image
        function generateBarcodeImage(barcode) {
            const barcodeImage = document.getElementById('barcode-image');
            barcodeImage.innerHTML = `<img src="https://barcode.tec-it.com/barcode.ashx?data=${barcode}&code=Code128&dpi=96" alt="Barcode" />`;
        }
    </script>
</body>
</html>
