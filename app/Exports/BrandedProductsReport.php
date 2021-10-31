<?php

namespace FleetCart\Exports;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Modules\Brand\Entities\Brand;

class BrandedProductsReport implements FromQuery
{
    use Exportable;

    public function query()
    {
        return Brand::select('id')
            ->when(request()->has('brand'), function (Builder $query) {
                $query->whereTranslationLike('name', request('brand') . '%');
            })
            ->withCount('products')
            ->orderByDesc('products_count');
    }
}
