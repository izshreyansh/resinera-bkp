<?php

namespace FleetCart\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Modules\Product\Entities\Product;

class ProductsPurchaseReport implements FromQuery
{
    use Exportable;

    public function query()
    {
        return Product::withoutGlobalScope('active')
            ->select('products.id')
            ->join('order_products', 'products.id', '=', 'order_products.product_id')
            ->selectRaw('SUM(order_products.qty) as qty')
            ->selectRaw('SUM(order_products.line_total) as total')
            ->join('orders', 'order_products.order_id', '=', 'orders.id')
            ->selectRaw('MIN(orders.created_at) as start_date')
            ->selectRaw('MAX(orders.created_at) as end_date')
            ->when(request()->has('product'), function ($query) {
                $query->whereTranslationLike('name', request('product') . '%');
            })
            ->when(request()->has('sku'), function ($query) {
                $query->where('sku', request('sku'));
            })
            ->groupBy('products.id');
    }
}
