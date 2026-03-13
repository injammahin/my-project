<?php

namespace App\Http\Controllers;

use App\Models\ComboProduct; // Assuming your products are stored in this model

class ComboController extends Controller
{
public function index()
{
    // Fetch combo products
    $comboProducts = ComboProduct::all();

    // Fetch the currency symbol from the settings
    $currencySymbol = $settings['currency_symbol'] ?? '$';  // Add this line to fetch the currency symbol

    return view('combo.index', compact('comboProducts', 'currencySymbol'));  // Pass currencySymbol to the view
}
public function show($id)
{
    $product = ComboProduct::findOrFail($id);
    $currencySymbol = $settings['currency_symbol'] ?? '$';  // Currency symbol
$relatedProducts = ComboProduct::findOrFail($id)->take(4)->get();

    return view('combo.show', compact('product', 'currencySymbol','relatedProducts'));
}
}