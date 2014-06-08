<?php

header('content-type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

if (  (string)$Params['user_parameters']['address'] != '' && erLhcoreClassInstance::instanceExists((string)$Params['user_parameters']['address']) == false)
{
	if (isset($_GET['callback'])){
		echo $_GET['callback'] . '(' . json_encode(false) . ')';
	} else {
		echo 'true';
	}
} else {
	if (isset($_GET['callback'])){
		echo $_GET['callback'] . '(' .json_encode(true) . ')';
	} else {
		echo 'false';
	}
}



exit;
?>