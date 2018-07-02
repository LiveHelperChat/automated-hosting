<?php

// php cron.php -s site_admin -e instance -c cron/maintain

$cfgSite = erConfigClassLhConfig::getInstance();

$db = ezcDbInstance::get();

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