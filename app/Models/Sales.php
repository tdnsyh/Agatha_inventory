<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sales extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transaction_date',
        'total_amount',
    ];

    public function details()
    {
        return $this->hasMany(DetailSales::class, 'sales_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
