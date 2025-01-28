<?php

// Create instances which are pending
// php cron.php -s site_admin -e instance -c cron/maintain

// Delete instances which are expired
// php cron.php -s site_admin -e instance -c cron/maintain -p 1

$cfgSite = erConfigClassLhConfig::getInstance();

$db = ezcDbInstance::get();

if (is_numeric($cronjobPathOption->value) && $cronjobPathOption->value == 1) {

    $fp = fopen("cache/instance_delete.lock", "w+");

    if (!flock($fp, LOCK_EX | LOCK_NB)) {
        echo "Couldn't get the lock! Another process is already running";
        fclose($fp);
        return;
    } else {
        chmod("cache/instance_delete.lock", 0666);
        echo "Lock acquired. Starting process!";
    }

    if ($cfgSite->getSetting( 'site', 'expire_disabled', false ) == false)
    {
        foreach (erLhcoreClassModelInstance::getList(array('filtergt' => array('expires' => 0),'filterlt' => array('expires' => time()-($cfgSite->getSetting( 'site', 'terminate_period', 14 )*24*3600)))) as $item) {
            $db->beginTransaction();
            $item->syncAndLock();

            if ($item->status != erLhcoreClassModelInstance::IN_PROGRESS) {
                $item->status = erLhcoreClassModelInstance::IN_PROGRESS;
                $item->saveThis();

                $item->removeThis();
            }

            $db->commit();
        }
    }

    return;
}

echo "Expire status:\n";
print_r(erLhcoreClassInstance::informAboutExpiration());

foreach (erLhcoreClassModelInstance::getList(array('filter' => array('terminate' => 1))) as $item) {

    $db->beginTransaction();
    $item->syncAndLock();

    if ($item->status != erLhcoreClassModelInstance::IN_PROGRESS) {

        $item->status = erLhcoreClassModelInstance::IN_PROGRESS;
        $item->saveThis();

        $item->removeThis();
    }

    $db->commit();
}

foreach (erLhcoreClassModelInstance::getList(array('filter' => array('status' => erLhcoreClassModelInstance::PENDING_CREATE))) as $item) {

    $db->beginTransaction();

    $item->syncAndLock();

    if ($item->status != erLhcoreClassModelInstance::IN_PROGRESS)
    {
        $item->status = erLhcoreClassModelInstance::IN_PROGRESS;
        $item->saveThis();

        echo "Starting creating customer - ",$item->id,"\n";
        erLhcoreClassInstance::createCustomer($item);
        echo "Creating customer - ",$item->id,"\n";
    }

    $db->commit();
}



?>