<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default credit-card-box">
            <div class="panel-heading display-table" >
                <div class="row display-tr" >
                    <h3 class="panel-title display-td" style="color: green">Payment Details Form</h3>
                    <div class="display-td" >
                        <img class="img-responsive pull-right" src="{{ URL('global/img/accepted_c22e0.png') }}">
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-md-12">

                    <!-- <div class="form-group">
                        <label>
                            <span>Payment Amount (USD)</span>

                            @if($contents->type == "article")
                                <input type="text" name="paid_amount" id="payment_amount" class="text-center" placeholder="$" readonly>
                            @elseif($contents->type == "social")
                                <input type="text" name="paid_amount" id="payment_amount2" class="text-center" placeholder="$" readonly>
                            @endif

                        </label>
                    </div> -->

                     <div class="form-group">
                        <label>
                            <span>Card Number</span>
                     
                         <input type="text" placeholder="1234 5678 9012 3456" id="card_number" class="form-control" name="card_number">
                
                        </label>
                    </div>

                            <div class="form-group">
                                {!! Form::label(null, 'Ex. Month') !!}

                                  <select id="expiry_month" class="form-control" name="expiry_month">
                                    <option>select month</option>
                                <?php 
                                $months= array('01','02','03','04','05','06','07','08','09','10', '11', '12');
                               
                                for($i=0; $i< count($months); $i++){
                                    echo '<option value="'.$months[$i].'" placeholder="select month" >'.$months[$i].'</option>';
                                } 
                                 ?>
                            </select> 
                         <!-- <input type="text" placeholder="MM" maxlength="5" id="expiry_month" class="form-control" name="expiry_month"> -->
                            </div>
                        
                        
                            <div class="form-group">
                                {!! Form::label(null, 'Ex. Year') !!}
                             
                         <input type="text" placeholder="YYYY" maxlength="5" id="expiry_year" class="form-control" name="expiry_year">
                            </div>


                             <div class="form-group">
                        <label>
                            <span>CVC (3 or 4 digit number)</span>
                            <input type="text" placeholder="1234" maxlength="4" id="cvv" style="display: inherit;" class="form-control" name="cvv">
                        </label>
                    </div>

                    <div class="form-group">
                    <label for="name_on_card">Name on card</label>
                    <input type="text" placeholder="user name" id="name_on_card" class="form-control" name="name_on_card">
                </div> 

                    <div class="form-group">
                         {!! Form::submit('Place order!', ['class' => 'btn btn-lg btn-block btn-primary payment-btn ', 'name'=> 'card_submit', 'id' => 'cardSubmitBtn', 'style' => 'margin-bottom: 10px;']) !!}
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <span class="payment-errors" style="color: red;margin-top:10px; display: block"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


