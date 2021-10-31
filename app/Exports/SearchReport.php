<?php

namespace FleetCart\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Modules\Product\Entities\SearchTerm;

class SearchReport implements FromQuery
{
    use Exportable;

    public function query()
    {
        return SearchTerm::orderByDesc('hits')
            ->when(request()->has('keyword'), function ($query) {
                $query->where('term', 'LIKE', request('keyword') . '%');
            });
    }
}
