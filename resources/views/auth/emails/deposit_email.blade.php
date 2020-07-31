<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Email</title>
<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>
<div style="width: 980px;margin: 0 auto;text-align: left; padding: 30px 0;">
	<div style="background-color:#3c8dbc; padding:20px;">
{!! HTML::image('global/img/logo.png', 'EasyChecklistABC') !!}
</div>
<p style="font-family: sans-serif;font-size:15px;color:#333;">You have successfully deposited <?php echo $emailmessage['amount'];?> into your project escrow account at writerarmy.com.</p>
<div style="border-style: dottedborder-style: dotted;border: 1px dashed #333;width: 100%;margin: 30px 0;max-width: 180px;"></div>
<ul style="list-style: none;margin: 0;padding: 0;line-height: 25px;font-family: 'Poppins', sans-serif;color:#333;">
 <li><b>Name:</b>  <?php echo $emailmessage['username'];?> </li> 
 <li><b>Total:</b>  <?php echo $emailmessage['amount'];?> </li>
</ul>

<ul style="list-style: none;margin: 0;padding: 0;line-height: 25px;font-family: 'Poppins', sans-serif;margin-top: 30px;color:#333;">
 <li><b>Transaction:</b> <?php echo $emailmessage['transcationId'];?> </li>
 <li><b>Date:</b> <?php echo $emailmessage['transactiondate'];?> </li>
</ul>
<div style="border-style: dottedborder-style: dotted;border: 1px dashed #333;width: 100%;margin: 30px 0;max-width: 180px;"></div>
</div>
</body>
</html>
