<?php 

include 'apiinstance.php';
include 'apireseller.php';

$lhc = new LHCAutomatedHostingAPI('<http://manage.livehelperchat.com>', '<secret_hash>');// E.g $lhc = new LHCAutomatedHostingAPI('http://manage.livehelperchat.com', 'somrerandom_text');

// Create/update instance example
try {
	if ($lhc->checkInstanceFree('test2')) {
		$response = $lhc->createOrUpdateInstance(array(
			'address' 		 => 'test2', 			// Required, address it's subdomain in all cases.
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
				'address' 		 => 'test2', 			// Required, address it's subdomain in all cases.
				'email' 		 => 'remdex@gmail.com', // Required, e-mail
				'request' 		 => '1000', 			// Required, how many request to add, initial request number, can be 0 if you are just updating instance other attribute like expire date
				'period' 		 => '1', 				// Required, period in days, how many days instance is valid, can be zero if you are updating request number just. Days is always appended			
		));
		print_r($response);
	}
} catch (Exception $e) {
	echo $e->getMessage();
}

try {
	// Make instance reseller
	$response = $lhc->createOrUpdateInstance(array(
			'address' 		 			=> 'test2',
			'email' 		 			=> 'remdex@gmail.com',
			'request' 	 					=> '0', 		// Required, how many request to add, initial request number, can be 0 if you are just updating instance other attribute like expire date
			'period' 		 				=> '0', 		// Required, period in days, how many days instance is valid, can be zero if you are updating request number just. Days is always appended
			'reseller_tite'  				=> 'Reseller title', // Optional, reseller title
			'reseller_secret_hash' 			=> '', 		// Optional, reseller secret hash which can be empty, so system will generate one for you
			'is_reseller' 	 				=> '1', 	// Required to set 1 if intance is reseller, 0 does nothing. So once set instance will be always reseller
			'reseller_max_instances' 		=> '5', 	// Optional, how many instances reseller can have
			'reseller_max_instance_request' => '5000', 	// Optional, how many unsued requests instance can have
			'reseller_request' 				=> '1000', 	// Optional, Reseller request which can be sold, this number is deducted each time reseller assigns some requests to instance
	));
	print_r($response);
	
} catch (Exception $e) {
	echo $e->getMessage();
}


$lhcReseller = new LHCAutomatedHostingResellerAPI('<http://manage.livehelperchat.com>',$response->data->id,$response->data->reseller_secret_hash);// E.g $lhc = new LHCAutomatedHostingResellerAPI('http://manage.livehelperchat.com', '1', 'somrerandom_text');

// Create/update instance example
try {
	if ($lhcReseller->checkInstanceFree('testreseller2')) {
		$response = $lhcReseller->createOrUpdateInstance(array(
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
		$response = $lhcReseller->createOrUpdateInstance(array(
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

// Terminate instance example
try {
	$response = $lhc->terminate('testreseller2');
	print_r($response);
} catch (Exception $e) {
	echo $e->getMessage();
}

// Suspends and unsuspends instance
try {	
	$response = $lhc->changeSuspendStatus('test2',1); // Suspends
	print_r($response);
	
	$response = $lhc->changeSuspendStatus('test2',0); // Unsuspends
	print_r($response);
	
} catch (Exception $e) {
	echo $e->getMessage();
}

// Terminate instance example
try {
	$response = $lhc->terminate('test2');
	print_r($response);
} catch (Exception $e) {
	echo $e->getMessage();
}

?>