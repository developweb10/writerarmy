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
                    <h3 class="box-title">Deposit Funds</h3>
                </div>
                 <div class="box-body addpackage">
                   <div class="col-md-6">
                      <div class="form-group">
                     <label>Deposit Amount(minimum $50)</label>
                     <input type="number" min="50" placeholder="50" id="amount" class="form-control" name="amount" value="50" required style="width:30%">
                     </div>
                      <div class="form-group custom-payment-select">
                        <?php if(!empty($cards)){
                          foreach($cards as $card){
                            echo "<label>
                        <input type=\"radio\" class=\"checkmethod\" name=\"checkmethod\" value=\"".$card['id']."\" />  Master Card ending in ".$card['card_number'].", expires in ".$card['expires']."
                       </label>";
                          }
                        }?>
                        <label>
                        <input type="radio" class="checkmethod" name="checkmethod" value="-1" checked="checked" /> 
                        Deposit With Paypal
                       </label>
                      </div>

                      <div class="form-group custom-card-wrapper" style="display:none;"> 
                       <form method="post" action="{{ url('/postDepositFund') }}" > 
                        <input type="hidden" name="paymenttype" value="savedCard" />
                        <input type="hidden" id="cardid" name="cardid" value="" />
                        <input type="hidden" name="amount" id="grand-total-pay" value="" />
                        <input type="submit" id="cardSubmitBtn" class="btn btn-primary" value="$ Deposit Funds" />
                       </form>

                      </div>

                     <div class="form-group paypal-form-wrapper">  
                         <form action="https://www.paypal.com/cgi-bin/webscr" id="paypalForm" method="post" style="padding: 0; margin: 0;">
                         <input type="hidden" name="custom" value="{{ $userId }}" />
                            <input type="hidden" name="cmd" value="_xclick" />
                            <input type="hidden" name="business" value="admin@writerarmy.com" />
                            <input type="hidden" name="quantity" value="1" />
                            <input type="hidden" name="item_name" value="Deposit Amount" />
                            <input type="hidden" name="item_number" value="1" />
                            <input type="hidden" name="amount" id="grand-total-pay1" value="" />
                            <input type="hidden" name="shipping" value="0" />
                            <input type="hidden" name="no_note" value="1" />
                            <input type="hidden" name="notify_url" value="{{ url('/postDepositFund') }}">
                            <input type="hidden" name="currency_code" value="USD" />
                            <input type="hidden" name="rm" value="2" >
                            <input type="hidden" name="return" value="{{ url('/postDepositFund') }}" >
                       
                          <div class="paynow custom_payment_buttons">
                          
                            <ul>
                              <li> <img src="{{ URL('global/img/pay-with-paypal.png') }}"/ ></li>
                              <li class=""><img src="{{ URL('global/img/paypalcredit.png') }}"/ ></li>
                              <li class="small-icon"><img src="{{ URL('global/img/visa.png') }}"/ ></li>
                              <li class="small-icon"><img src="{{ URL('global/img/master.png') }}"/ ></li>
                              <li class="small-icon"><img src="{{ URL('global/img/American-Express-PNG-Clipart.png') }}"/ ></li>
                            </ul>
                        </div>
                        </div>
                        <div class="form-group">
                            <a href="{{ url('/paymentMethod') }}" class="btn btn-lg btn-success addacard">+ Add a Card</a>
                          </div>
                        </form>

                     </div>
                     <div class="clearfix"></div>
                     <!-- Auto deposit -->
                     <div class="col-md-12">
                       <div class="form-group">
                    <h3 class="box-title">Auto-Deposit
                    <small>Enable this to automatically use a saved card for orders when funds reach $0</small></h3>
                </div>
              </div>
                     <div class="col-md-3">
                      <form method="post" action="{{ url('/autoDeposit') }}">
                          {!! csrf_field() !!}
                     

               <div class="form-group">
                     <label>Credit card to use:</label>
                     <select name="depositEnabled" id="depositEnabled" class="form-control">
              <option value="0">Auto-Deposit Disabled</option>
              <?php if(!empty($cards)){
                          foreach($cards as $card){
                            echo "<option ";
                        if($card['auto_deposit'] == 1){
                          echo 'selected ="selected"';
                        }
                        echo " class=\"depositEnable\" name=\"depositEnable\" value=\"".$card['id']."\" /> Master Card ".$card['card_number']."
                       </option>";
                          }
                        }?>
           </select>  
                 </div>
       <div class="formGroup">
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Update</button>
      </div>
    </form>
    </div>
                    </div>
           
			
			
             </div>
        </div>
    </div>
</div>
@stop

@section('scripts')

<script type="text/javascript" src="{{ URL('js/creditCardValidator.js') }}"></script>
<script>
     jQuery(function($) { 
     $('.checkmethod').click(function() { 
         if($(this).val() == -1){
            $('.paypal-form-wrapper').css('display', 'block');
            $('.custom-card-wrapper').css('display', 'none');
            $('.addacard').removeClass('master-add');
         }else{
           $('.paypal-form-wrapper').css('display', 'none');
           $('.custom-card-wrapper').css('display', 'block');
           $('#cardid').val($(this).val());           
           $('.addacard').addClass('master-add');
         }
         $('#grand-total-pay1').val($('#amount').val());
         $('#grand-total-pay').val($('#amount').val());
      });

      $('.paynow').click(function(e){
        if($('#amount').val() == ''){
          alert('Amount should not be empty');
          return false;
        }
         if($('#amount').val() < 50){
              alert('Amount must be atleast 50');
              return false;
             }
         $('#grand-total-pay').val($('#amount').val());
          $('#grand-total-pay1').val($('#amount').val());
         $('#paypalForm').submit();
        })

     $('#cardSubmitBtn').click(function(e) { 
             if($('#amount').val() == ''){
              alert('Amount should be filled');
              return false;
             }
             if($('#amount').val() < 50){
              alert('Amount must be atleast 50');
              return false;
             }
              $('#grand-total-pay').val($('#amount').val());
          });
 });

@endsection