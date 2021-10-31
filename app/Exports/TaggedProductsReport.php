<?php

namespace FleetCart\Exports;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Modules\Tag\Entities\Tag;

class TaggedProductsReport implements FromQuery
{
    use Exportable;

    public function query()
    {
        return Tag::select('id')
            ->when(request()->has('tag'), function (Builder $query) {
                $query->whereTranslationLike('name', request('tag') . '%');
            })
            ->withCount('products')
            ->orderByDesc('products_count');
    }
}
