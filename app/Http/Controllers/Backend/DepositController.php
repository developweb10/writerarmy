<?php

namespace App\Http\Controllers\Backend;

use DB;
use App\Models\Order;
use App\User;
use App\Models\OrderStatus;
use App\Models\Package;
use App\Models\UserDeposit;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Models\EmailTemplate;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Mail;

class DepositController extends Controller
{
   public function __construct()
    {       
        $this->middleware('auth');
    }
    public function depositfund(){
    	$userId = Auth::id(); 
    	$data['userId'] = $userId;
      $getcards =DB::table('payment_method')->where('userId', $userId)->get();
      $getDetails= array();
    foreach($getcards as $card){
      $cardtype = $card->card_type;
      $expiry_month =  $this->encrypt_decrypt('decrypt',$card->expiry_month);
      $expiry_year =  $this->encrypt_decrypt('decrypt',$card->expiry_year);
      $card_number =  $this->encrypt_decrypt('decrypt',$card->card_number);
      $card_number = substr($card_number,-4);
      $getDetails[]= array('card_type'=>$cardtype, 'expires'=> $expiry_month.'/'.$expiry_year, 'card_number' => $card_number, 'id' => $card->id, 'auto_deposit' => $card->auto_deposit);
      
    }
     $data['cards'] = $getDetails;
     return view('dashboard.Deposit.deposit', $data);
    }
	public function postDepositFund(Request $request){
   $transcationId= '';	
       if(isset($_POST['paymenttype']) && $_POST['paymenttype'] == 'savedCard'){
          $cardid= $_POST['cardid'];
          $price= $_POST['amount'];
          $cardDetails = PaymentMethod::findOrFail($cardid);     
          //$firstname =  $cardDetails->card_name;
          $expMonth =  $this->encrypt_decrypt('decrypt',$cardDetails->expiry_month);
          $expYear =  $this->encrypt_decrypt('decrypt',$cardDetails->expiry_year);
          $creditCardNumber =  $this->encrypt_decrypt('decrypt',$cardDetails->card_number);
          $cvv =  $this->encrypt_decrypt('decrypt',$cardDetails->cvc);
          $creditCardNumber = trim(str_replace(" ","",$creditCardNumber));
          $first_name =  $cardDetails->first_name;
          $last_name =  $cardDetails->last_name;
          $request_params = array
                    (
                    'METHOD' => 'DoDirectPayment', 
                    /* 'USER' => 'admin_api1.writerarmy.com', 
                    'PWD' => 'WEQNM8Z2799T9VT4', 
                    'SIGNATURE' => 'AiPC9BjkCyDFQXbSkoZcgqH3hpacAAvVSWmCgbIEutzpx-8vkGJtWrf1', 
                      */
                    'USER' => 'admin_api1.writerarmy.com', 
                    'PWD' => 'WEQNM8Z2799T9VT4', 
                    'SIGNATURE' => 'AiPC9BjkCyDFQXbSkoZcgqH3hpacAAvVSWmCgbIEutzpx-8vkGJtWrf1', 
                    // 'USER' => 'satish.inext-facilitator_api1.gmail.com', 
                    // 'PWD' => 'HS3N4F3KTYPAAN2W', 
                    // 'SIGNATURE' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31AKwYEDJdCUsNHqwpeYFyQ-2JHHuJ', 
                    'VERSION' => '85.0' ,
                    'PAYMENTACTION' => 'Sale',                   
                    'IPADDRESS' => $_SERVER['REMOTE_ADDR'],                 
                    'ACCT' =>$creditCardNumber,                        
                    'EXPDATE' => $expMonth.$expYear,           
                    'CVV2' => $cvv, 
                    'FIRSTNAME' => $first_name, 
                    'LASTNAME' =>  $last_name, 
                     'AMT' => $price, 
                    'CURRENCYCODE' => 'USD', 
                    'STREET' => 'None',
                    'CITY' =>   'None',
                    'STATE' => 'None',
                    'COUNTRYCODE' => 'GB',  
                    'ZIP' => $cardDetails->postal_code,
                    'DESC' => 'Deposit Funds'
                    );
               $nvp_string = '';          
     
              foreach($request_params as $var=>$val)
              {
                  $nvp_string .= '&'.$var.'='.urlencode($val);    
              }
             $curl = curl_init();
              curl_setopt($curl, CURLOPT_VERBOSE, 1); 
              curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
              curl_setopt($curl, CURLOPT_TIMEOUT, 30);
              curl_setopt($curl, CURLOPT_URL, 'https://api-3t.paypal.com/nvp');
              curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
              curl_setopt($curl, CURLOPT_POSTFIELDS, $nvp_string);          
              $result = curl_exec($curl);     
              curl_close($curl);        
              $response_info = array(); 
              parse_str($result, $response_info);
           
            //print_r($response_info);
            if($response_info['ACK'] == 'Failure'){
              flash()->error($response_info['L_LONGMESSAGE0']);
              return Redirect::back();
            }
            if($response_info['ACK'] == 'Success'){
                 $userId = Auth::id();
                 $transcationId = $response_info['TRANSACTIONID'];
                 $trnsactionDate = $response_info['TIMESTAMP'];
                 $user_deposit = New UserDeposit();
                 $user_deposit->userId = $userId;
                 $user_deposit->transaction_id = $transcationId;
                 $user_deposit->transaction_date = $trnsactionDate;
                 $user_deposit->amount = $price;
                 $user_deposit->transaction_type = 1;
                 $user_deposit->save();
                  // send email
                 $user = User::find($userId); 
                 $useremail = $user->email;
                 $username = $user->name;

                 $subjectmessage = 'Payment Deposit successfully';              
                // $emailmessage = '<p>$100 deposit successfully in your account. Now you can purchase order from your balance.</p>'; 
                  $emailmessage = array('amount'=>$price, 'transcationId' => $transcationId, 'username' => $username, 'transactiondate' =>$trnsactionDate );
                 $data = array('user'=>$useremail, 'name' =>$username, 'subject'=>$subjectmessage);           
                 Mail::send('auth.emails.deposit_email', ['emailmessage'=> $emailmessage], function($message) use ($data)
                    {
                        $message->to($data['user'], $data['name'])->subject($data['subject']); 
                  });
                flash()->success('Amount Deposited');
              // end email
                  
            }  

          }
      if(isset($_POST['payment_status']) && $_POST['payment_status'] == 'Completed'){          
             $userId = Auth::id();
             $transcationId = $_POST['txn_id'];
             $trnsactionDate = $_POST['payment_date'];
             $user_deposit = New UserDeposit();
             $user_deposit->userId = $userId;
             $user_deposit->transaction_id = $transcationId;
             $user_deposit->transaction_date = $trnsactionDate;
             $user_deposit->amount = $_POST['payment_gross'];
             $user_deposit->transaction_type = 1;
             $user_deposit->save();
 
            // send email
             $user = User::find($userId); 
             $useremail = $user->email;
             $username = $user->name;

             $subjectmessage = 'Payment Deposit successfully';              
             $emailmessage = array('amount'=>$_POST['payment_gross'], 'transcationId' => $transcationId, 'username' => $username, 'transactiondate' =>$trnsactionDate );
             $data = array('user'=>$useremail, 'name' =>$username, 'subject'=>$subjectmessage);           
             Mail::send('auth.emails.deposit_email', ['emailmessage'=> $emailmessage], function($message) use ($data)
                {
                    $message->to($data['user'], $data['name'])->subject($data['subject']); 
              });
             
              // end email

            flash()->success('Amount Deposited');
            return redirect()->to('thank-you/'.$transcationId);
         }
         return redirect()->to('thank-you/'.$transcationId);
      // return Redirect::back();
        
    }

    public function transaction(){
        $userId = Auth::id();         
        $data['contents'] =DB::table('user_deposits')->where('userId', $userId)->get();
        $balance = DB::select("SELECT SUM( CASE WHEN t.transaction_type = '1' THEN t.amount ELSE t.amount * -1  END   ) AS Total FROM user_deposits as t where userId = ". $userId."");
        $data['availableBalance'] = $balance[0]->Total;
       return view('dashboard.Deposit.transaction', $data);
    }

  public function paymentMethod(){
  	$userId = Auth::id();        
    $getDetails = array(); 
    $getcards =DB::table('payment_method')->where('userId', $userId)->get();
    foreach($getcards as $card){
      $cardtype = $card->card_type;
      $expiry_month =  $this->encrypt_decrypt('decrypt',$card->expiry_month);
      $expiry_year =  $this->encrypt_decrypt('decrypt',$card->expiry_year);
      $card_number =  $this->encrypt_decrypt('decrypt',$card->card_number);
      $card_number = substr($card_number,-4);
      $getDetails[]= array('card_type'=>$cardtype, 'expires'=> $expiry_month.'/'.$expiry_year, 'card_number' => $card_number, 'id' => $card->id);
      
    }
    $data['content'] = $getDetails;    
  	 return view('dashboard.Deposit.paymentMethod', $data);
    
  }
  public function postPaymentMethod(Request $request){  
    $userId = Auth::id();   
    $paymentmethods = new PaymentMethod();
    $paymentmethods->userId = $userId;
    //$paymentmethods->card_name = $request->name_on_card;
    $paymentmethods->first_name = $request->first_name;
    $paymentmethods->last_name = $request->last_name;
    $paymentmethods->card_number = $this->encrypt_decrypt('encrypt',$request->card_number);
    $paymentmethods->expiry_month  = $this->encrypt_decrypt('encrypt',$request->expiry_month);
    $paymentmethods->expiry_year = $this->encrypt_decrypt('encrypt',$request->expiry_year);
    $paymentmethods->cvc  = $this->encrypt_decrypt('encrypt',$request->cvc);
    $paymentmethods->postal_code = $request->postal_code;   
     $paymentmethods->card_type =$request->card_type; 
   
     $paymentmethods->save();
     flash()->success('Payment Method saved successfully');
         
      return Redirect::back();
        
  }

   public function deleteCard($id) {   
        $paymethods = PaymentMethod::findOrFail($id);
        $paymethods->delete();
        flash()->success('Payment Card Deleted successfully');
        return Redirect::back();
    }
   public function thankYou() {
     return view('dashboard.Deposit.thankyou');
   }
function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'This is my secret key';
    $secret_iv = 'This is my secret iv'; 
    $key = hash('sha256', $secret_key);    
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

public function autoDeposit(Request $request){
  
     $userId = Auth::id(); 
     $values=array('auto_deposit'=>0);
     $update = PaymentMethod::where('userId', '=', $userId)->update($values);  
     if($request->depositEnabled != 0){  
      $values=array('auto_deposit'=>1);
      $update = PaymentMethod::where('id', '=', $request->depositEnabled)->update($values);    
    }
 return Redirect::back();
}

}
?>