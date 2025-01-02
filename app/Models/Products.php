<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'code',
        'name',
        'image',
        'variant',
        'price',
        'expired_day',
        'stock',
    ];

    protected $guarded = [];

    protected $casts = [
        'price' => 'decimal:2',
        'expired_day' => 'integer',
        'stock' => 'integer',
    ];

    public function getPriceFormattedAttribute()
    {
        return 'Rp ' . number_format($this->price, 2, ',', '.');
    }
}
