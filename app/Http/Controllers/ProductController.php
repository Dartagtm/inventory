<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Picqer\Barcode\BarcodeGeneratorSVG;
use App\Models\Product; // Import Product model
use App\Models\Category; // Import Category model
use App\Models\Location; // Import Location model
use App\Models\Transaction; // Import Transaction model

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::all(); // Fetch all products
        $categories = Category::all(); // Fetch all categories
        $locations = Location::all(); // Fetch all locations
        // Calculate total incoming and outgoing quantities
        $totalIncoming = Transaction::where('type', 'in')->sum('quantity');
        $totalOutgoing = Transaction::where('type', 'out')->sum('quantity');
         $orders = Order::with('store')->get(); // Fetch all orders with store relationship
        return view('products.index', [
            'products' => $product,
            'categories' => $categories,
            'locations' => $locations,
            'totalIncoming' => $totalIncoming,
            'totalOutgoing' => $totalOutgoing,
            'orders' => $orders
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        $locations = Location::all();
        return view('products.create', compact('categories', 'locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
            'barcode' => 'required|string|unique:products',
            'quantity' => 'required|integer'
        ]);
        
        // Create Barcode in SVG format
        $generator = new BarcodeGeneratorSVG();
        $barcode = $generator->getBarcode($request->barcode, $generator::TYPE_CODE_128);
        
        // Save barcode to 'public/barcodes'
        $barcodePath = 'barcodes/' . $request->barcode . '.svg';
        file_put_contents(public_path($barcodePath), $barcode);

        // Save product to database
        $validated['barcode_path'] = $barcodePath; // Save barcode path
        Product::create($validated);

        // Redirect to products index with success message
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $locations = Location::all();

        return view('products.edit', [
            'product' => $product,
            'categories' => $categories,
            'locations' => $locations
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function showUpdateStockForm()
    {
        $products = Product::with(['category', 'location'])->get(); // Ambil semua produk dengan kategori dan lokasi
        $categories = Category::all(); // Ambil semua kategori
        $locations = Location::all(); // Ambil semua lokasi

        return view('products.update_stock', compact('products', 'categories', 'locations'));
    }

public function updateStock(Request $request)
{
    $validated = $request->validate([
        'stock' => 'nullable|array',
        'stock.*.action' => 'required_with:stock.*.quantity|in:in,out', // Validate action
        'stock.*.quantity' => 'required_with:stock.*.action|integer|min:1', // Validate quantity
        'product_id' => 'required_without:stock|exists:products,id', // Validate product ID for individual updates
        'action' => 'required_without:stock|in:in,out', // Validate action for individual updates
        'quantity' => 'required_without:stock|integer|min:1', // Validate quantity for individual updates
    ]);

    if (isset($validated['stock'])) {
        foreach ($validated['stock'] as $productId => $data) {
            $product = Product::findOrFail($productId);
            $quantity = $data['quantity'];
            $action = $data['action'];

            // Update stock based on action
            if ($action === 'in') {
                $product->quantity += $quantity; // If incoming, add
            } elseif ($action === 'out') {
                $product->quantity -= $quantity; // If outgoing, subtract
            }

            // Ensure stock does not go negative
            if ($product->quantity < 0) {
                return response()->json(['success' => false, 'message' => 'Stok tidak boleh negatif.'], 400);
            }

            $product->save();
        }
    } else {
        // Handle individual update
        $product = Product::findOrFail($validated['product_id']);
        $quantity = $validated['quantity'];
        $action = $validated['action'];

        // Update stock based on action
        if ($action === 'in') {
            $product->quantity += $quantity; // If incoming, add
        } elseif ($action === 'out') {
            $product->quantity -= $quantity; // If outgoing, subtract
        }

        // Ensure stock does not go negative
        if ($product->quantity < 0) {
            return response()->json(['success' => false, 'message' => 'Stok tidak boleh negatif.'], 400);
        }

        $product->save();
    }

    return response()->json(['success' => true]); // Return JSON response
}





    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index');
    }

    public function recordTransaction(Request $request, $id)
    {
        // Validate input
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
            'type' => 'required|in:in,out', // Transaction type: 'in' for incoming, 'out' for outgoing
        ]);

        // Get product by ID
        $product = Product::findOrFail($id);

        // Update product stock based on transaction type
        if ($validated['type'] == 'in') {
            $product->quantity += $validated['quantity']; // Incoming stock
        } else {
            $product->quantity -= $validated['quantity']; // Outgoing stock
        }

        // Save changes to product
        $product->save();

        // Save transaction in the transactions table
        Transaction::create([
            'product_id' => $product->id,
            'type' => $validated['type'],
            'quantity' => $validated['quantity'],
            'barcode' => $product->barcode,
            'transaction_date' => now(),
        ]);

        return redirect()->route('products.index')->with('success', 'Transaction recorded successfully.');
    }

    public function printBarcode($id)
    {
        // Get product by ID
        $product = Product::findOrFail($id);

        // Create barcode using BarcodeGeneratorSVG
        $generator = new BarcodeGeneratorSVG();
        $barcode = $generator->getBarcode($product->barcode, $generator::TYPE_CODE_128);

        // Save barcode temporarily in public folder
        $barcodePath = 'barcodes/' . $product->barcode . '.svg';
        file_put_contents(public_path($barcodePath), $barcode);

        // Display barcode image on the page
        return view('products.print_barcode', compact('product', 'barcodePath'));
    }

    public function search(Request $request)
    {
        $validated = $request->validate([
            'barcode' => 'required|string',
        ]);

        // Search product by barcode
        $product = Product::where('barcode', $validated['barcode'])->first();

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Product not found');
        }

        return view('products.index', ['products' => [$product]]);
    }

    public function recordShipment(Request $request, $id)
    {
        // Validate input
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
            'destination' => 'required|string|max:255',
        ]);

        // Get product by ID
        $product = Product::findOrFail($id);

        // Check if the quantity shipped does not exceed available stock
        if ($product->quantity < $validated['quantity']) {
            return redirect()->route('products.index')->with('error', 'Not enough stock available for shipment');
        }

        // Decrease product stock
        $product->quantity -= $validated['quantity'];
        $product->save();

        // Save shipment data
        Shipment::create([
            'product_id' => $product->id,
            'quantity' => $validated['quantity'],
            'destination' => $validated['destination'],
            'shipped_at' => now(),
        ]);

        return redirect()->route('products.index')->with('success', 'Shipment recorded successfully.');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }
}
