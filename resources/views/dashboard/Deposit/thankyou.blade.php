@extends('dashboard.master')

@section('content-header')
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Thank you for your order</h3>
                </div>
				<div class="box-body">
					<div class="content">
						<p>Thank you for your deposit, your funds are now available in your account. A receipt has been emailed to you. You will now be redirected to the Order Content page where you can place your orders.</p>
					</div>
				</div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
<script>
  $(document).ready(function() {
    setTimeout(function() {
      window.location.href="<?php echo url('/content/menu'); ?>";
   }, 5000);
   	});
</script>
@endsection