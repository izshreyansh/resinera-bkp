<?php

namespace FleetCart\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Modules\Coupon\Entities\Coupon;

class CouponsReport implements FromQuery
{
    use Exportable;

    public function query()
    {
        return Coupon::withoutGlobalScope('active')
            ->select('coupons.id', 'code')
            ->join('orders', 'coupons.id', '=', 'orders.coupon_id')
            ->selectRaw('MIN(orders.created_at) as start_date')
            ->selectRaw('MAX(orders.created_at) as end_date')
            ->selectRaw('COUNT(*) as total_orders')
            ->selectRaw('SUM(orders.discount) as total')
            ->when(request()->has('coupon_code'), function ($query) {
                $query->where('code', request('coupon_code'));
            })
            ->groupBy(['coupons.id', 'coupons.code']);
    }
}
