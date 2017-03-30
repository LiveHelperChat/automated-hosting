<?php

$host = $_GET['host'];

try {
    $item = erLhcoreClassInstanceAPI::getInstanceByHost($_GET['host']);
    echo json_encode(array('error' => false, 'data' => $item->getState()));
} catch (Exception $e) {
    echo json_encode(array('error' => true, 'message' => $e->getMessage()));
}

exit;

?>