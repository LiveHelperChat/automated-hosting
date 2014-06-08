<?php

$Module = array( "name" => "Instance configuration");

$ViewList = array();

$ViewList['list'] = array(
    'params' => array(),
    'functions' => array( 'manageinstance' )
);

$ViewList['edit'] = array(
    'params' => array('instance_id'),
    'functions' => array( 'manageinstance' )
);

$ViewList['new'] = array(
		'params' => array(),
		'functions' => array( 'manageinstance' )
);

$ViewList['isfree'] = array(
		'params' => array('address'),
		'functions' => array(  )
);

$ViewList['registerinstance'] = array(
		'params' => array('address','email','request','period','hash'),
		'functions' => array( )
);

$FunctionList['manageinstance'] = array('explain' => 'Access to instance management');

?>