@extends('admin::layout')
@component('admin::components.page.header')
@slot('title', trans('order::orders.new_orders'))
<li class="active">{{ trans('order::orders.new_orders') }}</li>
@endcomponent
@section('content')
<div class="row">
	<div class="btn-group pull-right">
		<a href="javascript:generatePickList()" class="btn btn-primary btn-actions btn-create">
			Generate Pick List
		</a>
	</div>
</div>

<form id="hidden_pick_list_form" name="hidden_pick_list_form" method="GET" action="{{ route('admin.orders.picklist') }}" target="_blank">	
	<input type="hidden" name="selected_orders" id="selected_orders" value="">
</form>

<div class="box box-primary">
	<div class="box-body index-table" id="orders-table">
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
			<th data-sort>{{ trans('order::orders.action') }}</th>
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

		// $('#orders-table').on('click', 'tr.clickable-row', function (element) {
		// 	console.log($(this).data('id'));
		// });
	});


	function generatePickList(){
		var checkedOrder = $('.select-row:checked').length;
		if(checkedOrder == 0){
			alert('Please select atleast one order');
			return false;
		}

		var selectedOrders = '';
		$('.select-row:checked').each(function() {
			if(selectedOrders != ''){
				selectedOrders += '-';
			}
			selectedOrders += $(this).val();
		});

		$("#selected_orders").val(selectedOrders);
		$("#hidden_pick_list_form").submit();
		success('Pick list generated successfully');
		location.reload();
	}


	DataTable.setRoutes('#orders-table .table', {
		index: '{{ "admin.orders.index" }}',
	});


	new DataTable('#orders-table .table', {		
		columns: [
		{ data: 'checkbox', orderable: false, searchable: false, width: '3%'},
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
				return '<a class="btn btn-default" title="View" href="'+viewUrl+'"><i class="fa fa-eye" aria-hidden="true"></i></a>';
			},
		}
		],
		"rowCallback":function(raw, data){
			$(raw).addClass('clickable-row').data('id',data.id);
		},
	});

	
</script>
@endpush
