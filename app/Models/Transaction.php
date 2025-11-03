<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product; // Import model Product

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'type', 'quantity', 'transaction_date', 'barcode',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
