<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventoryOut extends Model
{
    use HasFactory;

    protected $table = 'inventory_out';

    protected $fillable = [
        'inventory_in_id',
        'inventory_date',
        'batch_code',
        'shelf_name',
        'initial_stock',
        'stock_sold',
        'unit_price',
    ];

    public function inventoryIn()
    {
        return $this->belongsTo(InventoryIn::class, 'inventory_in_id');
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function getUnitPriceFormattedAttribute()
    {
        return 'Rp ' . number_format($this->unit_price, 0, ',', '.');
    }

    public function setUnitPriceAttribute($value)
    {
        $this->attributes['unit_price'] = str_replace(['Rp', '.', ','], '', $value);
    }
}
