<?php

// php cron.php -s site_admin -e instance -c cron/maintain


$cfgSite = erConfigClassLhConfig::getInstance();

if ($cfgSite->getSetting( 'site', 'expire_disabled', false ) == false)
{
    foreach (erLhcoreClassModelInstance::getList(array('filtergt' => array('expires' => 0),'filterlt' => array('expires' => time()-(14*24*3600)))) as $item) {
    	$item->removeThis();
    }
}

echo "Expire status:\n";
print_r(erLhcoreClassInstance::informAboutExpiration());

foreach (erLhcoreClassModelInstance::getList(array('filter' => array('terminate' => 1))) as $item) {
	$item->removeThis();
}

foreach (erLhcoreClassModelInstance::getList(array('filter' => array('status' => erLhcoreClassModelInstance::PENDING_CREATE))) as $item) {
	echo "Starting creating customer - ",$item->id,"\n";
	erLhcoreClassInstance::createCustomer($item);
	echo "Creating customer - ",$item->id,"\n";
}



?>