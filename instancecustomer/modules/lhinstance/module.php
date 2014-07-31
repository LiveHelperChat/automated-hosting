<?php

$Module = array( "name" => "Instance customer");

$ViewList = array();

$ViewList['billing'] = array(
		'params' => array(),
		'functions' => array( 'billing' )
);

$ViewList['remove'] = array(
		'params' => array('id','date','hash')
);

$FunctionList['billing'] = array('explain' => 'Access to billing');

?>