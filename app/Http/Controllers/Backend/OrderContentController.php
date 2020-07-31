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
use Stripe\Stripe;
use Mail;

class OrderContentController extends Controller
{
    public function __construct()
    {       
        $this->middleware('auth');
    }
    public function index()
    {
        $data['contents'] = Package::all();        
        return view('dashboard.order_content.menu', $data);
    }

    public function createOrders($id)
    {
        $data['user'] = Auth::user();
        $data['contents'] = Package::findOrFail($id);
         $userId = Auth::id(); 
	//	print_r($data);
        $balance = DB::select("SELECT SUM( CASE WHEN t.transaction_type = '1' THEN t.amount ELSE t.amount * -1  END   ) AS Total FROM user_deposits as t where userId = ". $userId."");
        $data['availableBalance'] = $balance[0]->Total;      


         $getactive =  DB::select("SELECT * from payment_method where userId = ". $userId." and auto_deposit = '1'");         
         if(!empty($getactive)){
            $data['isAutoEnabled'] = 1;
         }else{
            $data['isAutoEnabled'] = 0;
         }		
        return view('dashboard.order_content.orders.create_orders', $data);
    }

	public function orderConfirmation($id)
    { 
     $data['user'] = Auth::user();
     $data['orderdata'] = Order::findOrFail($id);
	return view('dashboard.order_content.orders.order_confirmation', $data);
    }

   public function updateContent(Request $request){	 
	    $id = $request->id; 	  
	    $Package = Package::find($id);
		$Package->content = $request->content; 
		if($Package->save()){
		  flash()->success('Updated Successfully');	
		}
		else{
			 flash()->success('Try Again');	
		}	

        return Redirect::back();
   }

    public function storeOrders(Request $request)
    {
    
       //print_r($_REQUEST);

       if ($request->user()->can('admin.access')) {
            $orders = New Order();
            $orders->package_id = $request->package_id;
            $orders->total_words = $request->total_words;
            $orders->quantity = $request->quantity;
            $orders->topic = $request->topic;
            $orders->type_style = $request->type_style;
            $orders->reference_url = $request->reference_url;
            $orders->type_of_press_release = $request->type_of_press_release;
            $orders->quotes = $request->quotes;
            $orders->types_of_posts = json_encode($request->types_of_posts);
            $orders->target_audience = $request->target_audience;
            $orders->direct_posting = $request->direct_posting;
            $orders->seo_keywords = $request->seo_keywords;
            $orders->order_details = $request->order_details;
            $orders->price = $request->price;
            $orders->paid_amount = $request->paid_amount;

            if($request->paid_amount != null){
                $orders->remaining_payment_amount = ($request->price - $request->paid_amount);
            }
            else{
                $orders->remaining_payment_amount = $request->price;
            }

            $orders->order_placed_by = Auth::id();


            if (Input::hasFile('attachment'))
            {
                $file = Input::file('attachment');
                $filename = $file->getClientOriginalName();
                $destinationPath = 'uploads/orders/attachment/';

                $orders->attachment = Input::file('attachment')->move($destinationPath, $filename);
            }

            $orders->save();
            flash()->success('Order placed successfully and will be assigned in 12-24 hours. View current order status under My Orders.');
        }



// For Normal Users
     if ($request->user()->cannot('admin.access')){
            // check auto deposit and balance
           $userId =  Auth::id();
          $balance = DB::select("SELECT SUM( CASE WHEN t.transaction_type = '1' THEN t.amount ELSE t.amount * -1  END   ) AS Total FROM user_deposits as t where userId = ". $userId."");
          if($request->price > $balance[0]->Total){
           
            $amountt = $request->price - $balance[0]->Total;
            $getactive =  DB::select("SELECT * from payment_method where userId = ". $userId." and auto_deposit = '1'");   
            $cardDetails = $getactive[0]; 

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
                    'USER' => 'admin_api1.writerarmy.com', 
                    'PWD' => 'WEQNM8Z2799T9VT4', 
                    'SIGNATURE' => 'AiPC9BjkCyDFQXbSkoZcgqH3hpacAAvVSWmCgbIEutzpx-8vkGJtWrf1',            
                    'VERSION' => '85.0' ,
                    'PAYMENTACTION' => 'Sale',                   
                    'IPADDRESS' => $_SERVER['REMOTE_ADDR'],                 
                    'ACCT' =>$creditCardNumber,                        
                    'EXPDATE' => $expMonth.$expYear,           
                    'CVV2' => $cvv, 
                    'FIRSTNAME' => $first_name, 
                    'LASTNAME' =>  $last_name, 
                     'AMT' => $amountt, 
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
                    
                 $transcationId = $response_info['TRANSACTIONID'];
                 $trnsactionDate = $response_info['TIMESTAMP'];
                 $user_deposit = New UserDeposit();
                 $user_deposit->userId = $userId;
                 $user_deposit->transaction_id = $transcationId;
                 $user_deposit->transaction_date = $trnsactionDate;
                 $user_deposit->amount = $amountt;
                 $user_deposit->transaction_type = 1;
                 $user_deposit->save();
                  // send email
                 $user = User::find($userId); 
                 $useremail = $user->email;
                 $username = $user->name;

                 $subjectmessage = 'Payment Deposit successfully';              
                // $emailmessage = '<p>$100 deposit successfully in your account. Now you can purchase order from your balance.</p>'; 
                  $emailmessage = array('amount'=>$amountt, 'transcationId' => $transcationId, 'username' => $username, 'transactiondate' =>$trnsactionDate );
                 $data = array('user'=>$useremail, 'name' =>$username, 'subject'=>$subjectmessage);           
                 Mail::send('auth.emails.deposit_email', ['emailmessage'=> $emailmessage], function($message) use ($data)
                    {
                        $message->to($data['user'], $data['name'])->subject($data['subject']); 
                  });
              
              // end email
                  
              }  

             }

          
                $orders = New Order();
                $orders->package_id = $request->package_id;
                $orders->total_words = $request->total_words;
                $orders->quantity = $request->quantity;
                $orders->topic = $request->topic;
                $orders->type_style = $request->type_style;
                $orders->reference_url = $request->reference_url;
                $orders->type_of_press_release = $request->type_of_press_release;
                $orders->quotes = $request->quotes;
                $orders->types_of_posts = json_encode($request->types_of_posts);
                $orders->target_audience = $request->target_audience;
                $orders->direct_posting = $request->direct_posting;
                $orders->seo_keywords = $request->seo_keywords;
                $orders->order_details = $request->order_details;
                $orders->price = $request->price;
                $orders->paid_amount = $request->paid_amount;

                if($request->paid_amount != null){
                    $orders->remaining_payment_amount = ($request->price - $request->paid_amount);
                }
                else{
                    $orders->remaining_payment_amount = $request->price;
                }


                $orders->order_placed_by = Auth::id();


                if (Input::hasFile('attachment'))
                {
                    $file = Input::file('attachment');
                    $filename = $file->getClientOriginalName();
                    $destinationPath = 'uploads/orders/attachment/';

                    $orders->attachment = Input::file('attachment')->move($destinationPath, $filename);
                }

                $orders->save();
                 $userId = Auth::id();
				$LastInsertId = $orders->id;
                  $transcationId = $LastInsertId;
                 $trnsactionDate = date('Y-m-d H:i:s');
                 $user_deposit = New UserDeposit();
                 $user_deposit->userId = $userId;
                 $user_deposit->transaction_id = $transcationId;
                 $user_deposit->transaction_date = $trnsactionDate;
                 $user_deposit->amount = $request->price;
                 $user_deposit->transaction_type = 0;
                 $user_deposit->save();
 
				flash()->success('"Order placed successfully and will be assigned in 12-24 hours. View current order status under My Orders.');
				return redirect()->to('content/confirmation/'.$LastInsertId);
        
            flash()->error('Invalid Card Details');
      

    }
     return Redirect::back();

  }


   /* public function storeOrders(Request $request)
    {

    // For SuperUser/Admin
        if ($request->user()->can('admin.access')) {

            $orders = New Order();
            $orders->package_id = $request->package_id;
            $orders->total_words = $request->total_words;
            $orders->quantity = $request->quantity;
            $orders->topic = $request->topic;
            $orders->type_style = $request->type_style;
            $orders->reference_url = $request->reference_url;
            $orders->type_of_press_release = $request->type_of_press_release;
            $orders->quotes = $request->quotes;
            $orders->types_of_posts = json_encode($request->types_of_posts);
            $orders->target_audience = $request->target_audience;
            $orders->direct_posting = $request->direct_posting;
            $orders->seo_keywords = $request->seo_keywords;
            $orders->order_details = $request->order_details;
            $orders->price = $request->price;
            $orders->paid_amount = $request->paid_amount;

            if($request->paid_amount != null){
                $orders->remaining_payment_amount = ($request->price - $request->paid_amount);
            }
            else{
                $orders->remaining_payment_amount = $request->price;
            }

            $orders->order_placed_by = Auth::id();


            if (Input::hasFile('attachment'))
            {
                $file = Input::file('attachment');
                $filename = $file->getClientOriginalName();
                $destinationPath = 'uploads/orders/attachment/';

                $orders->attachment = Input::file('attachment')->move($destinationPath, $filename);
            }

            $orders->save();
        }


    // For Normal Users
        if ($request->user()->cannot('admin.access')){

            // For Payment System/ Stripe
            // Setting API key
            $payment_amount_in_cent = Input::get('paid_amount');
            $payment_amount = ($payment_amount_in_cent * 100);
            $user = Auth::user();
            $user_name = $user->name;
            $user_email = $user->email;

            Stripe::setApiKey('sk_live_FhQk6TTqbD7aInT3IDWrv683');

            try {
                \Stripe\Charge::create([
                    'amount' => $payment_amount, // this is in cents
                    'currency' => 'usd',
                    'card' => $_POST['stripeToken'],
                    'description' => 'Name: '.$user_name.' [Email: '.$user_email.']',
                    'receipt_email' => $user_email,
                ]);


                \Stripe\Customer::create([
                    "email" => $user_email,
                ]);



                $orders = New Order();

                $orders->package_id = $request->package_id;
                $orders->total_words = $request->total_words;
                $orders->quantity = $request->quantity;
                $orders->topic = $request->topic;
                $orders->type_style = $request->type_style;
                $orders->reference_url = $request->reference_url;
                $orders->type_of_press_release = $request->type_of_press_release;
                $orders->quotes = $request->quotes;
                $orders->types_of_posts = json_encode($request->types_of_posts);
                $orders->target_audience = $request->target_audience;
                $orders->direct_posting = $request->direct_posting;
                $orders->seo_keywords = $request->seo_keywords;
                $orders->order_details = $request->order_details;
                $orders->price = $request->price;
                $orders->paid_amount = $request->paid_amount;


                if($request->paid_amount != null){
                    $orders->remaining_payment_amount = ($request->price - $request->paid_amount);
                }
                else{
                    $orders->remaining_payment_amount = $request->price;
                }


                $orders->order_placed_by = Auth::id();


                if (Input::hasFile('attachment'))
                {
                    $file = Input::file('attachment');
                    $filename = $file->getClientOriginalName();
                    $destinationPath = 'uploads/orders/attachment/';

                    $orders->attachment = Input::file('attachment')->move($destinationPath, $filename);
                }

                $orders->save();


            } catch (Stripe_CardError $e) {
                // Declined. Don't process their purchase.
                // Go back, and tell the user to try a new card
            }
        }


        flash()->success('Order Placed Successfully');

        return Redirect::back();
    }
 */

    public function allOrders() {

        $data['job_details'] = OrderStatus::where('status_type', '!=', 'unassigned')->get();
        $data['orders'] = Order::where('confirmation_status', 0)->get();

        return view('dashboard.order_content.all_orders_view', $data);
    }


    public function payToWriter($id){
        $data['job_details'] = OrderStatus::find($id);
        $order_id =  $data['job_details']->order_id;
        $writer_id = $data['job_details']->writer_id;
        $data['order_details'] = Order::find($order_id);
        $data['user'] = User::find($writer_id);   
        $data['writerDetails'] = DB::table('writer_details')->where('writer_id', $writer_id)->get();   
        return view('dashboard.order_content.orders.paytowriter', $data); 
    }

    public function notifyWriter(Request $request){ 

        if($_REQUEST['payment_status'] == 'Completed'){      
            $jobid= $_REQUEST['custom'];
            $job_details = OrderStatus::find($jobid);
            $order_id =  $job_details->order_id;
            $writer_id =  $job_details->writer_id;
            $order_details = Order::find($order_id);
            $user = User::find($writer_id); 
            $writer_email =$user->email;            
            $writername = $user->name;           

        $subjectmessage = 'Payment notitfications'; 
        // email to the writer         
        $emailmessage = '<p>You order accepted by the client. Successfully transfered USD'. $_REQUEST['payment_gross'].' for the order '.$order_details['topic'].'</p>'; 
        $data = array('user'=>$writer_email, 'name' =>$writername, 'subject'=>$subjectmessage);           
        Mail::send('auth.emails.payment_notifications', ['emailmessage'=> $emailmessage], function($message) use ($data)
        {
            $message->to($data['user'], $data['name'])->subject($data['subject']); 
        });

        // email to the Admin
        $emailmessage = '<p>Successfully transfered USD'. $_REQUEST['payment_gross'].' to the Writer '.$writername.' for the order '.$order_details['topic'].'</p>'; 
        $data = array('user'=>'admin@writerarmy.com', 'name' =>'admin', 'subject'=>$subjectmessage);           
        Mail::send('auth.emails.payment_notifications', ['emailmessage'=> $emailmessage], function($message) use ($data)
        {
            $message->to($data['user'], $data['name'])->subject($data['subject']); 
        });
                          
         $order_details = Order::find($order_id);
         $paidmoney= $_REQUEST['payment_gross'];
         $remaining_payment_amount = $order_details['price'] -  $paidmoney;
         $paid_to_writer= $order_details['paid_to_writer'] + $paidmoney;
         $updateorders = Order::find($order_id);
         $updateorders->remaining_payment_amount = $remaining_payment_amount;
         $updateorders->paid_to_writer = $paid_to_writer;
         $updateorders->save(); 

        }
    }

     public function paymentstatus(Request $request){
        if($_REQUEST['payment_status'] == 'Completed'){  
              $jobid= $_REQUEST['custom'];
           flash()->success('Payment Done Successfully');
           return redirect('payToWriter/'.$jobid.''); 
        }
     }   

    public function destroyOrders($id) {

        $orders = Order::findOrFail($id);
        $orders->delete();

        return;
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
	

}
