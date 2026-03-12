<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingProduct extends Model
{
    protected $fillable = [
        'title','description','size_label','price','old_price','image','sort_order','is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
