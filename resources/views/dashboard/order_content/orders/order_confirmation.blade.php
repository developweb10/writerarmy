@extends('dashboard.master')


@section('pagespecificscripts')
<!--  <script async src="https://www.googletagmanager.com/gtag/js?id=AW-976488330"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'AW-976488330');
</script>
<!-- Event snippet for Content Sale conversion page -->
<!--<script>
gtag('event', 'conversion', {
'send_to': 'AW-976488330/tP2zCLO68ZIBEIqP0NED',
'transaction_id': ''
});
</script> -->
@endsection
@section('content')
 <div class="container content-order-confirmation ">

		
		<h2>Order Details</h2>
		<p>Please find below your order details:</p>
		<p><strong>ID: </strong>{{$orderdata->id}}</p>
		<p><strong>Total Words: </strong>{{$orderdata->total_words}}</p>
		<p><strong>Quantity: </strong>{{$orderdata->quantity}}</p>
		<p><strong>Topic: </strong>{{$orderdata->topic}}</p>
		<p><strong>Writing Style: </strong>{{$orderdata->type_style}}</p>
		<p><strong>Target Audience: </strong>{{$orderdata->target_audience}}</p>
		<p><strong>Reference(URLs): </strong>{{$orderdata->reference_url}}</p>
		<p><strong>SEO Keywords: </strong>{{$orderdata->seo_keywords}}</p>
		<p><strong>Order Details: </strong>{{$orderdata->order_details}}</p>
		<p><strong>Order Total: </strong>{{$orderdata->price}}</p>
		
		
 </div>
 @endsection