<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'cart' => 'required|array',
        ]);

        $subtotal = collect($request->cart)
            ->sum(fn ($i) => $i['price'] * $i['qty']);

        $delivery = 60;

        $order = Order::create([
            'customer_name' => $request->name,
            'customer_phone' => $request->phone,
            'customer_address' => $request->address,
            'subtotal' => $subtotal,
            'delivery_charge' => $delivery,
            'total' => $subtotal + $delivery,
            'status' => 'pending',
        ]);

        foreach ($request->cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['qty'],
                'total' => $item['price'] * $item['qty'],
            ]);
        }

        return response()->json(['success' => true]);
    }
}
