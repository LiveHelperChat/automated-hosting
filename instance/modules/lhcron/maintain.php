<?php

// Create instances which are pending
// php cron.php -s site_admin -e instance -c cron/maintain

$cfgSite = erConfigClassLhConfig::getInstance();

$db = ezcDbInstance::get();

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