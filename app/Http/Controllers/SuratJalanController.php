<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order; // Assuming you have an Order model
use Illuminate\Http\Request;

class SuratJalanController extends Controller
{
    public function index()
    {
        // Fetch all products
        $products = Product::all(); 
        // Fetch all orders with product details
        $orders = Order::with('product')->get(); 
        return view('surat_jalan.dashboard', compact('products', 'orders')); // Pass products and orders to the view
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'store_location' => 'required|string|max:255',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        foreach ($request->products as $productData) {
            // Find the product by ID
            $product = Product::findOrFail($productData['product_id']);

            // Check if the requested quantity is available in stock
            if ($productData['quantity'] > $product->quantity) {
                return redirect()->back()->withErrors(['quantity' => 'Requested quantity exceeds available stock for product ' . $product->name]);
            }

            // Generate a unique order number
            $orderNumber = $this->generateOrderNumber();

            // Create the order
            Order::create([
                'order_number' => $orderNumber, // Set the generated order number
                'product_id' => $productData['product_id'],
                'quantity' => $productData['quantity'],
                'store_location' => $request->store_location,
                'status' => 'pending', // Set initial status
            ]);

            // Update product quantity
            $product->decrement('quantity', $productData['quantity']);
        }

        // Redirect back with success message
        return redirect()->route('surat_jalan.dashboard')->with('success', 'Orders created successfully!');
    }

    /**
     * Generate a unique order number.
     *
     * @return string
     */
    private function generateOrderNumber()
    {
        return 'ORD-' . strtoupper(uniqid());
    }
}
