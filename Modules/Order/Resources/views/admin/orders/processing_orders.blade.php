@extends('admin::layout')
@component('admin::components.page.header')
@slot('title', trans('order::orders.processing_orders'))
<li class="active">{{ trans('order::orders.processing_orders') }}</li>
@endcomponent
@section('content')
<style type="text/css">
	.custom-select-black{
		width: 90px !important;
	}
</style>

<div class="box box-primary">
	<div class="box-body index-table">
		<div style="width:240px">
			<select name="pick_list_id" class="form-control" id="pick_list_id" onchange="renderDT()">
				<option value="">Please select Pick list</option>
				@foreach($pickListIds as $pickListId)
				<option value="{{ $pickListId }}">{{ $pickListId }}</option>
				@endforeach
			</select>
		</div>
		<div class="table-responsive">
			<table class="table table-striped table-hover" id="pending-orders-table">
				<thead>
					<tr>
						<th>{{ trans('admin::admin.table.id') }}</th>
						<th>{{ trans('order::orders.table.customer_name') }}</th>
						<th>{{ trans('order::orders.table.customer_email') }}</th>
						<th>{{ trans('admin::admin.table.status') }}</th>
						<th>{{ trans('order::orders.table.total') }}</th>
						<th>{{ trans('admin::admin.table.created') }}</th>
						<th>{{ trans('order::orders.action') }}</th>
					</tr>
				</thead>

				<tbody></tbody>

			</table>
		</div>
	</div>
</div>
<form id="hidden_slip" action="" method="GET" target="_blank" class="hide">
	
</form>
<div class="modal fade" id="change-order-status">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Shipped Order</h4>
				</div>
				<form class="form-horizontal" id="change-order-form">
					<div class="modal-body">
						<div class="box-body cust-box cust-box-modal">
							<input type="hidden" name="order_id" id="order_id" value="">							
							<div class="form-group">
								<label for="" class="control-label">Select Courier <span class="text-danger">*</span></label>
								<div class="width-100">
									<select class="form-control select2" id="courier_id" name="courier_id" style="width:100%" onchange="changeTrackingId();">
										<option value="">Please select courier</option>
										@foreach($couriers as $courier)
										<option value="{{ $courier->id }}-{{ $courier->slug }}">{{ $courier->name }}</option>
										@endforeach
									</select>
									<span class="text-danger" id="courier_id_error"></span>
								</div>
							</div>
							<div class="form-group" id="tracking_div" style="display: none;">
								<label for="" class="control-label">Tracking ID <span class="text-danger">*</span></label>
								<div class="width-100">
									<input type="text" name="tracking_id" id="tracking_id" class="form-control" placeholder="Enter Tracking ID">
									<span class="text-danger" id="tracking_id_error"></span>
								</div>
							</div>
						</div>
					</div>                              
					<div class="modal-footer">
						<button type="button" class="btn bg-navy" onclick="updateOrder()">Save</button>
						<button type="button" class="btn bg-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
@push('scripts')
<script>

	$(document).ready(function(){
		renderDT();
	});

	/** shipped order **/
	function shippedOrder(id){

		$("#order_id").val(id);
		$("#change-order-form")[0].reset();
		$("#courier_id_error").html('');
		$("#tracking_id_error").html('');
		$("#change-order-status").modal({
			keyboard: false,
			backdrop: 'static'
		});
	}

	/** change id **/
	function changeTrackingId(){

		var courierData = $("#courier_id").val();
		courierData = courierData.split('-');
		$("#tracking_div").css('display','none');
		
		if(courierData[1] != 'delhivery' && courierData[0] != ''){
			$("#tracking_div").css('display','block');
		}
	}

	/** update data **/
	function updateOrder(){
		$("#courier_id_error").html('');
		$("#tracking_id_error").html('');
		var courierData = $("#courier_id").val();
		courierData = courierData.split('-');
		var courierId = courierData[0];
		var courierSlug = courierData[1];
		var trackingId = $("#tracking_id").val();
		var orderId = $("#order_id").val();
		var error = 0;
		if(courierId == ''){
			$("#courier_id_error").html('select courier');
			error++;
		}

		if(trackingId == '' && ($("#tracking_div").css('display') == 'block')){
			$("#tracking_id_error").html('Enter tracking ID');
			error++;
		}

		if(error > 0){
			return false;
		}

		var ajaxUrl = 'admin/mark-as-shipped';
		var data = {};
		data.courier_id = courierId;
		data.tracking_id = trackingId;
		data.order_id = orderId;
		data.courier_slug = courierSlug;
		$.ajax({
			type:'POST',
			url:ajaxUrl,
			data:data,
			success:function(result){

				var response = JSON.parse(result);
				
				if(response.status == 1){
					success(response.message);
					$("#change-order-status").modal('hide');
					$("#hidden_slip").attr('action',response.slipUrl);
					$("#hidden_slip").submit();
					renderDT();
				}else if(response.status == 0){
					alert(response.message);
					$("#change-order-status").modal('hide');
					renderDT();
				}

			},error:function(xhr){
				error('Something went wrong');
			}
		});
	}

	function renderDT(){
		$("#pending-orders-table").dataTable().fnDestroy();
		var data = {};
		data.pick_list_id = $("#pick_list_id").val();
		$("#pending-orders-table").DataTable({
			"responsive": true,
			"pageLength": 20,
			"processing": true,
			"serverSide": true,			
			"lengthMenu": [
			[10, 20, 50, 100, 200],
			[10, 20, 50, 100, 200],
			],
			"ajax": {
				url: 'admin/processing-orders',
				type: 'post',
				pages: 10,
				data:data,
				complete: function(data) {}
			},
			columns: [
			{ data: 'id', width: '5%',orderable: true, searchable: true },
			{ data: 'customer_name', orderable: false, searchable: true },
			{ data: 'customer_email' },
			{ data: 'status' },
			{ data: 'total' },
			{ data: 'created', name: 'created_at' },
			{
				targets: 0,
				data: null,
				className: 'text-center',
				searchable: false,
				orderable: false,
				render: function (data, type, full, meta) {
					var id = data.id;
					var viewUrl = "{{ route('admin.orders.show') }}/"+id;
					var func = "shippedOrder("+id+")";
					var buttons = '<a class="btn btn-default" title="Shipped" href="javascript:'+func+'"><i class="fa fa-truck" aria-hidden="true"></i></a>';
					return buttons;
				},
			}
			],
		});
	}

</script>
@endpush
