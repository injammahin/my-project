<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $settings = DB::table('settings')->pluck('value', 'key')->toArray();

        return view('checkout', compact('settings'));
    }
}