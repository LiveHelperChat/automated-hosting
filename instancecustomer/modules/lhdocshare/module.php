<?php

$Module = array( "name" => "Documents sharer");

$ViewList = array();

$ViewList['configuration'] = array(
		'params' => array(),
		'functions' => array( 'change_configuration' )
);

$FunctionList['change_configuration'] = array('explain' => 'Allow user to change documents sharer configuration');

?>