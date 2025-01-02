<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Products;

class InventoryIn extends Model
{
    use HasFactory;

    protected $table = 'inventory_in';

    protected $fillable = [
        'product_id',
        'inventory_date',
        'batch_code',
        'shelf_name',
        'initial_stock',
        'final_stock',
        'unit_price',
        'expiration_date',
    ];

    // Relasi dengan tabel 'products'
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
