<?php

/**
 * Iterates through all instances and executes webhook worker for each instance
 *
 * Should be run every 8 hours
 *
 * php cron.php -s site_admin -e instance -c cron/archive_resque
 * */

$cfg = erConfigClassLhConfig::getInstance();
$db = ezcDbInstance::get();

foreach (erLhcoreClassModelInstance::getList(array('limit' => 1000000,'filter' => array('status' => erLhcoreClassModelInstance::WORKING))) as $instance) {
    erLhcoreClassModule::getExtensionInstance('erLhcoreClassExtensionLhcphpresque')->enqueue('lhc_instance_workflow', '\LiveHelperChatExtension\instancecustomer\providers\InstanceWorkerArchive', array('inst_id' => $instance->id));
}

?>