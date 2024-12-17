<?php

/*
php cron.php -s site_admin -e instance -c cron/maintain
*/

$cfg = erConfigClassLhConfig::getInstance();

$db = ezcDbInstance::get();

$stmt = $db->prepare("SHOW DATABASES");
$stmt->execute();
$databases = $stmt->fetchAll(PDO::FETCH_COLUMN);

$databasesToCheck = array();
foreach($databases as $database) {
    if (strpos($database,$cfg->getSetting( 'db', 'database_user_prefix')) !== false) {
        $databasesToCheck[] = array(
            'db' => $database,
            'id' => str_replace($cfg->getSetting( 'db', 'database_user_prefix'),'',$database)
        );
    }
}

$validDb = array();
$invalidDb = array();

foreach ($databasesToCheck as $db) {

    $item = erLhcoreClassModelInstance::findOne(array('filter' => array('id' => $db['id'])));

    if ($item instanceof erLhcoreClassModelInstance) {
        $validDb[] = $item;
    } else {
        $invalidDb[] = $db;
    }
}

echo erLhcoreClassModelInstance::getCount(),"-",count($validDb),"-",count($invalidDb);

foreach ($invalidDb as $dbDelete)
{
    $cfg = erConfigClassLhConfig::getInstance();
    $db = ezcDbInstance::get();
    $sql = 'DROP DATABASE IF EXISTS '.$cfg->getSetting( 'db', 'database_user_prefix').$dbDelete['id'].';';
    $db->query($sql);
}