<?php 

// php cron.php -s site_admin -e instance -c cron/update_instances

echo "Updating instances\n";

$contentData = erLhcoreClassModelChatOnlineUser::executeRequest('https://raw.githubusercontent.com/LiveHelperChat/livehelperchat/master/lhc_web/doc/update_db/structure.json');
$cfg = erConfigClassLhConfig::getInstance();

$db = ezcDbInstance::get();

foreach (erLhcoreClassModelInstance::getList(array('limit' => 1000000,'filterin' => array('status' => [erLhcoreClassModelInstance::WORKING, erLhcoreClassModelInstance::IN_PROGRESS]))) as $instance) {
	echo "Updating database for customer - ",$instance->id,"\n";
	$db->query('USE '.$cfg->getSetting( 'db', 'database_user_prefix').$instance->id);
	erLhcoreClassUpdate::doTablesUpdate(json_decode($contentData,true));
}

$CacheManager = erConfigClassLhCacheConfig::getInstance();
$CacheManager->expireCache();

?>