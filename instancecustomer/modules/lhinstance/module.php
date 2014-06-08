<?php

$Module = array( "name" => "Instance customer");

$ViewList = array();

$ViewList['billing'] = array(
		'params' => array(),
		'functions' => array( 'billing' )
);

$FunctionList['billing'] = array('explain' => 'Access to billing');

?>