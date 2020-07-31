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
          <h3 class="box-title">Transactions</h3>
        </div>
        <div class="box-body addpackage">
              <?php if(!empty($contents)){ ?>
          <table id="example2" class="table table-bordered table-striped table-hover">
              <tr><th>Date</th><th>Transaction Id</th><th>Amount</th></tr>
             <?php 
             $total = 0;
             foreach($contents as $content){
             	if($content->transaction_type == 1){
             		  $total += $content->amount; 
             	}else{
             		 $total -= $content->amount; 
             	}
             	$transactiondate = date('Y-m-d H:i:s A', strtotime($content->transaction_date));
             		echo '<tr><td>'.$transactiondate.'</td><td>'.$content->transaction_id.'</td><td>';
                  if($content->transaction_type == 0){
                    echo '-';
                     }else{
                      echo '+';
                     }
                echo '$'.$content->amount.'</td></tr>';
                 }
                 echo '<tr><td colspan="2"><strong>Available Balance</strong></td><td>$'.$availableBalance.'</td>';
                  ?>
            </table>
           <?php } ?>              
         </div>
     </div>
  </div>
</div>
@stop
