<?php



$cfg = erConfigClassLhConfig::getInstance();
$secretHash = $cfg->getSetting('site','seller_secret_hash');
$validateHash = sha1((string)$Params['user_parameters']['address'].(string)$Params['user_parameters']['email'].(string)$Params['user_parameters']['request'].(string)$Params['user_parameters']['period'].$secretHash);

// http://manager.livehelperchat.com/index.php/instance/registerinstance/remdex/remdex@gmail.com/6000/160/138d07f5c478cbd4d1fcbfcc6ccd49d5961273bd

if ( (string)$Params['user_parameters']['hash'] == $validateHash ) {

	if ( erLhcoreClassInstance::instanceExists((string)$Params['user_parameters']['address']) == false)
	{
		$instance = new erLhcoreClassModelInstance();
	} else {
		$list = erLhcoreClassModelInstance::getList(array('filter' => array('address' => (string)$Params['user_parameters']['address'])));
		$instance = array_shift($list);
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

	$instance->saveThis();
	echo json_encode(array('error' => 'false','msg' => 'instance created','data' => get_object_vars($instance)));

} else {
	echo json_encode(array('error' => 'true','reason' => 'invalid hash'));
}

exit;
?>