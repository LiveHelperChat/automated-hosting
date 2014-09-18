<?php

$cfg = erConfigClassLhConfig::getInstance();
try {
	$reseller = erLhcoreClassModelInstance::fetch($Params['user_parameters']['id']);
} catch (Exception $e) {
	echo json_encode(array('error' => 'true','reason' => 'Could not find a reseller'));
	exit;
}

if ($reseller->is_reseller == 0) {
	echo json_encode(array('error' => 'true', 'reason' => 'This instance is not a reseller'));
	exit;
}

$secretHash = (string)$reseller->reseller_secret_hash;
if ($secretHash == '') {
	echo json_encode(array('error' => 'true', 'reason' => 'This instance does not have a secret hash'));
	exit;
}

$validateHash = sha1((string)$Params['user_parameters']['address'].(string)$Params['user_parameters']['email'].(string)$Params['user_parameters']['request'].(string)$Params['user_parameters']['period'].$secretHash);
if ( (string)$Params['user_parameters']['hash'] == $validateHash ) {

	if ( erLhcoreClassInstance::instanceExists((string)$Params['user_parameters']['address']) == false)	{
		$instance = new erLhcoreClassModelInstance();
		
		if ($reseller->reseller_max_instances == $reseller->reseller_instances_count) {
			echo json_encode(array('error' => 'true', 'reason' => 'Reseller cannot have more than '.$reseller->reseller_max_instances.' instances'));
			exit;
		}
		
	} else {
		$list = erLhcoreClassModelInstance::getList(array('filter' => array('address' => (string)$Params['user_parameters']['address'])));
		$instance = array_shift($list);
		
		if ($instance->reseller_id != $reseller->id) {
			echo json_encode(array('error' => 'false','msg' => 'You do not have permission to edit this instance'));
			exit;
		};
	}
			
	if ($Params['user_parameters_unordered']['dateformat'] != '') {
		$instance->date_format = base64_decode(rawurldecode($Params['user_parameters_unordered']['dateformat']));		
	}
			
	if ($Params['user_parameters_unordered']['hourformat'] != '') {
		$instance->date_hour_format = base64_decode(rawurldecode($Params['user_parameters_unordered']['hourformat']));		
	}
			
	if ($Params['user_parameters_unordered']['timezone'] != '') {
		$instance->time_zone = base64_decode(rawurldecode($Params['user_parameters_unordered']['timezone']));		
	}
			
	if ($Params['user_parameters_unordered']['operatorlocale'] != '') {
		$instance->locale = base64_decode(rawurldecode($Params['user_parameters_unordered']['operatorlocale']));		
	}
			
	if ($Params['user_parameters_unordered']['frontsiteaccess'] != '') {
		$instance->siteaccess = base64_decode(rawurldecode($Params['user_parameters_unordered']['frontsiteaccess']));		
	}
			
	if ($Params['user_parameters_unordered']['datehourformat'] != '') {
		$instance->date_date_hour_format = base64_decode(rawurldecode($Params['user_parameters_unordered']['datehourformat']));		
	}
		
	$instance->email = (string)$Params['user_parameters']['email'];
	$instance->address = (string)$Params['user_parameters']['address'];
	$instance->reseller_id = $reseller->id;
	
	if ($instance->request < 0) {
		$instance->request = 0;
	}
	
	$instance->request += (int)$Params['user_parameters']['request'];
	
	if ($instance->request > $reseller->reseller_max_instance_request) {
		echo json_encode(array('error' => 'true', 'reason' => 'Instances cannot have more than '.$reseller->reseller_max_instance_request.' requests'));
		exit;
	}	
	
	if ($reseller->reseller_request - (int)$Params['user_parameters']['request'] < 0) {
		echo json_encode(array('error' => 'true', 'reason' => 'Reseller has sold all the request'));
		exit;
	}
	
	if ((int)$Params['user_parameters']['request'] > 0) {
		$reseller->reseller_request -=  (int)$Params['user_parameters']['request'];
		$reseller->saveThis();
	}
	
	if ($instance->expires == 0 || $instance->expires < time()) {
		$instance->expires = time()+(int)$Params['user_parameters']['period']*24*3600;
	} else{
		$instance->expires += (int)$Params['user_parameters']['period']*24*3600;
	}

	$instance->saveThis();
	echo json_encode(array('error' => 'false','msg' => 'instance created','data' => get_object_vars($instance)));

} else {
	echo json_encode(array('error' => 'true','reason' => 'invalid hash'));
}

exit;
?>