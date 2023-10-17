<?php 
$cfg = erConfigClassLhConfig::getInstance();
$secretHash = $cfg->getSetting('site','seller_secret_hash');
$validateHash = sha1((string)$Params['user_parameters']['id'].'workflow'.(string)$Params['user_parameters']['date'].$secretHash);

if ( (string)$Params['user_parameters']['hash'] == $validateHash && $Params['user_parameters']['id'] == erLhcoreClassInstance::$instanceChat->id && date('Ym') == (string)$Params['user_parameters']['date']) {
    
    // Let the core to do the main job
	include 'modules/lhcron/workflow.php';
    include 'modules/lhcron/transfer_workflow.php';
    
	erLhcoreClassChatEventDispatcher::getInstance()->dispatch('chat.instance.workflow',array('instance' => erLhcoreClassInstance::$instanceChat));
	
} else {
	echo 'Invalid hash';
}

exit;