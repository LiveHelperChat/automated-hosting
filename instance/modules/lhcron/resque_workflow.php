<?php

/**
 * Iterates through all instances and schedules a job for each instance
 *
 * Should be run every minute preferable every 10 seconds
 *
 * php cron.php -s site_admin -e instance -c cron/workflow_resque
 * */

$cfg = erConfigClassLhConfig::getInstance();
$db = ezcDbInstance::get();

foreach (erLhcoreClassModelInstance::getList(array('limit' => 1000000,'filter' => array('status' => erLhcoreClassModelInstance::WORKING))) as $instance) {
    erLhcoreClassModule::getExtensionInstance('erLhcoreClassExtensionLhcphpresque')->enqueue('lhc_instance_workflow', '\LiveHelperChatExtension\instancecustomer\providers\InstanceWorker', array('inst_id' => $instance->id));
}

?>