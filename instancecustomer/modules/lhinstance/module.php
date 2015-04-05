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

$ViewList['workflow'] = array(
		'params' => array('id','date','hash')
);

$ViewList['billingpdf'] = array(
		'params' => array('id'),
		'functions' => array( 'billing' )
);

$ViewList['billinginstance'] = array(
		'params' => array(),
		'functions' => array( 'billing' )
);

$FunctionList['billing'] = array('explain' => 'Access to billing');

?>