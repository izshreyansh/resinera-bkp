<?php

namespace Modules\Order\Http\Controllers\Admin;

use Modules\Order\Entities\Order;
use Modules\Order\Entities\OrderPickList;
use Modules\Order\Entities\OrderProduct;
use Modules\Order\Entities\Courier;
use Modules\Admin\Traits\HasCrudActions;
use Illuminate\Http\Request;
use Modules\Order\Admin\OrderTable;

class OrderController
{
	use HasCrudActions;

	public function index(Request $request){

		if ($request->has('table')) {

			$order = Order::where('status',Order::PENDING);

			$order = $order->get();
			$order = new OrderTable($order);
			return $order;
		}

		return view("{$this->viewPath}.index");
	}


	public function show($id = 0)
	{
		$entity = Order::find($id);       

		return view("{$this->viewPath}.show")->with($this->getResourceName(), $entity);
	}

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['products', 'coupon', 'taxes'];

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'order::orders.order';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'order::admin.orders';



    /** Custom Methods **/

    /** get processing orders **/
    public function getProcessingOrders(Request $request){
    	if ($request->ajax()) {
            $pickListId = $request->get('pick_list_id');
            $order = [];
            if(!is_null($pickListId)){
                $order = Order::where('status',Order::PROCESSING)->where('pick_list_id',$pickListId);
                $order = $order->get();
            }
    		
    		$order = new OrderTable($order);
    		return $order;
    	}


        $pickListIds = OrderPickList::selectRaw('DISTINCT(pick_list_id) As list_id')->get()->pluck('list_id')->toArray();
        $couriers = Courier::orderBy('name','DESC')->get();

        
    	return view("{$this->viewPath}.processing_orders",['pickListIds'=>$pickListIds,'couriers'=>$couriers]);
    }


    /** get shipped orders **/
    public function getShippedOrders(Request $request){
    	if ($request->ajax()) {

    		$order = Order::where('status',Order::SHIPPED);

    		$order = $order->get();
    		$order = new OrderTable($order);
    		return $order;
    	}

    	return view("{$this->viewPath}.shipped_orders");
    }

    /** get delivered orders **/
    public function getDeliveredOrders(Request $request){
    	if ($request->ajax()) {

    		$order = Order::where('status',Order::DELIVERED);

    		$order = $order->get();
    		$order = new OrderTable($order);
    		return $order;
    	}

    	return view("{$this->viewPath}.delivered_orders");
    }


    /** mark as delivered **/
    public function markOrderAsDelivered(){
    	try{

    		$orderIds = explode('-',request()->get('selected_orders'));
    		Order::whereIn('id',$orderIds)->update(['status'=>Order::DELIVERED]);

    		return redirect()->route('admin.orders.shipped')->withSuccess('Order updated successfully','Order');

    	}catch(Exception $e){
    		dd('Mark as delivered '.$e);
    	}
    }


    /** mark as shipped **/
    public function markOrderAsShipped(Request $request){
        if($request->ajax()){

            if($request->get('courier_slug') == 'delhivery'){
                $trackingId = $this->delhiveryOrderCreate($request->get('order_id'));
            }else{
                $trackingId = $request->get('tracking_id');
            }
            
            if($trackingId != '0'){
                $order = Order::find($request->get('order_id'));
                $order->courier_id = $request->get('courier_id');
                $order->tracking_id = $trackingId;
                $order->status = Order::SHIPPED;
                $order->save();

                $slipUrl = route('admin.orders.delivery.slip',$request->get('order_id'));

                $response = [
                    'status'=>1,
                    'message'=>'Order updated successfully.',
                    'slipUrl'=>$slipUrl
                ];
            }else{
                $response = [
                    'status'=>0,
                    'message'=>'Sorry, we have facing some issue in connecting with courier service. Please try again later'
                ];
            }
            

        }else{
            $response = [
                'status'=>0,
                'message'=>'Something went wrong'
            ];
        }

        echo json_encode($response);
    }

    /** get delivery slip **/
    public function getDeliverySlip($id){

        $orderProducts = OrderProduct::where('order_id',$id)->get();
        $order = Order::find($id);

        return view("{$this->viewPath}.delivery_slip",['order'=>$order,'orderProducts'=>$orderProducts]);
    }

    /** generate a order in Delhivery **/
    public function delhiveryOrderCreate($orderId){
        try{

            $orderDetail = Order::find($orderId);

            $data['pickup_location'] = [
                "pin"=>"394107",
                "add"=>"21 purshottam nagar society opp jalaram petrol pump sayan road amroli",
                "phone"=>"8200145565",
                "state"=>"Gujarat",
                "city"=>"Surat",
                "country"=>"India",
                "name"=>"Demo warehouse"
            ];

            $address = $orderDetail->shipping_address_1;
            if(!empty($orderDetail->shipping_address_2)){
                $address .= $orderDetail->shipping_address_2;
            }
            $amountArray = $orderDetail->sub_total->toArray();
            $data['shipments'] = [
                [
                    "name"=>$orderDetail->shipping_first_name.' '.$orderDetail->shipping_last_name,
                    "add"=>$address,
                    "payment_mode"=>"COD",
                    "pin"=>$orderDetail->shipping_zip,
                    "order"=>$orderDetail->id,
                    "phone"=>$orderDetail->customer_phone,
                    "cod_amount"=>$amountArray['amount'],
                    "weight"=>$orderDetail->totalweight,
                    "country"=>$orderDetail->shipping_country,     
                    "state"=>$orderDetail->shipping_state,
                    "city"=>$orderDetail->shipping_city,
                    "client"=>"KOTHARISURFACE-B2C",
                    "return_name"=>"KOTHARI0047289",
                    "return_pin"=>"394107",
                    "return_city"=>"Surat",
                    "return_phone"=>"8200145565",
                    "return_add"=>"21 purshottam nagar society opp jalaram petrol pump sayan road amroli",
                    "return_state"=>"Gujarat",
                    "return_country"=>"India",
                ]
            ];
            
            $url='https://staging-express.delhivery.com/api/cmu/create.json';
            $headers = array(
                "Accept: application/json",
                "Authorization: Token f8f95db135b9aac964c38b37c969556f13242c24",
                'Content-Type: application/json',
            );

            $requestData['format'] = 'json';
            $requestData['data'] = json_encode($data);
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($requestData));
            $response = curl_exec($ch);
            curl_close($ch);

            $result = json_decode($response);
            
            if($result->success){

                return $result->upload_wbn;

            }else{
                \Log::error('delhivery error '.$response);
                return '0';
            }

        }catch(Exception $e){
            \Log::error('Issue in create order delhivery '.json_encode($e));
           return 0;
        }
    }

}
