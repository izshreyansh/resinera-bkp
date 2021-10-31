<?php

namespace FleetCart\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Modules\Tax\Entities\TaxRate;

class TaxReport implements FromQuery
{
    use Exportable;

    public function query()
    {
        return TaxRate::select('tax_rates.id')
            ->join('order_taxes', 'tax_rates.id', '=', 'order_taxes.tax_rate_id')
            ->selectRaw('SUM(order_taxes.amount) as total')
            ->join('orders', 'order_taxes.order_id', '=', 'orders.id')
            ->selectRaw('MIN(orders.created_at) as start_date')
            ->selectRaw('MAX(orders.created_at) as end_date')
            ->selectRaw('COUNT(*) as total_orders')
            ->when(request()->has('tax_name'), function ($query) {
                $query->whereTranslationLike('name', request('tax_name') . '%');
            })
            ->groupBy('tax_rates.id');
    }
}
