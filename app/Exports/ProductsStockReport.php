<?php

namespace FleetCart\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Modules\Product\Entities\Product;

class ProductsStockReport implements FromQuery
{
    use Exportable;

    public function query()
    {
        return Product::select('id', 'qty', 'in_stock')
            ->withName()
            ->when(request()->has('quantity_above'), function ($query) {
                $query->where('manage_stock', true)
                    ->where('qty', '>', request('quantity_above'));
            })
            ->when(request()->has('quantity_below'), function ($query) {
                $query->where('manage_stock', true)
                    ->where('qty', '<', request('quantity_below'));
            })
            ->when(request('stock_availability') === 'in_stock', function ($query) {
                $query->where('in_stock', true);
            })
            ->when(request('stock_availability') === 'out_of_stock', function ($query) {
                $query->where('in_stock', false);
            })
            ->orderByDesc('qty');
    }
}
