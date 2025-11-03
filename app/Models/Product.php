<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    protected $fillable = [
        'name', 'category_id', 'location_id', 'barcode', 'quantity', 'status' // Removed 'stok'
    ];  
    
    public function transactions()
       {
           return $this->hasMany(Transaction::class);
       }
}
