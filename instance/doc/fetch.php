<?php

include 'apiinstance.php';

$lhc = new LHCAutomatedHostingAPI('<http://manage.livehelperchat.com>', '<secret_hash>');// E.g $lhc = new LHCAutomatedHostingAPI('http://manage.livehelperchat.com', 'somrerandom_text');

// Fetch instance data
try {
    print_r($lhc->fetchInstance('testdomain4'));
} catch (Exception $e) {
    echo $e->getMessage();
}

?>