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
          <h3 class="box-title">Payment Method</h3>
        </div>
        <div class="box-body addpackage">
            <table id="example2" class="table table-bordered table-striped table-hover">
              <tr>
                <th>Issuer</th>
                <th>Card Last Four</th>
                <th>Expires</th>
                <th>Action</th>
              </tr>
              <?php if(!empty($content)){
                 foreach($content as $row){ ?>
                  <tr>
                <td><?php echo $row['card_type'] ?></td>
                <td><?php echo $row['card_number'] ?></td>
                <td><?php echo $row['expires'] ?></td>
                <td>
                  <form method="POST" action="{{ url('/deleteCard/'.$row['id']) }}">
                      {{ csrf_field() }}
                      <input type="hidden" name="_method" value="DELETE">
                      <span class="glyphicon glyphicon-trash"></span>
                      <button type="submit">Delete</button>
                  </form></td>
              </tr>

                 <?php }

              } ?>
            </table>
            <div id="addacard"  class="btn btn-lg btn-success addacard">+ Add a Card</div>
         </div>
     </div>
  </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-body">
        <form method="post" action="{{ url('/postPaymentMethod') }}" >
                 {!! csrf_field() !!}
                   <div class="">
                      <!-- <div class="form-group">
                        <input type="hidden" name="card_type" id="card_type" value="" />
                    <label for="name_on_card">Name on card</label>
                      <input type="text" placeholder="user name" id="name_on_card" class="form-control"  name="name_on_card" required>
                     </div> -->
                     <div class="form-group">
                        <input type="hidden" name="card_type" id="card_type" value="" />
                    <label for="first_name">First Name</label>
                      <input type="text" placeholder="First Name" id="first_name" class="form-control"  name="first_name" required>
                     </div>
                     <div class="form-group">
                      
                    <label for="last_name">Last Name</label>
                      <input type="text" placeholder="Last Name" id="last_name" class="form-control"  name="last_name" required>
                     </div>
                     <div class="form-group">
                     <label>Card Number</label>
                     <input type="text" placeholder="1234 5678 9012 3456" id="card_number" class="form-control" name="card_number" required>
                      </div>
                  
                      <div class="form-group">
                        <label for="">Ex. Month</label>
                          <select id="expiry_month" class="form-control" name="expiry_month" required="required">
                                    <option>select month</option>
                                <?php 
                                $months= array('01','02','03','04','05','06','07','08','09','10', '11', '12');
                               
                                for($i=0; $i< count($months); $i++){
                                    echo '<option value="'.$months[$i].'" placeholder="select month" >'.$months[$i].'</option>';
                                } 
                                 ?>
                            </select> 
                        
                 </div>
                 <div class="form-group">
                   <label>Expiration date</label>
                 <input type="text" placeholder="YYYY" maxlength="5" id="expiry_year" class="form-control" name="expiry_year" required>
                </div>
                 <div class="form-group">
                   <label>CVC (3 or 4 digit number)</label>
                      <input type="text" placeholder="1234" maxlength="4" id="cvv" class="form-control" name="cvv" required>
                     
                   </div>
                  <div class="form-group">
                   <label>Postal Code</label>
                      <input type="text" id="postal_code" class="form-control" name="postal_code" required>
                     
                 </div>
                <div class="form-group custom_payment_buttons">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                   <input type="submit" id="cardSubmitBtn" class="btn btn-primary" value="Add Card" />
                   
                 </div>
               </div>
                </form>
      </div>
     
    </div>

  </div>
</div>
@stop

@section('scripts')
 <script type="text/javascript" src="{{ URL('js/jquerycreditcardvalidator.js') }}"></script>
<script>
  jQuery(function($) {
    $('#addacard').click(function(e){
        $('#myModal').modal('show');
     });
     $('#cardSubmitBtn').click(function(e) {                  
               var cardName = $("#name_on_card").val();
                var expMonth = $("#expiry_month").val();
                var expYear = $("#expiry_year").val();
                var cvv = $("#cvv").val();
                var regName = /^[a-z ,.'-]+$/i;
                var regMonth = /^01|02|03|04|05|06|07|08|09|10|11|12$/;
                var regYear = /^2019|2020|2021|2022|2023|2024|2025|2026|2027|2028|2029|2030|2031$/;
                var regCVV = /^[0-9]{3,4}$/;    
                 if(!regMonth.test(expMonth)){ 
                    alert('Invalid expiry month');       
                    return false;
                }else if(!regYear.test(expYear)){  
                 alert('Invalid expiry Year');    
                     return false;
                }
                else if(!regCVV.test(cvv)){  
                 alert('Invalid cvv');                  
                    return false;
                }
                else if(!regName.test(cardName)){  
                 alert('Invalid name');                   
                   return false;
                }else{
                    return true;
                }
                return false;  
                e.preventDefault();   

            });
 });
</script>
@endsection