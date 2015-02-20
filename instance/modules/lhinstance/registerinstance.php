<?php

$cfg = erConfigClassLhConfig::getInstance();
$secretHash = $cfg->getSetting('site','seller_secret_hash');
$validateHash = sha1((string)$Params['user_parameters']['address'].(string)$Params['user_parameters']['email'].(string)$Params['user_parameters']['request'].(string)$Params['user_parameters']['period'].$secretHash);

if ( (string)$Params['user_parameters']['hash'] == $validateHash ) {

	if ( erLhcoreClassInstance::instanceExists((string)$Params['user_parameters']['address']) == false)	{
		$instance = new erLhcoreClassModelInstance();
	} else {
		$list = erLhcoreClassModelInstance::getList(array('filter' => array('address' => (string)$Params['user_parameters']['address'])));
		$instance = array_shift($list);
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
	
	if ($Params['user_parameters_unordered']['files_supported'] != null) {
		$instance->files_supported = (int)($Params['user_parameters_unordered']['files_supported']);		
	}
	
	if ($Params['user_parameters_unordered']['atranslations_supported'] != null) {
		$instance->atranslations_supported = (int)($Params['user_parameters_unordered']['atranslations_supported']);		
	}
	
	if ($Params['user_parameters_unordered']['cobrowse_supported'] != null) {
		$instance->cobrowse_supported = (int)($Params['user_parameters_unordered']['cobrowse_supported']);		
	}
	
	if ($Params['user_parameters_unordered']['feature_1_supported'] != null) {
		$instance->feature_1_supported = (int)($Params['user_parameters_unordered']['feature_1_supported']);		
	}
	
	if ($Params['user_parameters_unordered']['feature_2_supported'] != null) {
		$instance->feature_2_supported = (int)($Params['user_parameters_unordered']['feature_2_supported']);		
	}
	
	if ($Params['user_parameters_unordered']['feature_3_supported'] != null) {
		$instance->feature_3_supported = (int)($Params['user_parameters_unordered']['feature_3_supported']);		
	}
		
	$instance->email = (string)$Params['user_parameters']['email'];
	$instance->address = (string)$Params['user_parameters']['address'];
	
	if ($instance->request < 0) {
		$instance->request = 0;
	}
	
	$instance->request += (int)$Params['user_parameters']['request'];

	if ($instance->expires == 0 || $instance->expires < time()) {
		$instance->expires = time()+(int)$Params['user_parameters']['period']*24*3600;
	} else{
		$instance->expires += (int)$Params['user_parameters']['period']*24*3600;
	}
	
	if ($Params['user_parameters_unordered']['is_reseller'] == 1) {
		$instance->is_reseller = 1;
		
		if ($Params['user_parameters_unordered']['reseller_tite'] != '') {
			$instance->reseller_tite = base64_decode(rawurldecode($Params['user_parameters_unordered']['reseller_tite']));
		}
		
		if ($Params['user_parameters_unordered']['reseller_max_instance_request'] != '') {
			$instance->reseller_max_instance_request = (int)$Params['user_parameters_unordered']['reseller_max_instance_request'];
		}
		
		if ($Params['user_parameters_unordered']['reseller_secret_hash'] != '') {
			$instance->reseller_secret_hash = base64_decode(rawurldecode($Params['user_parameters_unordered']['reseller_secret_hash']));
		}
		
		// Generate reseller hash if it was not provided
		if ($instance->reseller_secret_hash == ''){
			$instance->reseller_secret_hash = erLhcoreClassModelForgotPassword::randomPassword(20);
		}
		
		if ($Params['user_parameters_unordered']['reseller_max_instances'] != '') {
			$instance->reseller_max_instances = (int)$Params['user_parameters_unordered']['reseller_max_instances'];
		}
		
		if ($Params['user_parameters_unordered']['reseller_request'] != '') {
			$instance->reseller_request = (int)$Params['user_parameters_unordered']['reseller_request'];
		}	
	}
		
	$instance->saveThis();
	echo json_encode(array('error' => 'false','msg' => 'instance created','data' => get_object_vars($instance)));

} else {
	echo json_encode(array('error' => 'true','reason' => 'invalid hash'));
}

exit;
?>