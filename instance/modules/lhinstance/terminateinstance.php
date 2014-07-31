<?php



$cfg = erConfigClassLhConfig::getInstance();
$secretHash = $cfg->getSetting('site','seller_secret_hash');
$validateHash = sha1((string)$Params['user_parameters']['address'].$secretHash);

// http://manager.livehelperchat.com/index.php/instance/terminateinstance/remdex/138d07f5c478cbd4d1fcbfcc6ccd49d5961273bd

if ( (string)$Params['user_parameters']['hash'] == $validateHash ) {
	
	$list = erLhcoreClassModelInstance::getList(array('filter' => array('address' => (string)$Params['user_parameters']['address'])));
	if (!empty($list)){
		$instance = array_shift($list);
			
		$instance->terminate = 1;					
		$instance->saveThis();
		
		echo json_encode(array('error' => 'false','msg' => 'instance terminated'));	
	}
	
} else {
	echo json_encode(array('error' => 'true','reason' => 'invalid hash'));
}

exit;
?>