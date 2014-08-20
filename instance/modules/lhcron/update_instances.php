<?php 
echo "Updating instances\n";

$contentData = erLhcoreClassModelChatOnlineUser::executeRequest('https://raw.githubusercontent.com/LiveHelperChat/livehelperchat/master/lhc_web/doc/update_db/structure.json');
$cfg = erConfigClassLhConfig::getInstance();

$db = ezcDbInstance::get();

foreach (erLhcoreClassModelInstance::getList(array('limit' => 1000000,'filter' => array('status' => erLhcoreClassModelInstance::WORKING))) as $instance) {
	echo "Updating database for customer - ",$instance->id,"\n";
	$db->query('USE '.$cfg->getSetting( 'db', 'database_user_prefix').$instance->id);
	erLhcoreClassUpdate::doTablesUpdate(json_decode($contentData,true));
}

$CacheManager = erConfigClassLhCacheConfig::getInstance();
$CacheManager->expireCache();

?>