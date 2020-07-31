@extends('dashboard.master')

@section('content')
<div class="row">
        

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Pay to Writer</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                    	<table id="example2" class="table table-bordered table-striped table-hover">
                           <tbody>
                           	<tr>
                           		<td>Name:</td>
                           		<td>{{ $user['name']}}</td>
                           	</tr>
                           	 <tr>
                           		<td>Order Status:</td>
                           		<td>{!! ucfirst(str_replace('_', ' ',strtolower($job_details->status_type))) !!}</td>
                           	</tr>
                           	<tr>
                           		<td>Total Money:</td>
                           		<td>{{$order_details->price}}</td>
                           	</tr>
                           	<tr>
                           	<td>Paid Money to writer:</td>
                           		<td><?php if(empty($order_details->paid_to_writer)){ echo 0;} 
                              else{ echo $order_details->paid_to_writer;} ?></td>
                           	</tr> 
                              <tr>
                           	<td>Remaining Paid Amount:</td>
                           		<td><?php echo $order_details->remaining_payment_amount; ?></td>
                           	</tr>
                             <tr>
                            <td>Percentage Amount:</td>
                              <td><input type="number" id="percentage_amount" value="50" />
                                <input type="hidden" id="total_m" value="{{$order_details->remaining_payment_amount}}" />
                              </td>
                            </tr>

                           	<tr>
                           		<td>Money pay to writer:</td>
                           		<td id="paidtowriter"> <?php $total_money =$order_details->remaining_payment_amount * 50/100;
                           		 echo $total_money;
                           		 ?></td>
                           	</tr>
                           	<tr><td colspan="2">
								 <?php 
                                 if(isset($writerDetails[0])) { 
								 $customvariable = $job_details->id;  ?>
								<form action="https://www.paypal.com/cgi-bin/webscr" method="post" >
								<input type="hidden" name="custom" value="<?php echo $customvariable;?>" />
								<input type="hidden" name="cmd" value="_xclick" />
								<input type="hidden" name="business" value="<?php echo $writerDetails[0]->paypal_email;?>" />
								<input type="hidden" name="quantity" value="1" />
								<input type="hidden" name="item_name" value="order approved" />
								<input type="hidden" name="item_number" value="1" />
								<input type="hidden" name="amount" id="grand-total-pay" value="<?php echo $total_money; ?>" />
								<input type="hidden" name="no_shipping" value="0">
								<input type="hidden" name="no_note" value="1">
								<input type="hidden" name="currency_code" value="USD">
							  <input type="hidden" name="rm" value="2" >
								<input type="hidden" name="notify_url" value="{{ URL::to('notifyWriter') }}">
								
								
								<input type="hidden" name="return" value="{{ URL::to('paymentstatus') }}" >
								<input type="submit" class="btn btn-info" value="pay now" />
							</form>
							<?php }  else { echo 'Paypal email is not entered by writer';} ?>
                           	</td></tr>
                            </tbody>
                           </table>
                    </div>
                  </div>
              </div>
         </div>



@stop
 @section('scripts')
  <script type="text/javascript">
   jQuery(document).ready(function($){
     $('#percentage_amount').keyup(function(){
        var val = $(this).val();
        if(val != ''){
          if(val <= 100) {
        var total_price = $('#total_m').val();
        var paidmoney = (val*total_price)/100;
        $('#paidtowriter').html(paidmoney);
        $('#grand-total-pay').val(paidmoney);       
      }
      else{
        alert('Invalid percentage');
      }
      }
     });
   });
  </script>
@endsection 