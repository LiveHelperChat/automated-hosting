<?php 
$cfg = erConfigClassLhConfig::getInstance();
$secretHash = $cfg->getSetting('site','seller_secret_hash');
$validateHash = sha1((string)$Params['user_parameters']['id'].'extensions'.(string)$Params['user_parameters']['date'].$secretHash);

if ( (string)$Params['user_parameters']['hash'] == $validateHash && $Params['user_parameters']['id'] == erLhcoreClassInstance::$instanceChat->id && date('Ym') == (string)$Params['user_parameters']['date']) {
    // Just execute event for listeners to check plugins states and update if required
    erLhcoreClassChatEventDispatcher::getInstance()->dispatch('instance.extensions_structure', array());
} else {
	echo 'Invalid hash';
}

exit;