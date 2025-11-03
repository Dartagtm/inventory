<?php

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\GudangmuatController;
use App\Http\Controllers\SuratJalanController;
use App\Http\Controllers\DeliveryOrderController;
use App\Http\Controllers\GudangMuatDashboardController; // Ensure this is correct
use App\Http\Controllers\SuratJalanDashboardController; // Ensure this is correct
use App\Http\Controllers\MDTController;

// Halaman utama
Route::get('/', function () {
    $products = Product::all();
    return view('welcome', compact('products'));
});

Route::get('/mdt', [MDTController::class, 'landing'])->name('mdt.landing');
Route::get('/mdt/hospital-dashboard', [MDTController::class, 'hospitalDashboard'])->name('mdt.hospital');
Route::get('/mdt/patient-dashboard', [MDTController::class, 'patientDashboard'])->name('mdt.patient');

// Rute untuk update stok produk
Route::get('/products/updatestock', [ProductController::class, 'showUpdateStockForm'])->name('products.updatestock');
Route::post('/products/updatestock', [ProductController::class, 'updateStock'])->name('products.updateStock');

Route::get('/gudangmuat', [GudangmuatController::class, 'showWarehouseLoadPage'])->name('gudang_muat.dashboard');

// Rute dashboard
Route::get('/dashboard', [HomeController::class, 'index'])->middleware('auth')->name('dashboard');

// Rute terkait profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute untuk manajemen kategori, lokasi, dan produk
    Route::resource('categories', CategoryController::class);
    Route::resource('locations', LocationController::class);
    Route::resource('products', ProductController::class);

    // Rute tambahan untuk produk
    Route::get('products/{id}/print-barcode', [ProductController::class, 'printBarcode'])->name('products.printBarcode');
    Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
    Route::post('products/{id}/shipment', [ProductController::class, 'recordShipment'])->name('products.recordShipment');
});

// Rute transaksi
Route::get('transactions', function() {
    $transactions = Transaction::with('product')->get();
    return view('transactions.index', compact('transactions'));
})->name('transactions.index');

// Rute untuk stok
Route::get('/products/stock', [ProductController::class, 'getStock']);
Route::get('/stocks', [StockController::class, 'index'])->middleware('auth');

// Load routes untuk autentikasi
require __DIR__.'/auth.php';

// Rute tambahan untuk home dan admin dashboard
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware('auth')->name('admin.dashboard');

// Rute untuk gudang muat dan surat jalan dashboard
Route::get('/gudangmuat/dashboard', [GudangMuatDashboardController::class, 'index'])->middleware('auth')->name('gudangmuat.dashboard');
Route::get('/suratjalan/dashboard', [SuratJalanDashboardController::class, 'index'])->middleware('auth')->name('suratjalan.dashboard');



// Rute untuk surat jalan

// Rute untuk surat jalan
Route::get('/suratjalan', [SuratJalanController::class, 'index'])->middleware('auth')->name('surat_jalan.dashboard');
Route::post('/suratjalan/store', [SuratJalanController::class, 'store'])->middleware('auth')->name('surat_jalan.store');


use Illuminate\Support\Facades\Auth;
Route::post('/logout', function () {
    Auth::logout(); // Menghapus sesi pengguna
    return redirect('/'); // Redirect ke halaman welcome
})->name('logout')->middleware('auth');
