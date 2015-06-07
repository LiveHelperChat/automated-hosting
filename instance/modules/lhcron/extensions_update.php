<?php 

/**
 * Iterates through all instances and executes callback timeout
 * At the moment it's a simple foreach. In the future we may need to enahance this part
 * with some queues etc.
 * 
 * php cron.php -s site_admin -e instance -c cron/extensions_update
 * */

$cfg = erConfigClassLhConfig::getInstance();

$db = ezcDbInstance::get();

foreach (erLhcoreClassModelInstance::getList(array('limit' => 1000000,'filter' => array('status' => erLhcoreClassModelInstance::WORKING))) as $instance) {
    echo "Executing request to update instance internal structure for extensions - ",$instance->id,"\n";
       
    $secretHash = $cfg->getSetting('site','seller_secret_hash');    
    $hash = sha1($instance->id .'extensions'. date('Ym') . $secretHash);        
    $url = erConfigClassLhConfig::getInstance()->getSetting( 'site', 'http_mode').$instance->address . '.' . $cfg->getSetting( 'site', 'seller_domain').'/index.php/instance/extensionsstructure/' . $instance->id . '/' . date('Ym') . '/' . $hash;
    $response = erLhcoreClassModelChatOnlineUser::executeRequest($url);
    echo "Response:\n";
    print_r($response);
    echo PHP_EOL;
}

?>