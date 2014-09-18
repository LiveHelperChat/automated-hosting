<?php

try {
	$reseller = erLhcoreClassModelInstance::fetch($Params['user_parameters']['id']);
} catch (Exception $e) {
	echo json_encode(array('error' => 'true','reason' => 'Could not find a reseller'));
	exit;
}

if ($reseller->is_reseller == 0) {
	echo json_encode(array('error' => 'true','reason' => 'This instance is not a reseller'));
	exit;
}

$secretHash = (string)$reseller->reseller_secret_hash;
if ($secretHash == '') {
	echo json_encode(array('error' => 'true','reason' => 'This instance does not have a secret hash'));
	exit;
}

$validateHash = sha1((string)$Params['user_parameters']['address'].(int)$Params['user_parameters']['status'].$secretHash);

if ( (string)$Params['user_parameters']['hash'] == $validateHash ) {
	
	$list = erLhcoreClassModelInstance::getList(array('filter' => array('address' => (string)$Params['user_parameters']['address'])));
	if (!empty($list)){
		$instance = array_shift($list);
		
		if ($instance->reseller_id != $reseller->id) {
			echo json_encode(array('error' => 'false','msg' => 'You do not have permission to edit this instance'));
			exit;
		};
		
		$instance->suspended = (int)$Params['user_parameters']['status'] == 1 ? 1 : 0;					
		$instance->saveThis();
		
		echo json_encode(array('error' => 'false','msg' => 'Instance status updated'));	
	} else {
		echo json_encode(array('error' => 'false','msg' => 'Could not find an instance'));
	}
	
} else {
	echo json_encode(array('error' => 'true','reason' => 'Invalid hash'));
}

exit;
?>