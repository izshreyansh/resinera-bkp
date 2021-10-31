<?php

namespace FleetCart\Exports;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Modules\Tax\Entities\TaxClass;

class TaxedProductsReport implements FromQuery
{
    use Exportable;

    public function query()
    {
        return TaxClass::select('id')
            ->when(request()->has('tax_class'), function (Builder $query) {
                $query->where('id', request('tax_class'));
            })
            ->withCount('products')
            ->orderByDesc('products_count');
    }
}
