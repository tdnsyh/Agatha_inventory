<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductionRequest extends Model
{
    use HasFactory;

    protected $table = 'production_request';

    protected $fillable = [
        'user_id',
        'product_id',
        'request_date',
        'quantity_request',
        'status_request',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}
