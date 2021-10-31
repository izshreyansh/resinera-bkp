<?php

namespace FleetCart\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Modules\Product\Entities\Product;

class ProductsViewReport implements FromQuery
{
    use Exportable;

    public function query()
    {
        return Product::withoutGlobalScope('active')
            ->select('id', 'viewed')
            ->when(request()->has('product'), function ($query) {
                $query->whereTranslationLike('name', request('product') . '%');
            })
            ->when(request()->has('sku'), function ($query) {
                $query->where('sku', request('sku'));
            })
            ->orderByDesc('viewed');
    }
}
