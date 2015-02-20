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

$ViewList['invoices'] = array(
		'params' => array(),
		'functions' => array( 'manageinstance' )
);

$ViewList['isfree'] = array(
		'params' => array('address'),
		'functions' => array(  )
);

$ViewList['paypalipn'] = array(
		'params' => array()
);

$ViewList['billingpdf'] = array(
		'params' => array('id'),
		'functions' => array( 'manageinstance' )
);

/**
 * Standard reseller instance API functions
 * */
$ViewList['registerinstance'] = array(
		'params' => array('address','email','request','period','hash'),
		'uparams' => array(
				'dateformat',
				'hourformat',
				'datehourformat',
				'timezone',
				'frontsiteaccess',
				'operatorlocale',
		    		    
				'files_supported',
				'atranslations_supported',
				'cobrowse_supported',
				'feature_1_supported',
				'feature_2_supported',
				'feature_3_supported',
				    
				// Reseller attributes
				'is_reseller',
				'reseller_tite',
				'reseller_max_instance_request',
				'reseller_secret_hash',
				'reseller_max_instances',
				'reseller_max_instance_request',
				'reseller_request'				
		),
		'functions' => array( )
);

$ViewList['suspendinstance'] = array(
		'params' => array('address','status','hash'),
		'functions' => array( )
);

$ViewList['terminateinstance'] = array(
		'params' => array('address','hash'),
		'functions' => array( )
);

/**
 * Reseller instance API functions
 * */
$ViewList['rslsuspendinstance'] = array(
		'params' => array('id','address','status','hash'),
		'functions' => array( )
);

$ViewList['rslterminateinstance'] = array(
		'params' => array('id','address','hash'),
		'functions' => array( )
);

$ViewList['rslregisterinstance'] = array(
		'params' => array('id','address','email','request','period','hash'),
		'uparams' => array('dateformat','hourformat','datehourformat','timezone','frontsiteaccess','operatorlocale'),
		'functions' => array( )
);


$FunctionList['manageinstance'] = array('explain' => 'Access to instance management');

?>