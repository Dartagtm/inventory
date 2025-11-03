<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product; // Import Product model
use App\Models\Category; // Import Category model
use App\Models\Location; // Import Location model
use App\Models\Transaction; // Import Transaction model
class AdminController extends Controller
{
    public function dashboard()
    {
        $products = Product::all();
        $totalIncoming = Transaction::where('type', 'in')->sum('quantity');
        $totalOutgoing = Transaction::where('type', 'out')->sum('quantity');
        return view('admin.dashboard', [
            'products' => $products,
            'totalIncoming' => $totalIncoming,
            'totalOutgoing' => $totalOutgoing,
        ]);
    }
}