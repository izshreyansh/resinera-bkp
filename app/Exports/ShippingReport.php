<?php

namespace FleetCart\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Modules\Order\Entities\Order;

class ShippingReport implements FromQuery
{
    use Exportable;

    public function query()
    {
        return Order::select('shipping_method')
            ->selectRaw('MIN(created_at) as start_date')
            ->selectRaw('MAX(created_at) as end_date')
            ->selectRaw('COUNT(*) as total_orders')
            ->selectRaw('SUM(shipping_cost) as total')
            ->when(request()->has('shipping_method'), function ($query) {
                $query->where('shipping_method', request('shipping_method'));
            })
            ->groupBy('shipping_method');
    }
}
