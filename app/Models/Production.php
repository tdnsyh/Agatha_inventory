<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    protected $table = 'production';

    protected $fillable = [
        'inventory_user_id',
        'production_user_id',
        'production_date',
        'request_date',
        'status',
        'note',
        'approval',
    ];


    public function productionRequest()
    {
        return $this->belongsTo(ProductionRequest::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productionUser()
    {
        return $this->belongsTo(User::class, 'production_user_id');
    }

    public function inventoryUser()
    {
        return $this->belongsTo(User::class, 'inventory_user_id');
    }

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    public function details()
    {
        return $this->hasMany(DetailProduction::class, 'production_id');
    }
}
