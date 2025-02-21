<?php
/*
 * php cron.php -s site_admin -e instancecustomer -c cron/remove_expired -p 1
 * sudo -u www-data php cron.php -s site_admin -e instancecustomer -c cron/remove_expired -p 1
 * */
$cfg = erConfigClassLhConfig::getInstance();

$db = ezcDbInstance::get();

$fp = fopen("cache/instance_delete.lock", "w+");

if (!flock($fp, LOCK_EX | LOCK_NB)) {
    echo "Couldn't get the lock! Another process is already running\n";
    fclose($fp);
    return;
} else {
    chmod("cache/instance_delete.lock", 0666);
    echo "Lock acquired. Starting process!\n";
}

if ($cfg->getSetting( 'site', 'expire_disabled', false ) == false)
{
    $total = 0;
    foreach (erLhcoreClassModelInstance::getList(array('filtergt' => array('expires' => 0),'filterlt' => array('expires' => time()-($cfg->getSetting( 'site', 'terminate_period', 14 )*24*3600)))) as $item) {

        $cfg = \erConfigClassLhConfig::getInstance();
        $db->query('USE ' . $cfg->getSetting('db', 'database'));

        $instance = \erLhcoreClassModelInstance::fetch($item->id);
        \erLhcoreClassInstance::$instanceChat = $instance;

        echo date('Y-m-d H:i:s',$item->expires),"\n";
        echo $item->id,"\n";
        $total++;

        if ($item->status != erLhcoreClassModelInstance::IN_PROGRESS) {

            $db->beginTransaction();

            $item->status = erLhcoreClassModelInstance::IN_PROGRESS;
            $item->saveThis();

            $db->query('USE ' . $cfg->getSetting('db', 'database_user_prefix') . $item->id);

            $db->commit();

            if (erLhcoreClassInstance::$instanceChat->removeInstanceData() === true) {

                echo "Instance data removed\n";

                $db->query('DROP DATABASE IF EXISTS '.$cfg->getSetting( 'db', 'database_user_prefix').$item->id.';');

                $db->query('USE ' . $cfg->getSetting('db', 'database'));

                erLhcoreClassInstance::getSession()->delete(erLhcoreClassInstance::$instanceChat);
            } else {
                echo "Instance data not removed\n";
            }
        }
        echo "Removed instance - ",$item->id,"\n";
    }
}

