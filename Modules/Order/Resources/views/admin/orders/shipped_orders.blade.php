@extends('admin::layout')
@component('admin::components.page.header')
@slot('title', trans('order::orders.shipped_orders'))
<li class="active">{{ trans('order::orders.shipped_orders') }}</li>
@endcomponent
@section('content')
<div class="row">
	<div class="btn-group pull-right">
		<a href="javascript:moveToDelivered()" class="btn btn-primary btn-actions btn-create">
			Move to Delivered
		</a>
	</div>
</div>

<form id="hidden_mark_delivered_form" name="hidden_mark_delivered_form" method="GET" action="{{ route('admin.orders.mark.delivered') }}">
	<input type="hidden" name="selected_orders" id="selected_orders" value="">
</form>

<div class="box box-primary">
	<div class="box-body index-table" id="shipped-orders-table">
	@component('admin::components.table')
		@slot('thead')
		<tr>
			@include('admin::partials.table.select_all',['name'=>'orders'])
			<th>{{ trans('admin::admin.table.id') }}</th>
			<th>{{ trans('order::orders.table.customer_name') }}</th>
			<th>{{ trans('order::orders.table.customer_email') }}</th>
			<th>{{ trans('admin::admin.table.status') }}</th>
			<th>{{ trans('order::orders.table.total') }}</th>
			<th data-sort>{{ trans('admin::admin.table.created') }}</th>
		</tr>
		@endslot
		@endcomponent
	</div>
</div>
@endsection
@push('scripts')
<script>

	$(document).ready(function(){
		$(".select-all").change(function(){
			var checked = $(this).is(':checked');
			if(checked){
				$('.select-row').each(function() {
					$(this).prop('checked',true);
				});
			}else{

				$('.select-row').each(function() {
					$(this).prop('checked',false);
				});
			}
		});

	});


	function moveToDelivered(){
		var checkedOrder = $('.select-row:checked').length;
		if(checkedOrder == 0){
			alert('Please select atleast one order');
			return false;
		}

		var r = confirm('Are you sure, you want to update this orders?');
		if(r == true){
			var selectedOrders = '';
			$('.select-row:checked').each(function() {
				if(selectedOrders != ''){
					selectedOrders += '-';
				}
				selectedOrders += $(this).val();
			});

			$("#selected_orders").val(selectedOrders);
			$("#hidden_mark_delivered_form").submit();
		}
		
	}


	DataTable.setRoutes('#shipped-orders-table .table', {
		index: '{{ "admin.orders.shipped" }}',
	});


	new DataTable('#shipped-orders-table .table', {
		columns: [
		{ data: 'checkbox', orderable: false, searchable: false, width: '3%'},
		{ data: 'id', width: '5%',orderable: true, searchable: true },
		{ data: 'customer_name', orderable: false, searchable: true },
		{ data: 'customer_email' },
		{ data: 'status' },
		{ data: 'total' },
		{ data: 'created', name: 'created_at' },
		],
	});

	
</script>
@endpush
