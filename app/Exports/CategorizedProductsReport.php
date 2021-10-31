<?php

namespace FleetCart\Exports;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Modules\Category\Entities\Category;

class CategorizedProductsReport implements FromQuery
{
    use Exportable;

    public function query()
    {
        return Category::withoutGlobalScope('active')
            ->select('id')
            ->when(request()->has('category'), function (Builder $query) {
                $query->whereTranslationLike('name', request('category') . '%');
            })
            ->withCount('products')
            ->orderByDesc('products_count');
    }
}
