<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\LandingProduct;
use App\Models\LandingIngredient;
use App\Models\LandingTestimonial;
use App\Models\ComboProduct;

class LandingPageController extends Controller
{
    public function show()
    {
        $settings = DB::table('settings')->pluck('value', 'key')->toArray();

        $products = class_exists(LandingProduct::class)
            ? LandingProduct::query()
                ->where('is_active', 1)
                ->orderBy('sort_order', 'asc')
                ->orderBy('id', 'desc')
                ->get()
            : collect();

        $ingredients = class_exists(LandingIngredient::class)
            ? LandingIngredient::latest()->get()
            : collect();

        $testimonials = class_exists(LandingTestimonial::class)
            ? LandingTestimonial::latest()->get()
            : collect();
        $comboProducts = ComboProduct::where('is_best_seller', true)
        ->orderBy('sort_order', 'asc')
        ->take(3) // Limit to 3 best sellers
        ->get();


        return view('home', compact('comboProducts','settings', 'products', 'ingredients', 'testimonials'));
    }
    
}