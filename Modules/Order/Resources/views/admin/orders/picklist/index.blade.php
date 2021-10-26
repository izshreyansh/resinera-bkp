<!DOCTYPE html>
<html>
<head>
	<style>
	table {
		font-family: arial, sans-serif;
		border-collapse: collapse;
		width: 100%;

	}

	td, th {
		border: 1px solid #dddddd;
		text-align: left;
		padding: 8px;
	}

</style>
</head>
<body>

	<div style="width: 80%;margin-left:auto;margin-right:auto;">
		<h2>PickList Id: {{ $pickListId }}</h2>
		<table>
			<tr>
				<td>SKU</td>
				<td>Product Name</td>
				<td>Quantity</td>
			</tr>
			@foreach($orderProducts as $orderProduct)
			<tr>
				<td>{{ $orderProduct->product->sku }}</td>
				<td>{{ str_replace('-', ' ', $orderProduct->product->slug) }}</td>
				<td>{{ $orderProduct->product_total_qty }}</td>
			</tr>
			@endforeach
			<tr>
				<td colspan="2" style="text-align: right;">Total Quantity</td>
				<td>{{ $orderProducts->sum('product_total_qty') }}</td>
			</tr>
		</table>
	</div>
</body>
</html>

