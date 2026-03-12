<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection, WithHeadings, WithMapping
{
    protected Collection $orders;
    protected int $index = 0;

    public function __construct(Collection $orders)
    {
        $this->orders = $orders;
    }

    public function collection()
    {
        return $this->orders;
    }

    /**
     * SERIAL NUMBER + ROW DATA
     */
    public function map($order): array
    {
        $this->index++;

        return [
            $this->index, // ✅ SERIAL NUMBER
            $order->customer_name,
            $order->customer_phone,
            $order->items->pluck('product_name')->implode(', '),
            $order->total,
            ucfirst($order->status),
            $order->created_at->format('Y-m-d H:i'),
        ];
    }

    /**
     * EXCEL HEADINGS
     */
    public function headings(): array
    {
        return [
            'SL No',
            'Customer Name',
            'Phone',
            'Products',
            'Total (৳)',
            'Status',
            'Order Date',
        ];
    }
}
