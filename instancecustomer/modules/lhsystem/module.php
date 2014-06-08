<?php

$Module = array( "name" => "System configuration");

$ViewList = array();

$ViewList['languages'] = array(
    'script' => 'languages.php',
    'params' => array(),
    'uparams' => array('updated','sa'),
    'functions' => array( 'changelanguage' )
);

$ViewList['timezone'] = array(
		'params' => array(),
		'functions' => array( 'timezone' )
);

?>
