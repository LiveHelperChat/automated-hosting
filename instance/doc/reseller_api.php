<?php 

include 'apireseller.php';


$lhc = new LHCAutomatedHostingResellerAPI('<manager_address>','<reseller_id>','<some_secret_reseller_word>');// E.g $lhc = new LHCAutomatedHostingResellerAPI('http://manage.livehelperchat.com', '1', 'somrerandom_text');

// Create/update instance example
try {
	if ($lhc->checkInstanceFree('testreseller2')) {
		$response = $lhc->createOrUpdateInstance(array(
			'address' 		 => 'testreseller2', 			// Required, address it's subdomain in all cases.
			'email' 		 => 'remdex@gmail.com', // Required, e-mail
			'request' 		 => '1000', 			// Required, how many request to add, initial request number, can be 0 if you are just updating instance other attribute like expire date
			'period' 		 => '365', 				// Required, period in days, how many days instance is valid, can be zero if you are updating request number just. Days is always appended
			'dateformat' 	 => 'Y-m-dd', 			// Optional, date format
			'hourformat' 	 => 'H:i:ss', 			// Optional, hour format
			'datehourformat' => 'Y-m-d H:i:s', 	// Optional, user time zone
			'timezone' 		 => 'Europe/Vilnius', 	// Optional, user time zone
			'frontsiteaccess'=> 'lit', 				// Optional, default visitors site access
			'operatorlocale' => 'lt_LT', 			// Optional, operator locate, language of back office in other words.
		));
		print_r($response);
	} else {
		// This time we just add user additional one day and additional 1000 request
		$response = $lhc->createOrUpdateInstance(array(
				'address' 		 => 'testreseller2', 			// Required, address it's subdomain in all cases.
				'email' 		 => 'remdex@gmail.com', // Required, e-mail
				'request' 		 => '1000', 			// Required, how many request to add, initial request number, can be 0 if you are just updating instance other attribute like expire date
				'period' 		 => '1', 				// Required, period in days, how many days instance is valid, can be zero if you are updating request number just. Days is always appended			
		));
		print_r($response);
	}
} catch (Exception $e) {
	echo $e->getMessage();
}

// Suspends and unsuspends instance
try {	
	$response = $lhc->changeSuspendStatus('testreseller2',1); // Suspends
	print_r($response);
	
	$response = $lhc->changeSuspendStatus('testreseller2',0); // Unsuspends
	print_r($response);
	
} catch (Exception $e) {
	echo $e->getMessage();
}

// Terminate instance example
try {
	$response = $lhc->terminate('testreseller2');
	print_r($response);
} catch (Exception $e) {
	echo $e->getMessage();
}

?>