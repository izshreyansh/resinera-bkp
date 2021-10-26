<?php

namespace Modules\Order\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Modules\Order\Entities\Order;
use Modules\Order\Entities\OrderProduct;
use Modules\Order\Entities\OrderPickList;
use PDF;

class PickListController
{
    /** generate pick list **/
    public function index(){
        try{

            $orderIds = explode('-',request()->get('selected_orders'));
            $orderProducts = OrderProduct::select('*')->selectRaw('SUM(qty) As product_total_qty')->whereIn('order_id',$orderIds)
            ->groupBy('product_id')->get();
            $lastPickListId = Order::select('pick_list_id')->orderBy('pick_list_id','DESC')->first()->pick_list_id;
            $pickListId = 1;
            if(!is_null($lastPickListId)){
                $pickListId = $lastPickListId + 1;
            }
            Order::whereIn('id',$orderIds)->update(['pick_list_id'=>$pickListId,'status'=>Order::PROCESSING]);

            foreach($orderIds as $orderId){
                $data = [
                    'order_id'=>$orderId,
                    'pick_list_id'=>$pickListId
                ];
                OrderPickList::create($data);
            }

            $pickListView = View::make('order::admin.orders.picklist.index',['orderProducts'=>$orderProducts,'pickListId'=>$pickListId]);
            $fileName = $pickListId.'_pick_list.pdf';
            return PDF::loadHTML($pickListView)->download($fileName);

        }catch(Exception $e){
            dd('Picklist generation '.$e);
        }
    }
}
