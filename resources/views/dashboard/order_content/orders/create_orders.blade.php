@extends('dashboard.master')

@section('styles')
    <style>
        .order-form {
            line-break: normal;
        }

        input[type='number'] {
            -moz-appearance:textfield;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .blue {
            color: cornflowerblue;
        }

        .green {
            color: #008000;
        }
		.required_field_custom .form-group p span {
             color: #7ba468;
		}
		.required_field_custom .form-group label span {
				color: #7ba468;
				padding-left: 5px;
		}
		.has-error .help-block{
			color: #dd4b39;
		}
		.has-error .form-control
		{
			border-color: #dd4b39 !important;
		}
		.form-group.has-error label span {
			color: #dd4b39;
		}

    </style>

    {{--<style>--}}
        {{--.alert.parsley {--}}
            {{--margin-top: 5px;--}}
            {{--margin-bottom: 0px;--}}
            {{--padding: 10px 15px 10px 15px;--}}
        {{--}--}}
        {{--.check .alert {--}}
            {{--margin-top: 20px;--}}
        {{--}--}}
        {{--.credit-card-box .panel-title {--}}
            {{--display: inline;--}}
            {{--font-weight: bold;--}}
        {{--}--}}
        {{--.credit-card-box .display-td {--}}
            {{--display: table-cell;--}}
            {{--vertical-align: middle;--}}
            {{--width: 100%;--}}
        {{--}--}}
        {{--.credit-card-box .display-tr {--}}
            {{--display: table-row;--}}
        {{--}--}}
    {{--</style>--}}
	</style>
@endsection

@section('content')



<div class="row">

    <div class="container create-order-form-headings">
        <a class="btn btn-success pull-right" href="{{ URL::to('content/menu') }}"> Back </a>
        <h2 class="text-center center-headings"> {{ $contents->title }} </h2>
        <br>
    </div>

@cannot('admin.access')
    {!! Form::open(['url'=> ['content', $contents->id],'id'=>'payment-form', 'data-parsley-validate', 'class' => 'form', 'enctype'=>'multipart/form-data']) !!}
@endcan

@can('admin.access')
    {!! Form::open(['url'=> ['content', $contents->id], 'data-parsley-validate', 'class' => 'form', 'enctype'=>'multipart/form-data']) !!}
@endcan

<?php $additional_fields = json_decode($contents->additional_fields); ?>
<?php $words = json_decode($contents->word_selection) ?>
    <div class="container order-form create-order-form">
    
<div class="col-md-6 create-order-form-img">
            
              <?php /*?>  <h4 class="blue"> {{ $contents->title }} </h4><?php */?>
                <?php
                   $lowest_price =  $highest_price = '';
                    if($contents->type == "social") {
                        $lowest_price = ($contents->price);
                        $highest_price = (($contents->direct_posting_price + $contents->price));
                    }elseif($contents->type == "article") {
                        $lowest_price = (($contents->direct_posting_price + $contents->price) * min($words));
                        $highest_price = (($contents->direct_posting_price + $contents->price) *  max($words));
                    }
                    else{
                        $lowest_price = $contents->price;
                        $highest_price = $contents->price * 25;
                    }
                ?>
              
  

            <div class="col-md-12">
                @if($contents->image_path)
                    {!! HTML::image($contents->image_path, $contents->image_path,['class' => 'img-responsive', 'height' => '500', 'width' => '500', 'alt' => 'SEO picture']) !!}
                @endif
                
                <br>

                <?php if($contents->type != 'form'){ ?>
                  <h4 class ="green"> ${{ number_format((float)$lowest_price, 2, '.', '') }}-${{ number_format((float)$highest_price, 2, '.', '') }}</h4>
                 <?php } ?>
               
            </div>

            <div class="col-md-12">

                @if($contents->type == "article")
                    <p> To order {{ trim($contents->title, "Service") }}, now please select your desired word count and quantity of articles. Then Add to Cart.</p>
                @endif

                @if($contents->type == "social")
                    <p>Do you want us to post directly to your account? (${{ number_format((float)$contents->direct_posting_price, 2, '.', '') }} extra per post)</p>
                @endif
            </div>
        </div>
    
    
        <div class="col-md-6 create-order-form-con required_field_custom">
          <?php if($contents->type == "form"){ ?>
               <div class="form-group row ">
                <label class="control-label col-sm-4">Your Name<span>*</span> </label>
                <div class="col-sm-8"> 
                   <input class="form-control" name="name" value="" required="required" />
                </div>
               </div>
                <div class="form-group row ">
                <label class="control-label col-sm-4">Your message<span>*</span> </label>
                <div class="col-sm-8"> 
                   <textare class="form-control" name="message"></textare>
                </div>
               </div>
               <div class="text-center">
                <button type="submit" class="btn btn-lg btn-success pull-right order-popup-btn">
                        Send
               </button>
               </div>
         <?php   }else{ ?>

            <div class="form-group row hidden">
                <label class="control-label col-md-3"> Package ID</label>
                <div class="col-md-2">
                    {!! Form::number('package_id', $contents->id ,['class'=>'form-control']) !!}
                </div>
            </div>
		 <div class="form-group row ">
		<p><span>*</span> Indicates Required Field</p>
		</div>

        @if($contents->type == "article" )
            <div class="form-group row ">
                <label class="control-label col-sm-4"> Word Count<span>*</span> </label>
                <div class="col-sm-8"> 
                    <select class="form-control" name="total_words" id="words" onchange="findTotal()" >
                        @if($contents->word_selection && $contents->word_selection != '')
                            <option value="">Select</option>
                            <?php                        
                             $words = json_decode($contents->word_selection) ?>
                            
                            @foreach($words as $word)
                                <option value="{{ $word }}">{{ $word }} Words</option>
                            @endforeach                            
                        @endif
                    </select>
                </div>
            </div>
        @endif


        @if($contents->type == "social")
            <div class="form-group row">
                <label class="control-label col-sm-4"> Post Directly to My Account </label>
                <div class="col-sm-8">
                    <select class="form-control" name="direct_posting" id="post_account" onchange="findTotal2()"  required>
                        <option value="">Select</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>
        @endif

            <div class="form-group row">
                <label class="control-label col-sm-4"> Quantity<span>*</span></label>

            @if($contents->type == "article")
                <div class="col-sm-8">
					<select class="form-control" name="quantity" id="qty" onchange="findTotal()"  required>
						<?php for($i= 1; $i <= 25; $i++){
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                        ?> 
                    </select>
                    <!--{!! Form::number('quantity', 1,['class'=>'form-control','placeholder'=>'0', 'id'=>'qty', 'onkeyup'=>'findTotal()', 'required']) !!}-->
                </div>
            @elseif($contents->type == "social")
                <div class="col-sm-8">
					<select class="form-control" name="quantity" id="qty" onchange="findTotal2()"  required>
                        <?php for($i= 1; $i <= 25; $i++){
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                        ?>                        
                    </select>
                    <!--{!! Form::number('quantity', 1,['class'=>'form-control','placeholder'=>'0', 'id'=>'qty', 'onkeyup'=>'findTotal2()', 'required']) !!}-->
                </div>
            @else
               <div class="col-sm-8">
                <input type="hidden" id="singleadprice" value="{{$contents->price}}" />
                    <select class="form-control" name="quantity" id="qty" onchange="findTotal3()"  required>
                        <?php for($i= 1; $i <= 25; $i++){
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                        ?>                        
                    </select>               
                </div>
            @endif
            </div>

        @if($contents->type == "article" || $contents->type == "perAd" )
            <div class="form-group row">
                <label class="control-label col-sm-4"> Topic<span>*</span></label>
                <div class="col-sm-8">
                    {!! Form::text('topic', null,['class'=>'form-control','placeholder'=>'Topic','required']) !!}
                </div>
            </div>
        @endif



        @if($additional_fields != '')
        @if(in_array("type_style", $additional_fields))
        {{--@if($contents->id != 6 && $contents->id != 8 && $contents->id != 9)--}}
            <div class="form-group row">
                <label class="control-label col-sm-4"> Writing Style </label>
                <div class="col-sm-8">
                    <select class="form-control" name="type_style" required>
                        <option value="professional">Formal/Professional</option>
                        <option value="casual">Casual</option>
                        <option value="satirical">Satirical/Witty</option>
                        <option value="educational">Instructional/Educational</option>
                    </select>
                </div>
            </div>
        {{--@endif--}}
        @else

        @endif
      

        @if(in_array("type_of_press_release", $additional_fields))
            <div class="form-group row">
                <label class="control-label col-sm-4"> Type of Press Release </label>
                <div class="col-sm-8">
                    <select class="form-control" name="type_of_press_release" required>
                        <option value="launch">Launch</option>
                        <option value="event">Event</option>
                        <option value="new_product">New Product or Service</option>
                        <option value="company_changes">Company Changes</option>
                        <option value="general_news">General News</option>
                        <option value="fundraising">Fundraising</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>
        @else

        @endif

        @if(in_array("quotes", $additional_fields))
            <div class="form-group row">
                <label class="control-label col-sm-4"> Quotes to Include</label>
                <div class="col-sm-8">
                    {!! Form::text('quotes', null,['class'=>'form-control','placeholder'=>'Quotes to Include']) !!}
                </div>
            </div>
        @else

        @endif

  @endif
        @if($contents->type == "social")
            <div class="form-group row">
                <label class="control-label col-sm-4"> Types of Posts </label>
                <div class="col-sm-8">
                    <form>
                        <input type="checkbox" name="types_of_posts[]" value="tips">Tips<br>
                        <input type="checkbox" name="types_of_posts[]" value="questions">Questions<br>
                        <input type="checkbox" name="types_of_posts[]" value="quotes">Quotes<br>
                        <input type="checkbox" name="types_of_posts[]" value="news_stories">News Stories/Links<br>
                        <input type="checkbox" name="types_of_posts[]" value="entertaining">Entertaining/Witty<br>
                    </form>
                </div>
            </div>
        @endif

            <div class="form-group row">
                <label class="control-label col-sm-4"> Target Audience</label>
                <div class="col-sm-8">
                    {!! Form::text('target_audience', null,['class'=>'form-control','placeholder'=>'Target Audience', ]) !!}
                </div>
            </div>

     @if($additional_fields != '')
        @if(in_array("reference_url", $additional_fields))
            <div class="form-group row">
                <label class="control-label col-sm-4"> Reference(URLs)</label>
                <div class="col-sm-8">
                    {!! Form::text('reference_url', null,['class'=>'form-control','placeholder'=>'type here', ]) !!}
                </div>
            </div>
        @else

        @endif
     @endif
     
        @if($contents->type == "article" || $contents->type == "perAd")
            <div class="form-group row">
                <label class="control-label col-sm-4"> SEO Keywords</label>
                <div class="col-sm-8">
                    {!! Form::text('seo_keywords', null,['class'=>'form-control','placeholder'=>'SEO Keywords']) !!}
                </div>
            </div>
        @endif

            <div class="form-group row">
                <label class="control-label col-sm-4"> Order Details<span>*</span></label>
                <div class="col-sm-8">
                    {!! Form::textarea('order_details', null,['class'=>'form-control','placeholder'=>'','rows'=>'3', 'placeholder'=>'Order Details', 'required']) !!}
                </div>
            </div>

             @if($contents->id)
               <div class="form-group row">
                <label class="control-label col-sm-4">Hire Industry Specialist Writer?</label>
                <div class="col-sm-8">
                    <select id="hirespecialist" class="form-control">
                        <option value="yes">Yes</option>
                        <option value="no" selected="selected">No</option>
                    </select>
                    <input type="hidden" value="0" id="hirespecialistval" />
                </div>
            </div>
             @endif

            <div class="form-group row">
                <br>
                <label class="control-label col-sm-4"> Attachments/ Supporting docs</label>
                <div class="col-sm-8">
                    {{ Form::file('attachment', ['class'=>'attachment']) }}
                </div>
            </div>


            <div class="form-group row hidden">
                <label class="control-label col-sm-4"> Price per Word</label>

            @if($contents->type == "article")
                <div class="col-sm-8">
                    {!! Form::text('', $contents->price,['class'=>'form-control','placeholder'=>'','rows'=>'3', 'id'=>'price_per_word', 'onkeyup'=>'findTotal()', 'readonly']) !!}
                </div>
            @elseif($contents->type == "social")
                <div class="col-sm-8">
                    {!! Form::text('', $contents->price,['class'=>'form-control','placeholder'=>'','rows'=>'3', 'id'=>'price_per_post', 'onkeyup'=>'findTotal2()', 'readonly']) !!}
                </div>
            @endif
                <br>
            </div>

            <div class="form-group row hidden">
                <label class="control-label col-sm-4"> Direct Posting Price</label>

                @if($contents->type == "social")
                    <div class="col-sm-8">
                        {!! Form::text('', $contents->direct_posting_price,['class'=>'form-control','placeholder'=>'','rows'=>'3', 'id'=>'direct_posting_price', 'onkeyup'=>'findTotal2()', 'readonly']) !!}
                    </div>
                @endif
                <br>
            </div>

            <div class="form-group row">
                <input type="hidden" id="finalTotal" />
                <label class="control-label col-sm-4"> Total</label>

                @if($contents->type == "article")
                    <div class="col-sm-8">
                        {!! Form::text('price', null,['class'=>'form-control','placeholder'=>'','rows'=>'3', 'id'=>'total', 'readonly']) !!}
                    </div>
                @elseif($contents->type == "social")
                    <div class="col-sm-8">
                        {!! Form::text('price', null,['class'=>'form-control','placeholder'=>'','rows'=>'3', 'id'=>'total2', 'readonly']) !!}
                    </div>
                  @else
                    <div class="col-sm-8">
                        {!! Form::text('price', $contents->price,['class'=>'form-control','placeholder'=>'','rows'=>'3', 'id'=>'total2', 'readonly']) !!}
                    </div>
                @endif
                <br>
            </div>


            <div class="form-group row hidden">
                <label class="control-label col-sm-4"> Advance Payment Amount</label>
                <div class="col-sm-8">
                    {!! Form::text('advance_payment_amount', null,['class'=>'form-control advance-amount','placeholder'=>'','rows'=>'3']) !!}
                </div>
            </div>

            {{--<div class="col-sm-12">--}}
                {{--<br>--}}
                {{--{!! Form::submit('Add to Cart', ['class'=>'btn btn-lg btn-success pull-right']) !!}--}}
                {{--<button class="btn btn-danger" type="reset">Reset</button>--}}
            {{--</div>--}}

            <div class="text-center">
                <!-- Trigger the modal with a button -->

                @if (auth()->user()->hasRole('admin'))
                    <input type="submit" value="Order" class="btn btn-lg btn-success pull-right">
                @else
                   
                    <input type="hidden" value="{{ $availableBalance }}" id="availableBalance" />
                    <input type="hidden" value="{{ $isAutoEnabled }}" id="isAutoEnabled" />
                   <button type="submit" class="btn btn-lg btn-primary custom-pay-btn" id="paywithbalance" <?php if(!$isAutoEnabled){ echo ' disabled="disabled"'; } ?> >
                        Pay with Balance
                    </button>
                    <a href="{!! URL::to('depositFunds') !!}" class="btn btn-lg btn-primary pull-right custom-pay-btn" >Deposit Funds</a>
                  
                    <!-- <button type="button" class="btn btn-lg btn-success pull-right order-popup-btn" >
                        Order
                    </button> -->
                @endif


                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                                {{--@if($user->subscribed())--}}

                                    @include('dashboard.order_content.partials.paypal_card_info')

                                {{--@endif--}}

                            </div>
                        </div>

                    </div>
                </div>
            </div>


            {!! Form::close() !!}
            <?php } ?>
        </div>
        </div>

        
    </div>
</div>


<div class="container description-tabi">
    <div class="nav nav-tabs">
        <ul class="nav nav-tabs">
            <li role="presentation" class="active blue"><a href="#description" data-toggle="tab" ><strong> Description </strong></a></li>
			<?php if($user->roles->first()->name == 'Admin') { ?> <li role="edit" class="blue"><a href="#edit" data-toggle="tab" id="editContent" ><strong> Edit </strong></a></li> <?php } ?>
        </ul>
        {{--<h3>
            Product Description
        </h3>

        <div style="direction: ltr; text-transform: capitalize; border: 1px solid powderblue; padding: 30px;">
            {{ $contents->description }}--}}
        <div class="tab-content">
        <div id="description" class="tab-pane fade in active">
        <h2>Product Description</h2>
        
       <?php  
	   echo $contents->content;	  
	   
	   ?>

          </div>
		<?php if($user->roles->first()->name == 'Admin') { ?>   <div id="edit" class="tab-pane fade">               
		        <form method="post" action= "{{ url('/updateContent') }}" name="editcontent">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name= "id" value="{{$contents->id}}" />
                 <div class="form-group row">
                  <label for="content">Description:</label>                 
                  <textarea name="content"  class="form-control" id="area2"  cols="100" rows="50">{{ $contents->content}}</textarea>
               </div>
                 <div class="form-group row">
                 <input type="submit" class="btn btn-default"  name="updatecontent" value="Update" />
               </div>
             </form>
		
		   </div>
           <?php } ?>
            
           </div>
    </div>
</div>
</div>
@stop


@section('scripts')

    {{--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>--}}
    {{--<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>--}}

<script type="text/javascript" src="{{ URL('js/creditCardValidator.js') }}"></script>

    <script type="text/javascript">
        function findTotal(){
            var words = document.getElementById('words').value;
            var price_per_word = document.getElementById('price_per_word').value;
            var qty = document.getElementById('qty').value;

            if(words == "") words=0; if(price_per_word == "") price_per_word=0; if(qty == "") qty=0;

            var total = ((parseFloat(words) * parseFloat(price_per_word)) * parseFloat(qty)).toFixed(2);

            if(!isNaN(total)){
                 var avb =  parseInt($('#availableBalance').val());
                 if($('#isAutoEnabled').val() == 0){
                        if(total <= avb){
                           $('#paywithbalance').removeAttr('disabled');
                        }else{
                            $('#paywithbalance').attr('disabled', 'disabled');
                        }
                 }else{
                   $('#paywithbalance').removeAttr('disabled') 
                 }
            
                $('#finalTotal').val(total);
                var hirespecialistval = (total*40/100).toFixed(2);
                $('#hirespecialistval').val(hirespecialistval);

                total = $('#finalTotal').val();
                if($('#hirespecialist').val() != ''){
                  if($('#hirespecialist').val() == 'yes'){
                    total =  parseFloat($('#finalTotal').val()) + parseFloat($('#hirespecialistval').val())
                 }
                }
                document.getElementById('total').value = total;
                document.getElementById('payment_amount').value = total;
                document.getElementById('price_payment').value = total;
                }
        }
    </script>

    <script type="text/javascript">
        function findTotal2(){
            var post_account = document.getElementById('post_account').value;
            var qty = document.getElementById('qty').value;
            var direct_posting_price = document.getElementById('direct_posting_price').value;
            var price_per_post = document.getElementById('price_per_post').value;

            if(post_account == "1") post_account= parseFloat(direct_posting_price) + parseFloat(price_per_post);
            if(post_account == "0") post_account= price_per_post;
            if(qty == "") qty=0;

            var total2 = (parseFloat(post_account) * parseFloat(qty)).toFixed(2);

            if(!isNaN(total2)){
                 var avb =  parseInt($('#availableBalance').val());               
                 if($('#isAutoEnabled').val() == 0){
                        if(total <= avb){
                           $('#paywithbalance').removeAttr('disabled');
                        }else{
                            $('#paywithbalance').attr('disabled', 'disabled');
                        }
                 }else{
                   $('#paywithbalance').removeAttr('disabled') 
                 }
                $('#finalTotal').val(total2);
                var hirespecialistval = (total2*40/100).toFixed(2);
                $('#hirespecialistval').val(hirespecialistval);

                total2 = $('#finalTotal').val();
                if($('#hirespecialist').val() != ''){
                  if($('#hirespecialist').val() == 'yes'){
                    total2 =  parseFloat($('#finalTotal').val()) + parseFloat($('#hirespecialistval').val())
                 }
                }
            
                document.getElementById('total2').value = total2;
                document.getElementById('payment_amount2').value = total2;
                
            }
        }

         function findTotal3(){
            var singleadprice = document.getElementById('singleadprice').value;
            var qty = document.getElementById('qty').value;      
            var total2 = (parseFloat(singleadprice) * parseFloat(qty)).toFixed(2);

            if(!isNaN(total2)){
                 var avb =  parseInt($('#availableBalance').val());               
                 if($('#isAutoEnabled').val() == 0){
                        if(total2 <= avb){
                           $('#paywithbalance').removeAttr('disabled');
                        }else{
                            $('#paywithbalance').attr('disabled', 'disabled');
                        }
                 }else{
                   $('#paywithbalance').removeAttr('disabled') 
                 }

                $('#finalTotal').val(total2);
                var hirespecialistval = (total2*40/100).toFixed(2);
                $('#hirespecialistval').val(hirespecialistval);

                total2 = $('#finalTotal').val();
                if($('#hirespecialist').val() != ''){
                  if($('#hirespecialist').val() == 'yes'){
                    total2 =  parseFloat($('#finalTotal').val()) + parseFloat($('#hirespecialistval').val())
                 }
                }
                document.getElementById('total2').value = total2;
                document.getElementById('payment_amount2').value = total2;              
            }            
        }
    </script>


{{--For Payment System Laravel Cashier--}}



    <!-- New section -->
    <script type="text/javascript">   
        
 
        jQuery(function($) {
            $('#cardSubmitBtn').click(function(e) {
               //var cardnumber = $("#card_number").val();                  
               var cardName = $("#name_on_card").val();
                var expMonth = $("#expiry_month").val();
                var expYear = $("#expiry_year").val();
                var cvv = $("#cvv").val();
               //var regNum = /^[0-9]$/;
                var regName = /^[a-z ,.'-]+$/i;
                var regMonth = /^01|02|03|04|05|06|07|08|09|10|11|12$/;
                var regYear = /^2017|2018|2019|2020|2021|2022|2023|2024|2025|2026|2027|2028|2029|2030|2031$/;
                var regCVV = /^[0-9]{3,3}$/;    

                
               // if(!regNum.test(cardnumber)){
               //      $('#card_number').css('border-color','red');
               //      //alert('Invalid Expiry Month');
               //      return false;
               //  }

                 if(!regMonth.test(expMonth)){
                    
                    //alert('Invalid Expiry Month');
                    return false;
                }else if(!regYear.test(expYear)){

                    
                    //alert('Invalid Expiry Year');
                     return false;
                }
                else if(!regCVV.test(cvv)){
                    //alert('Invalid CVV');
                    
                    return false;
                }
                else if(!regName.test(cardName)){
                     //alert('Invalid Card Name');
                     
                   return false;
                }else{
                    return true;
                }
                
                return false;  
                e.preventDefault();    


                
            });

			$('#payment-form').validate({

					errorElement: 'span',
					errorClass: 'help-block',
					highlight: function(element, errorClass, validClass) {
						$(element).closest('.form-group').addClass("has-error");
					},
					unhighlight: function(element, errorClass, validClass) {
						$(element).closest('.form-group').removeClass("has-error");
					},
					rules: {
						total_words: {
							required: true,		
						},
						
						quantity: {
							required: true,
						},
						topic: {
							required: true,
						},
					order_details: {
							required: true,
						},
						
					},
					messages: {
						total_words: {
							required: "Word Count is required",
						},
						
						quantity: {
							required: "quantity is required",
						},
						topic: {
							required: "topic is  required",
						},
						order_details: {
							required: "order details is  required",
						},
					}
				
			}); 
			$('.order-popup-btn').click(function(e){
			e.preventDefault();
			var form = $("#payment-form");
				form.validate({
				errorElement: 'span',
					errorClass: 'help-block',
					highlight: function(element, errorClass, validClass) {
						$(element).closest('.form-group').addClass("has-error");
					},
					unhighlight: function(element, errorClass, validClass) {
						$(element).closest('.form-group').removeClass("has-error");
					},
					rules: {
						total_words: {
							required: true,		
						},
						
						quantity: {
							required: true,
						},
						topic: {
							required: true,
						},
					order_details: {
							required: true,
						},
						
					},
					messages: {
						total_words: {
							required: "Word Count is required",
						},
						
						quantity: {
							required: "quantity is required",
						},
						topic: {
							required: "topic is  required",
						},
						order_details: {
							required: "order details is  required",
						},
					}
			});
			if (form.valid() === true){
			$('#myModal').modal('show');
			}
			});

            $('#hirespecialist').click(function(){
                if($(this).val()== 'yes'){
                  total =  parseFloat($('#finalTotal').val()) + parseFloat($('#hirespecialistval').val());
                }                  
                else{
                   total = $('#finalTotal').val();
                }
                document.getElementById('total').value = total;
                document.getElementById('payment_amount').value = total;
                document.getElementById('price_payment').value = total;
            });

        });

    </script>
    <script type="text/javascript" src="{{ URL('js/nicEdit-latest.js') }}"></script>
<script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.js"></script>
    <script>        
       //<![CDATA[
                  new nicEditor({fullPanel : true}).panelInstance('area1');                 
          //]]>   
jQuery(document).ready(function($){
   
}); 
    </script>
@endsection
