<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // ✅ strict validation (price/qty safe)
        $validated = $request->validate([
            'name'       => ['required', 'string', 'max:120'],
            'phone'      => ['required', 'string', 'max:30'],
            'address'    => ['required', 'string', 'max:255'],
            'cart'       => ['required', 'array', 'min:1'],

            // cart item validation
            'cart.*.name'  => ['required', 'string', 'max:190'],
            'cart.*.price' => ['required', 'numeric', 'min:0'],
            'cart.*.qty'   => ['required', 'integer', 'min:1'],

            // optional: visitor_id (for analytics linking)
            'visitor_id' => ['nullable', 'string', 'max:80'],
        ]);

        $DELIVERY_CHARGE = 60;

        // ✅ Normalize cart (avoid missing keys)
        $cart = collect($validated['cart'])->map(function ($i) {
            return [
                'name'  => (string) $i['name'],
                'price' => (float)  $i['price'],
                'qty'   => (int)    $i['qty'],
            ];
        });

        // ✅ Calculate subtotal securely
        $subtotal = $cart->sum(function ($i) {
            return $i['price'] * $i['qty'];
        });

        // ✅ transaction ensures order+items always consistent
        $order = DB::transaction(function () use ($validated, $cart, $subtotal, $DELIVERY_CHARGE, $request) {

            $orderData = [
                'customer_name'    => $validated['name'],
                'customer_phone'   => $validated['phone'],
                'customer_address' => $validated['address'],
                'subtotal'         => $subtotal,
                'delivery_charge'  => $DELIVERY_CHARGE,
                'total'            => $subtotal + $DELIVERY_CHARGE,
                'status'           => 'pending',
            ];

            // ✅ Save visitor_id only if your orders table has the column
            // (prevents 500 if migration not done yet)
            if (Schema::hasColumn('orders', 'visitor_id')) {
                $orderData['visitor_id'] = $validated['visitor_id'] ?? null;
            }

            $order = Order::create($orderData);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id'      => $order->id,
                    'product_name'  => $item['name'],
                    'price'         => $item['price'],
                    'quantity'      => $item['qty'],
                    'total'         => $item['price'] * $item['qty'],
                ]);
            }

            return $order;
        });

        return response()->json([
            'success'  => true,
            'order_id' => $order->id,
            'total'    => $order->total,
        ]);
    }
}
