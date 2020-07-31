<?php 
/** set your paypal credential **/
/*return ['client_id' =>'AS-GCgasJjgM2LfF8eHNiJFWHyGWG4TmtbKDFalu-9w5F_40FOOiLlvLRrXBXBJZsoy8CHaNFgjb4igE',
'secret' => 'EHd1P2MexMM-4xguDlgLqEoJrD40Zb8J2OyTm0pg1TuI-mNBtFsRM3IDF65HjEwLbIs1Pa0kLAr40wwQ',
'settings' => [	
	'mode' => 'sandbox',	
	'http.ConnectionTimeOut' => 1000,	
	'log.LogEnabled' => true,	
	'log.FileName' => storage_path() . '/logs/paypal.log',
	'log.LogLevel' => 'FINE'
	]
];
*/  
$sandbox = TRUE;
return [ 
        $api_version = '85.0';
        $api_endpoint = $sandbox ? 'https://api-3t.sandbox.paypal.com/nvp' : 'https://api-3t.paypal.com/nvp';
        $api_username = $sandbox ? 'satish.inext-facilitator_api1.gmail.com' : 'satish.inext-facilitator_api1.gmail.com';
        $api_password = $sandbox ? 'HS3N4F3KTYPAAN2W' : 'HS3N4F3KTYPAAN2W';
        $api_signature =  $sandbox ? 'AFcWxV21C7fd0v3bYYYRCpSSRl31AKwYEDJdCUsNHqwpeYFyQ-2JHHuJ' : 'AFcWxV21C7fd0v3bYYYRCpSSRl31AKwYEDJdCUsNHqwpeYFyQ-2JHHuJ';
];

?>
