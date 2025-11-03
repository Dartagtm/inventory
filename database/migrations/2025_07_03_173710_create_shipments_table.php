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
    Schema::create('shipments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('product_id')->constrained(); // Menghubungkan ke tabel produk
        $table->integer('quantity'); // Jumlah barang yang dikirim
        $table->string('destination'); // Tujuan pengiriman (misalnya, alamat atau nama toko)
        $table->timestamp('shipped_at')->useCurrent(); // Waktu pengiriman
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
