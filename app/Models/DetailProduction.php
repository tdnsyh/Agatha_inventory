<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailProduction extends Model
{
    protected $table = 'detail_production';

    use HasFactory;

    protected $fillable = [
        'production_id',
        'product_id',
        'batch_code',
        'shelf_name',
        'quantity_produced',
        'expiration_date',
    ];
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
    public function production()
    {
        return $this->belongsTo(Production::class, 'production_id');
    }
}
