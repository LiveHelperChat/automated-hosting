<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lhinstance/new.tpl.php');
$Instance = new erLhcoreClassModelInstance();

$cfgSite = erConfigClassLhConfig::getInstance();
$tpl->set('locales',$cfgSite->getSetting('site', 'available_site_access' ));

if ( isset($_POST['Cancel_departament']) ) {
    erLhcoreClassModule::redirect('instance/list');
    exit;
}

if (isset($_POST['Save_departament']))
{
	$definition = array(
        'Address' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
        ),
        'Email' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'validate_email'
        ),
        'Request' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'string'
        ),
        'RequestUsed' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'int'
        ),
        'Status' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'int',array('min_range' => 0)
        ),
        'Expires' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'string'
        ),
		'DateFormat' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::OPTIONAL, 'string'
		),
		'DateHourFormat' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::OPTIONAL, 'string'
		),
		'DateAndHourFormat' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::OPTIONAL, 'string'
		),
		'UserTimeZone' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::OPTIONAL, 'string'
		),
		'FrontSiteaccess' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::OPTIONAL, 'string'
		),
		'Language' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::OPTIONAL, 'string'
		),
		'UserTimeZone' => new ezcInputFormDefinitionElement(
				ezcInputFormDefinitionElement::OPTIONAL, 'string'
		)
    );

    $form = new ezcInputForm( INPUT_POST, $definition );
    $Errors = array();
    
    if ( $form->hasValidData( 'Language' ) )
    {
    	$Instance->locale = $form->Language;
    }
    
    if ( $form->hasValidData( 'DateFormat' ) )
    {
    	$Instance->date_format = $form->DateFormat;
    }
    
    if ( $form->hasValidData( 'DateHourFormat' ) )
    {
    	$Instance->date_hour_format = $form->DateHourFormat;
    }
    
    if ( $form->hasValidData( 'DateAndHourFormat' ) )
    {
    	$Instance->date_date_hour_format = $form->DateAndHourFormat;
    }
    
    if ( $form->hasValidData( 'UserTimeZone' ) )
    {
    	$Instance->time_zone = $form->UserTimeZone;
    }
    
    if ( $form->hasValidData( 'FrontSiteaccess' ) )
    {
    	$Instance->siteaccess = $form->FrontSiteaccess;
    }
    
    if ( $form->hasValidData( 'Address' ) && erLhcoreClassInstance::instanceExists($form->Address) == false )
    {
        $Instance->address = $form->Address;
    } else {
    	$Errors[] = 'Instance exists';
    }

    if ( $form->hasValidData( 'Email' ) )
    {
        $Instance->email = $form->Email;
    } else {
    	$Errors[] = 'Please enter valid e-mail';
    }

    if ( $form->hasValidData( 'Request' ) )
    {
        $Instance->request = $form->Request;
    }

    if ( $form->hasValidData( 'RequestUsed' ) )
    {
        $Instance->request_used = $form->RequestUsed;
    }

    if ( $form->hasValidData( 'Status' ) )
    {
        $Instance->status = $form->Status;
    }

    if (!isset($_POST['csfr_token']) || !$currentUser->validateCSFRToken($_POST['csfr_token'])) {
     	erLhcoreClassModule::redirect('instance/list');
    	exit;
    }

    if ( $form->hasValidData( 'Expires' ) && ($time = strtotime($form->Expires)) !== false )
    {
    	$Instance->expires = $time;
    } else {
    	$Errors[] = 'Please enter valid date';
    }

    if (count($Errors) == 0)
    {
        $Instance->saveThis();
        erLhcoreClassModule::redirect('instance/list');
        exit ;

    }  else {
        $tpl->set('errors',$Errors);
    }
}

$tpl->set('instance',$Instance);

$Result['content'] = $tpl->fetch();

$Result['path'] = array(
array('url' => erLhcoreClassDesign::baseurl('system/configuration'),'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('department/new','System configuration')),
array('url' => erLhcoreClassDesign::baseurl('instance/list'),'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Instances')),
array('title' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','New instance')),
);

?>