@extends('admin::layout')
@component('admin::components.page.header')
@slot('title', trans('order::orders.delivered_orders'))
<li class="active">{{ trans('order::orders.delivered_orders') }}</li>
@endcomponent
@section('content')
<div class="box box-primary">
	<div class="box-body index-table" id="delivered-orders-table">
	@component('admin::components.table')
		@slot('thead')
		<tr>
			<th>{{ trans('admin::admin.table.id') }}</th>
			<th>{{ trans('order::orders.table.customer_name') }}</th>
			<th>{{ trans('order::orders.table.customer_email') }}</th>
            <th>Shipment</th>
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

	DataTable.setRoutes('#delivered-orders-table .table', {
		index: '{{ "admin.orders.delivered" }}'
	});


	new DataTable('#delivered-orders-table .table', {
		columns: [
		{ data: 'id', width: '5%',orderable: true, searchable: true },
		{ data: 'customer_name', orderable: false, searchable: true },
		{ data: 'customer_email' },
        { data: 'shipment' },
		{ data: 'status' },
		{ data: 'total' },
		{ data: 'created', name: 'created_at' },
		],
	});
</script>
@endpush
