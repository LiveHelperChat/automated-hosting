<?php

$cfg = erConfigClassLhConfig::getInstance();

$secretHash = $cfg->getSetting('site','seller_secret_hash');

// Just cleanup if argument is domain with dots. We just remove dots.
$Params['user_parameters']['address'] = str_replace('.', '', (string)$Params['user_parameters']['address']);

$validateHash = sha1((string)$Params['user_parameters']['address']. (string)$Params['user_parameters']['id'] . $secretHash);

if ( (string)$Params['user_parameters']['hash'] == $validateHash ) {

    if ( erLhcoreClassInstance::instanceExists((string)$Params['user_parameters']['address']) == false)	{
        throw new Exception('Instance does not exists!');
    }

    $instance = erLhcoreClassModelInstance::findOne(array('filter' => array('address' => (string)$Params['user_parameters']['address'])));

    $cfg = erConfigClassLhConfig::getInstance();

    $db = ezcDbInstance::get();

    $db->query('USE '.$cfg->getSetting( 'db', 'database_user_prefix').$instance->id);

    $apiKey = erLhAbstractModelRestAPIKey::fetch((string)$Params['user_parameters']['id']);
    $apiKey->removeThis();

    echo json_encode(array('error' => 'false','data' => 'removed'));

} else {
    echo json_encode(array('error' => 'true','reason' => 'invalid hash'));
}

exit;
?>