<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default credit-card-box">
            <div class="panel-heading display-table" >
                <div class="row display-tr" >
                    <h3 class="panel-title display-td" style="color: green">Payment Details Form</h3>
                    <div class="display-td" >
                        <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-md-12">

                    <div class="form-group">
                        <label>
                            <span>Payment Amount (USD)</span>

                            @if($contents->type == "article")
                                <input type="text" name="paid_amount" id="payment_amount" class="text-center" placeholder="$" readonly>
                            @elseif($contents->type == "social")
                                <input type="text" name="paid_amount" id="payment_amount2" class="text-center" placeholder="$" readonly>
                            @endif

                        </label>
                    </div>

                    <div class="form-group">
                        <label>
                            <span>Card Number</span>
                            <input type="text" data-stripe="number">
                        </label>
                    </div>

                    <div class="form-group">
                        <label>
                            <span>CVC (3 or 4 digit number)</span>
                            <input type="text" data-stripe="cvc">
                        </label>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label(null, 'Ex. Month') !!}
                                <input type="text" data-stripe="exp-month" class="form-control" placeholder="MM">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label(null, 'Ex. Year') !!}
                                <input type="text" data-stripe="exp-year" class="form-control" placeholder="YYYY">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Place order!', ['class' => 'btn btn-lg btn-block btn-primary btn-order', 'id' => 'submitBtn', 'style' => 'margin-bottom: 10px;']) !!}
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
