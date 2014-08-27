<?php 

class LHCAutomatedHostingAPI {
	
	private $host = null;
	private $secretHash = null;
	
	/**
	 * @param $host = host where manager is accesses E.g http://manager.livehelperchat.com
	 * */
	public function __construct($host, $hash) 
	{
		$this->host = $host;
		$this->secretHash = $hash;
	}
	
	private function executeRequest($url) 
	{
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->host . $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 5);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Some hostings produces wargning...
		$content = curl_exec($ch);
	
		return $content;
	}
	
	/*
	 * @param $address = address to check, eg. test1
	 * 
	 * */
	public function checkInstanceFree($address) 
	{
		$response = $this->executeRequest('/instance/isfree/'. $address);
		if ($response == 'true'){
			return true;
		} elseif ($response == 'false'){
			return false;
		} else {
			throw new Exception('Could not determine instance status, received response - '.$response);
		}
	}	
	
	/*
	 * Creates or suspends instance
	 * */
	public function createOrUpdateInstance(array $params)
	{
		$validateHash = sha1((string)$params['address'].(string)$params['email'].(string)$params['request'].(string)$params['period'].$this->secretHash);
		
		$appendRequest = '';
		if (isset($params['dateformat'])){
			$appendRequest .= '/(dateformat)/'.rawurlencode(base64_encode($params['dateformat']));
		}
		
		if (isset($params['hourformat'])){
			$appendRequest .= '/(hourformat)/'.rawurlencode(base64_encode($params['hourformat']));
		}
		
		if (isset($params['datehourformat'])){
			$appendRequest .= '/(datehourformat)/'.rawurlencode(base64_encode($params['datehourformat']));
		}
		
		if (isset($params['timezone'])){
			$appendRequest .= '/(timezone)/'.rawurlencode(base64_encode($params['timezone']));
		}
		
		if (isset($params['frontsiteaccess'])){
			$appendRequest .= '/(frontsiteaccess)/'.rawurlencode(base64_encode($params['frontsiteaccess']));
		}
		
		if (isset($params['operatorlocale'])){
			$appendRequest .= '/(operatorlocale)/'.rawurlencode(base64_encode($params['operatorlocale']));
		}
				
		$response = $this->executeRequest('/instance/registerinstance/'. $params['address'] . '/' . $params['email'] . '/' . (string)$params['request'] . '/' . $params['period'] . '/' . $validateHash . $appendRequest);
		$jsonData = json_decode($response);
		
		if ($jsonData !== null) {			
			return $jsonData;			
		} else {
			throw new Exception('Could not parse response - '.$response);
		}
	}
	
	/**
	 * Terminates instance
	 * */
	public function terminate($address) {		
		$validateHash = sha1((string)$address.$this->secretHash);
		$response = $this->executeRequest('/instance/terminateinstance/'. $address . '/' . $validateHash);
		$jsonData = json_decode($response);		
		if ($jsonData !== null) {
			return $jsonData;
		} else {
			throw new Exception('Could not parse response - '.$response);
		}
	}
	
	/*
	 * Suspends or unsuspends instance
	 * */
	public function changeSuspendStatus($address, $status) {				
		$validateHash = sha1((string)$address.$status.$this->secretHash);
		$response = $this->executeRequest('/instance/suspendinstance/'. $address . '/' . $status . '/' . $validateHash);
		$jsonData = json_decode($response);		
		if ($jsonData !== null) {
			return $jsonData;
		} else {
			throw new Exception('Could not parse response - '.$response);
		}
	}
	
}


$lhc = new LHCAutomatedHostingAPI('<manager_address>', '<seller_secret_hash>');// E.g $lhc = new LHCAutomatedHostingAPI('http://manage.livehelperchat.com', 'somrerandom_text');

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