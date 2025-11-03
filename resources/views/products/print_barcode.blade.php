<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode</title>
</head>
<body>
    <h1>Generated Barcode</h1>
    <!-- Menampilkan barcode SVG -->
    <div>
        <img src="{{ asset($barcodePath) }}" alt="Generated Barcode" />
    </div>
</body>
</html>
