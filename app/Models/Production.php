<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    protected $table = 'production';

    protected $fillable = [
        'user_id',
        'production_request_id',
        'production_date',
        'production_status',
        'note',
    ];

    public function productionRequest()
    {
        return $this->belongsTo(ProductionRequest::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(DetailProduction::class, 'production_id');
    }
}
