<?php

/* 
	erLhcoreClassLog::write(print_r($_POST,true));
	erLhcoreClassLog::write(print_r($_GET,true));
	erLhcoreClassLog::write(print_r($_SERVER,true)); 
*/

// STEP 1: read POST data
 
// Reading POSTed data directly from $_POST causes serialization issues with array data in the POST.
// Instead, read raw POST data from the input stream. 
$raw_post_data = file_get_contents('php://input');

$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
  $keyval = explode ('=', $keyval);
  if (count($keyval) == 2)
     $myPost[$keyval[0]] = urldecode($keyval[1]);
}
// read the IPN message sent from PayPal and prepend 'cmd=_notify-validate'
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
   $get_magic_quotes_exists = true;
} 
foreach ($myPost as $key => $value) {        
   if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
        $value = urlencode(stripslashes($value)); 
   } else {
        $value = urlencode($value);
   }
   $req .= "&$key=$value";
}

// STEP 2: POST IPN data back to PayPal to validate 
$ch = curl_init('https://www.paypal.com/cgi-bin/webscr');
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
 
if( !($res = curl_exec($ch)) ) {
	// error_log("Got " . curl_error($ch) . " when processing IPN data");
	curl_close($ch);
	exit;
}
curl_close($ch);
 
 
// STEP 3: Inspect IPN validation result and act accordingly
 
if (strcmp ($res, "VERIFIED") == 0) {
    // The IPN is verified, process it:
    // check whether the payment_status is Completed
    // check that txn_id has not been previously processed
    // check that receiver_email is your Primary PayPal email
    // check that payment_amount/payment_currency are correct
    // process the notification
 
    // assign posted variables to local variables
    $item_name = $_POST['item_name'];
    $item_number = $_POST['item_number'];
    $payment_status = $_POST['payment_status'];
    $payment_amount = $_POST['mc_gross'];
    $payment_currency = $_POST['mc_currency'];
    $txn_id = $_POST['txn_id'];
    $receiver_email = $_POST['receiver_email'];
    $payer_email = $_POST['payer_email'];
     
    try {

    	if ($payment_status != 'Completed') {
    		throw new Exception('Payment not completed');
    	}

    	if ($receiver_email != erConfigClassLhConfig::getInstance()->getSetting( 'site', 'seller_paypal_mail' ) ) {
    		throw new Exception('Incorrect seller email');
    	}
    	
	    if (erLhcoreClassModelInstanceInvoice::getCount(array('filter' => array('txn_id' => $txn_id))) == 0) {
	    	
	    	$db = ezcDbInstance::get();	    
	    		
	    	try {			
				$db->beginTransaction();
		    	
		    	$invoice = new erLhcoreClassModelInstanceInvoice();
		    	$invoice->order_item = $_POST['option_selection1'];
		    	$invoice->txn_id = $txn_id;
		    	$invoice->instance_id = (int)$_POST['custom'];
		    	$invoice->amount = round($payment_amount*100);
		    	$invoice->currency = $payment_currency;
		    	$dataLog = $_POST;
		    	$dataLog['raw_response'] = $res;
		    	$invoice->log = json_encode($dataLog,JSON_PRETTY_PRINT);
		    	$invoice->saveThis();
		    	
		    	$optionPurchased = $_POST['option_selection1'];	    	
		    	$paypalSellerOptions = erConfigClassLhConfig::getInstance()->getSetting('site','seller_paypal_options');
		    	
		    	$requestNumber = $paypalSellerOptions[$optionPurchased]['r'];
		    	$periodDays = $paypalSellerOptions[$optionPurchased]['p'];
		    		    		    	
		    	$instance = erLhcoreClassModelInstance::fetch($invoice->instance_id);
	
		    	if ($instance->is_reseller) {
		    		$instance->reseller_request += $requestNumber;
		    	} else {
		    		$instance->request += $requestNumber;
		    	}
	
		    	if ($instance->expires == 0 || $instance->expires < time()) {
		    		$instance->expires = time()+(int)$periodDays*24*3600;
		    	} else {
		    		$instance->expires += (int)$periodDays*24*3600;
		    	}
	
		    	$instance->saveThis();
		    		    	    		
	    		$db->commit();
	    	} catch (Exception $e) {
	    		$db->rollback();
	    		throw $e;
	    	}
	    		    	
	    } else {
	    	throw new Exception('This transaction was already processed');
	    }	    
    } catch (Exception $e) {
    	erLhcoreClassLog::write(print_r($raw_post_data,true)."\n".$e->getMessage());    	
    }       
    
} else if (strcmp ($res, "INVALID") == 0) {
	erLhcoreClassLog::write("Invalid");
	erLhcoreClassLog::write(print_r($raw_post_data,true)."\n".$res);
}
exit;
?>