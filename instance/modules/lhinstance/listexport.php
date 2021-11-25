<?php

header ( 'content-type: application/json; charset=utf-8' );

$cfg = erConfigClassLhConfig::getInstance();

$secretHash = $cfg->getSetting('site','seller_secret_hash');

$items = [];

if (isset($_GET['secret_hash']) && $secretHash == $_GET['secret_hash']) {
    foreach (erLhcoreClassModelInstance::getList(['limit' => false]) as $item) {
        $items[] = [
            'address' => $item->address,
            'id' => $item->id
        ];
    }
}

echo json_encode($items);
exit;