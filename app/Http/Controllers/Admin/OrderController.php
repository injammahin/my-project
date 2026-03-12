<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    /**
     * Orders list with pagination
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        $orders = Order::with('items')
            ->latest()
            ->paginate($perPage)
            ->appends($request->query());


        return view('admin.orders.index', compact('orders', 'perPage'));
    }

    /**
     * Show single order
     */
    public function show(Order $order)
    {
        $order->load('items');
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update order status
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Order status updated');
    }

    /**
     * Delete order
     */
    public function destroy(Order $order)
    {
        $order->items()->delete();
        $order->delete();

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Order deleted successfully');
    }

    /**
     * Export all orders to Excel
     */
public function export(Request $request)
{
    $perPage = $request->get('per_page', 10);

    // Get all orders (or apply same filters if you have any)
    $orders = Order::with('items')
        ->orderBy('created_at', 'desc')
        ->get();

    return Excel::download(
        new OrdersExport($orders),
        'orders-report.xlsx'
    );
}
}
