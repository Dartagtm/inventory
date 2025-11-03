<?php

namespace App\Http\Controllers;
use App\Models\Order; // Import the Order model
use Illuminate\Http\Request;
class GudangmuatController extends Controller
{
    public function showWarehouseLoadPage()
    {
        // Fetch all orders with their associated product details
        $orders = Order::with('product')->get(); // Assuming 'product' is the relationship in the Order model
        return view('gudang_muat.dashboard', compact('orders')); // Pass the orders to the view
    }
}