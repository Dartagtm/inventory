<?php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Product; // Import Product model
    use App\Models\Category; // Import Category model
    use App\Models\Location; // Import Location model
    use App\Models\Transaction; // Import Transaction model
    use App\Models\Order; // Import Order model

    class AdminController extends Controller
    {
        public function dashboard()
        {
            // Fetch all products
            $products = Product::all();
            
            // Calculate total incoming and outgoing quantities
            $totalIncoming = Transaction::where('type', 'in')->sum('quantity');
            $totalOutgoing = Transaction::where('type', 'out')->sum('quantity');
            
            // Fetch recent inventory activities (last 10 activities)
            $recentActivities = Transaction::with('product')
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();
            
            // Fetch delivery orders
            $orders = Order::all(); // Adjust this query as needed
            
            // Fetch data for the chart (example for the last 7 days)
            $incomingData = Transaction::where('type', 'in')
                ->whereDate('created_at', '>=', now()->subDays(7))
                ->selectRaw('DATE(created_at) as date, SUM(quantity) as total')
                ->groupBy('date')
                ->pluck('total');
            $outgoingData = Transaction::where('type', 'out')
                ->whereDate('created_at', '>=', now()->subDays(7))
                ->selectRaw('DATE(created_at) as date, SUM(quantity) as total')
                ->groupBy('date')
                ->pluck('total');
            
            return view('admin.dashboard', [
                'products' => $products,
                'totalIncoming' => $totalIncoming,
                'totalOutgoing' => $totalOutgoing,
                'incomingData' => $incomingData,
                'outgoingData' => $outgoingData,
                'recentActivities' => $recentActivities, // Pass recentActivities to the view
                'orders' => $orders, // Pass orders to the view
            ]);
            return view('admin.dashboard');
        }

    }
    