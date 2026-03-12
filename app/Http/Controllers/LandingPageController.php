<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\LandingProduct;
use App\Models\LandingIngredient;
use App\Models\LandingTestimonial;

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

        return view('home', compact('settings', 'products', 'ingredients', 'testimonials'));
    }
}