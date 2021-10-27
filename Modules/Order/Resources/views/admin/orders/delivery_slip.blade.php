<html lang="en">
<head>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delivery Slip</title>
</head>
<body>
	<main role="main" class="container">
		<div class="row">
			<div class="col-8 border border-dark">
				<div class="text-center col-12">
                    @if($order->tracking_id)
                    <br />
                    <div style="width: 25%; margin-left:auto; margin-right:auto; margin-top:20px;">
                        {!! DNS1D::getBarcodeHTML($order->tracking_id, 'C128') !!}
                        {{ $order->tracking_id }}
                    </div>
                    <br />
                    @endif
					<h4>Order Information</h4>
				</div>
				<hr/>

				<div class="col-12">
					<span>
						<strong>Purchased</strong>: {{ $order->created_at->format('d/m/Y') }}
					</span>
					<span style="float:right;">
						<strong>Shipped On</strong>: {{ date('d/m/Y') }}<br/>
					</span>
				</div>
				<hr/>

				<div class="col-12">
					<strong>Shipping Address:</strong><br/>
					<strong>{{ $order->shipping_full_name }}</strong><br/>
					<p>
						{{ $order->shipping_address_1 }},
						@if(!is_null($order->shipping_address_2))
						{{ $order->shipping_address_2 }},
						@endif
						{{ $order->shipping_city }}, {{ $order->shipping_state }}, {{ $order->shipping_country }}<br/>
						@if(!is_null($order->shipping_zip))
						PINCODE: {{ $order->shipping_zip }}
						@endif
					</p>
				</div>
				<hr/>
				<div class="col-12">
					<strong>Seller Address:</strong><br/>
					<strong>Nilay Shah</strong><br/>
					<p>asasas,asas,asas,as,asa,s,a</p>
				</div>


				<div>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th scope="col">SKU</th>
								<th scope="col">Product</th>
								<th scope="col">Price</th>
								<th scope="col">Total</th>
							</tr>
						</thead>
						<tbody>
							@foreach($orderProducts as $orderProduct)
							<tr>
								<td scope="row">{{ $orderProduct->product->sku }}</td>
								<td>{{ str_replace('-',' ',$orderProduct->product->slug) }}</td>
								<td>{{ $orderProduct->unit_price }}</td>
								<td>{{ $orderProduct->line_total }}</td>
							</tr>
							@endforeach
							<tr>
								<td colspan="2"></td>
								<td>Total Cost</td>
								<td>{{ $order->total }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</main>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>
