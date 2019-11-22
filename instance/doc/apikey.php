<?php

include 'apiinstance.php';
include 'apireseller.php';

$lhc = new LHCAutomatedHostingAPI('<http://manage.livehelperchat.com>', '<secret_hash>');

// Create/update instance example
try {

    // To create API Key
    $apiData = $lhc->addAPIKey('testdomain5',1,'customersecretkey');

    // To delete just create API Key
    $apiData = $lhc->deleteAPIKey('testdomain5',$apiData['data']['id']);

} catch (Exception $e) {
    echo $e->getMessage();
}

?>