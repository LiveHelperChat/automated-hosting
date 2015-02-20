<?php 

$cfg = erConfigClassLhConfig::getInstance();
$secretHash = $cfg->getSetting('site','seller_secret_hash');
$validateHash = sha1((string)$Params['user_parameters']['id'].(string)$Params['user_parameters']['date'].$secretHash);

if ( (string)$Params['user_parameters']['hash'] == $validateHash && $Params['user_parameters']['id'] == erLhcoreClassInstance::$instanceChat->id && date('Ym') == (string)$Params['user_parameters']['date']) {
    
    if (erLhcoreClassInstance::$instanceChat->removeInstanceData() === true){
		echo json_encode(array('error' => false));
	} else {
		echo json_encode(array('error' => true,'msg' => 'Could not delete'));
	}
	
} else {
	echo json_encode(array('error' => true,'msg' => 'Invalid hash'));
}

exit;
?>