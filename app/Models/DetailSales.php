<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailSales extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_id',
        'product_id',
        'quantity',
        'unit_price',
        'sub_total',
    ];

    public function sales()
    {
        return $this->belongsTo(Sales::class, 'sales_id');
    }

    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}
