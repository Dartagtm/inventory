<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Stock;

class StockController extends Controller
{
        public function index() {
        $totalStock = Stock::sum('quantity');
        return view('stocks.index', compact('totalStock'));
    }
    
}
