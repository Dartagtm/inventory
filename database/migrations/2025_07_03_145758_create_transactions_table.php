<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('product_id')->constrained(); // Menghubungkan ke tabel produk
        $table->enum('type', ['in', 'out']); // Tipe transaksi: masuk (in) atau keluar (out)
        $table->integer('quantity'); // Jumlah barang yang dipindahkan
        $table->timestamp('transaction_date')->useCurrent(); // Waktu transaksi
        $table->string('barcode')->nullable(); // Barcode produk yang dipindai
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
