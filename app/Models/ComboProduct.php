<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComboProduct extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [
        'title', 'description', 'sale_price', 'regular_price', 
        'sort_order', 'is_active', 'gift_name', 'gift_image', 'image', 'is_best_seller'
    ];
}