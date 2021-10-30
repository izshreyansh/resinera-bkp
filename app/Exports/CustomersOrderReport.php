<?php

namespace FleetCart\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Modules\Order\Entities\Order;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomersOrderReport implements FromQuery, WithHeadings
{
    use Exportable;

    public function headings(): array
    {
        return [
            '#',
            'Customer FirstName',
            'Customer LastName',
            'Customer Email',
            'Customer Phone',
            'Report Start Date',
            'Report End Date',
            'Orders',
            'Products',
            'Total',
        ];
    }

    public function query()
    {
        return Order::select('customer_id', 'customer_first_name', 'customer_last_name', 'customer_email', 'customer_phone')
            ->selectRaw('MIN(orders.created_at) as start_date')
            ->selectRaw('MAX(orders.created_at) as end_date')
            ->selectRaw('COUNT(*) as total_orders')
            ->join('order_products', 'orders.id', '=', 'order_products.order_id')
            ->selectRaw('SUM(order_products.qty) as total_products')
            ->selectRaw('SUM(orders.total) as total')
            ->when(request()->has('customer_name'), function ($query) {
                $query->where('customer_first_name', 'like', request('customer_name') . '%')
                    ->orWhere('customer_last_name', 'like', request('customer_name') . '%');
            })
            ->when(request()->has('customer_email'), function ($query) {
                $query->where('customer_email', request('customer_email'));
            })
            ->groupBy([
                'customer_id'
            ]);
    }
}
