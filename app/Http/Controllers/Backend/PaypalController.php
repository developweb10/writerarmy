<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Validator;
use URL;
use Session;


// Used to process plans




class PaypalController extends Controller
{
   // private $api_endpoint;

   public function __construct()
    {
/** PayPal api context **/
     
        $sandbox = TRUE;
         
        // Set PayPal API version and credentials.
        $api_version = '85.0';
        $api_endpoint = $sandbox ? 'https://api-3t.sandbox.paypal.com/nvp' : 'https://api-3t.paypal.com/nvp';
        $api_username = $sandbox ? 'satish.inext-facilitator_api1.gmail.com' : 'satish.inext-facilitator_api1.gmail.com';
        $api_password = $sandbox ? 'HS3N4F3KTYPAAN2W' : 'HS3N4F3KTYPAAN2W';
        $api_signature = $sandbox ? 'AFcWxV21C7fd0v3bYYYRCpSSRl31AKwYEDJdCUsNHqwpeYFyQ-2JHHuJ' : 'AFcWxV21C7fd0v3bYYYRCpSSRl31AKwYEDJdCUsNHqwpeYFyQ-2JHHuJ';
   }

   

    public function index()
    {       
        //echo $this->_api_endpoint;
        return view('paywithpaypal'); 
    }
     public function payWithpaypal(Request $request)
    {
        print_r($_POST);

    $name = $_POST['name_on_card'];
    $nameArr = explode(' ', $name);
    $firstName = $nameArr[0];
    if(!empty($nameArr[1])){
    $lastName = $nameArr[1];
   }else{$lastName = '';}
   

     $creditCardNumber = trim(str_replace(" ","",$_POST['card_number']));
    $creditCardType = $_POST['card_type'];
    $expMonth = $_POST['expiry_month'];
    $expYear = $_POST['expiry_year'];
    $cvv = $_POST['cvv'];

       $request_params = array
                    (
                    'METHOD' => 'DoDirectPayment', 
                    'USER' => 'satish.inext-facilitator_api1.gmail.com', 
                    'PWD' => 'HS3N4F3KTYPAAN2W', 
                    'SIGNATURE' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31AKwYEDJdCUsNHqwpeYFyQ-2JHHuJ', 
                    'VERSION' => '85.0' , 
                    'PAYMENTACTION' => 'Sale',                   
                    'IPADDRESS' => $_SERVER['REMOTE_ADDR'],                 
                    'ACCT' =>$creditCardNumber,                        
                    'EXPDATE' => $expMonth.$expYear,           
                    'CVV2' => $cvv, 
                    'FIRSTNAME' => $firstName, 
                    'LASTNAME' =>  $lastName, 
                    'AMT' => '1.00', 
                    'CURRENCYCODE' => 'USD', 
                    'DESC' => 'Testing Payments Pro'
                    );
            $nvp_string = '';
            foreach($request_params as $var=>$val)
            {
                $nvp_string .= '&'.$var.'='.urlencode($val);    
            }

            echo $nvp_string;

            // send curl request
            $curl = curl_init();
        curl_setopt($curl, CURLOPT_VERBOSE, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_URL, 'https://api-3t.sandbox.paypal.com/nvp');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $nvp_string);
         
        $result = curl_exec($curl);     
        curl_close($curl);

        echo '<br/>';
        print_r($result);
      print_r(json_decode($result)); 


    }
    public function getPaymentStatus()
    {

       
    }
}