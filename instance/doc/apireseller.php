<?php 

class LHCAutomatedHostingResellerAPI {
	
	private $host = null;
	private $secretHash = null;
	private $resellerId = null;
	
	/**
	 * @param $host = host where manager is accesses E.g http://manager.livehelperchat.com
	 * */
	public function __construct($host, $resellerId, $hash) 
	{
		$this->host = $host;
		$this->secretHash = $hash;
		$this->resellerId = $resellerId;
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
				
		$response = $this->executeRequest('/instance/rslregisterinstance/'. $this->resellerId . '/' . $params['address'] . '/' . $params['email'] . '/' . (string)$params['request'] . '/' . $params['period'] . '/' . $validateHash . $appendRequest);
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
		$response = $this->executeRequest('/instance/rslterminateinstance/'. $this->resellerId . '/' . $address . '/' . $validateHash);
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
		$response = $this->executeRequest('/instance/rslsuspendinstance/'. $this->resellerId . '/' . $address . '/' . $status . '/' . $validateHash);
		$jsonData = json_decode($response);		
		if ($jsonData !== null) {
			return $jsonData;
		} else {
			throw new Exception('Could not parse response - '.$response);
		}
	}
}
?>