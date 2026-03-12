<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingIngredient extends Model
{
    protected $fillable = ['name','image','sort_order','is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
