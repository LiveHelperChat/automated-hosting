<?php

$tpl = erLhcoreClassTemplate::getInstance('lhinstance/edit.tpl.php');

$Instance = erLhcoreClassModelInstance::fetch((int)$Params['user_parameters']['instance_id']);

$cfgSite = erConfigClassLhConfig::getInstance();
$tpl->set('locales',$cfgSite->getSetting('site', 'available_site_access' ));

if ( isset($_POST['Cancel_departament']) ) {
    erLhcoreClassModule::redirect('instance/list');
    exit;
}

if (isset($_POST['ChangePassword']) )
{
	$definition = array(
			'InstancePassword' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
			),
			'InstanceUsername' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
			));
	$form = new ezcInputForm( INPUT_POST, $definition );
	$Errors = array();

	if ( $form->hasValidData( 'InstancePassword' ) && $form->InstancePassword != '' )
	{
		$Instance->setPassword($form->InstancePassword);
		$tpl->set('updated',true);
	} else {
		$tpl->set('errors',array('Password was not change'));
	}

	if ( $form->hasValidData( 'InstanceUsername' ) && $form->InstanceUsername != '' )
	{
		$Instance->setUsername($form->InstanceUsername);
		$tpl->set('updated',true);
	} else {
		$tpl->set('errors',array('Username was not change'));
	}
}

if (isset($_POST['UpdateAttributes']) )
{
	$definition = array(			
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
	
	$Instance->saveThis();	
	$tpl->set('updated',true);	
}

if (isset($_POST['UpdateSMS']) )
{
    $definition = array(
        'sms_supported' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
        ),
        'phone_number' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
        ),
        'add_sms_to_user' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'int',array('min_range' => 1)
        ),
        'sms_plan' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'int',array('min_range' => 1)
        ),
        'soft_limit_type' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'int',array('min_range' => 1,'max_range' => 2)
        ),
        'hard_limit_type' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'int',array('min_range' => 1,'max_range' => 2)
        ),
        'soft_limit' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'int'
        ),
        'hard_limit' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'int'
        ),
    );
    
    $form = new ezcInputForm( INPUT_POST, $definition );
    $Errors = array();
    
    if ( $form->hasValidData( 'sms_supported' ) && $form->sms_supported == true )
    {
        $Instance->sms_supported = 1;
    } else {
        $Instance->sms_supported = 0;
    }

    if ( $form->hasValidData( 'phone_number' )) {
        $Instance->phone_number = $form->phone_number;
    } else {
        $Instance->phone_number = '';
    }

    if ( $form->hasValidData( 'add_sms_to_user' ))
    {
        $Instance->sms_left += $form->add_sms_to_user;
    }

    if ( $form->hasValidData( 'sms_plan' ))
    {
        $Instance->sms_plan = $form->sms_plan;
    }

    if ( $form->hasValidData( 'soft_limit_type' ))
    {
        $Instance->soft_limit_type = $form->soft_limit_type;
    }

    if ( $form->hasValidData( 'hard_limit_type' ))
    {
        $Instance->hard_limit_type = $form->hard_limit_type;
    }

    if ( $form->hasValidData( 'soft_limit' ))
    {
        $Instance->soft_limit = $form->soft_limit;
    }

    if ( $form->hasValidData( 'hard_limit' ))
    {
        $Instance->hard_limit = $form->hard_limit;
    }
    
    if ($Instance->soft_limit_in_effect == false) {
        $Instance->soft_warning_send = false;
    }
    
    if ($Instance->hard_limit_in_effect == false) {
        $Instance->hard_warning_send = false;
    }
    
    $Instance->saveThis();
    $tpl->set('updated',true);
}

if (isset($_POST['UpdateFeatures']) )
{
	$definition = array(			
			'files_supported' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
			),
			'chat_supported' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
			),
			'atranslations_supported' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
			),
			'cobrowse_supported' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
			),			
			'forms_supported' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
			),			
			'cannedmsg_supported' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
			),			
			'faq_supported' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
			),			
			'feature_1_supported' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
			),			
			'feature_2_supported' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
			),			
			'feature_3_supported' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
			),			
			'reporting_supported' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
			),			
			'chatbox_supported' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
			),			
			'browseoffers_supported' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
			),			
			'questionnaire_supported' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
			),			
			'proactive_supported' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
			),			
			'screenshot_supported' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
			),			
			'blocked_supported' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
			),			
			'footprint_supported' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
			),			
			'previouschats_supported' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
			),			
			'autoresponder_supported' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
			),			
			'chatremarks_supported' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
			),			
			'geoadjustment_supported' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
			),			
			'onlinevisitortrck_supported' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
			)			
	);

	
	$form = new ezcInputForm( INPUT_POST, $definition );
	$Errors = array();
	
	if ( $form->hasValidData( 'reporting_supported' ) && $form->reporting_supported == true )
	{
		$Instance->reporting_supported = 1;
	} else {
	    $Instance->reporting_supported = 0;
	}
	
	if ( $form->hasValidData( 'chat_supported' ) && $form->chat_supported == true )
	{
		$Instance->chat_supported = 1;
	} else {
	    $Instance->chat_supported = 0;
	}
	
	if ( $form->hasValidData( 'previouschats_supported' ) && $form->previouschats_supported == true )
	{
		$Instance->previouschats_supported = 1;
	} else {
	    $Instance->previouschats_supported = 0;
	}
	
	if ( $form->hasValidData( 'geoadjustment_supported' ) && $form->geoadjustment_supported == true )
	{
		$Instance->geoadjustment_supported = 1;
	} else {
	    $Instance->geoadjustment_supported = 0;
	}
	
	if ( $form->hasValidData( 'onlinevisitortrck_supported' ) && $form->onlinevisitortrck_supported == true )
	{
		$Instance->onlinevisitortrck_supported = 1;
	} else {
	    $Instance->onlinevisitortrck_supported = 0;
	}
	
	if ( $form->hasValidData( 'chatremarks_supported' ) && $form->chatremarks_supported == true )
	{
		$Instance->chatremarks_supported = 1;
	} else {
	    $Instance->chatremarks_supported = 0;
	}
	
	if ( $form->hasValidData( 'autoresponder_supported' ) && $form->autoresponder_supported == true )
	{
		$Instance->autoresponder_supported = 1;
	} else {
	    $Instance->autoresponder_supported = 0;
	}
	
	if ( $form->hasValidData( 'chatbox_supported' ) && $form->chatbox_supported == true )
	{
		$Instance->chatbox_supported = 1;
	} else {
	    $Instance->chatbox_supported = 0;
	}
	
	if ( $form->hasValidData( 'footprint_supported' ) && $form->footprint_supported == true )
	{
		$Instance->footprint_supported = 1;
	} else {
	    $Instance->footprint_supported = 0;
	}
	
	if ( $form->hasValidData( 'browseoffers_supported' ) && $form->browseoffers_supported == true )
	{
		$Instance->browseoffers_supported = 1;
	} else {
	    $Instance->browseoffers_supported = 0;
	}
	
	if ( $form->hasValidData( 'questionnaire_supported' ) && $form->questionnaire_supported == true )
	{
		$Instance->questionnaire_supported = 1;
	} else {
	    $Instance->questionnaire_supported = 0;
	}
	
	if ( $form->hasValidData( 'proactive_supported' ) && $form->proactive_supported == true )
	{
		$Instance->proactive_supported = 1;
	} else {
	    $Instance->proactive_supported = 0;
	}
	
	if ( $form->hasValidData( 'blocked_supported' ) && $form->blocked_supported == true )
	{
		$Instance->blocked_supported = 1;
	} else {
	    $Instance->blocked_supported = 0;
	}
	
	if ( $form->hasValidData( 'screenshot_supported' ) && $form->screenshot_supported == true )
	{
		$Instance->screenshot_supported = 1;
	} else {
	    $Instance->screenshot_supported = 0;
	}
	
	if ( $form->hasValidData( 'files_supported' ) && $form->files_supported == true )
	{
		$Instance->files_supported = 1;
	} else {
	    $Instance->files_supported = 0;
	}
	
	if ( $form->hasValidData( 'forms_supported' ) && $form->forms_supported == true )
	{
		$Instance->forms_supported = 1;
	} else {
	    $Instance->forms_supported = 0;
	}
	
	if ( $form->hasValidData( 'atranslations_supported' ) && $form->atranslations_supported == true )
	{
		$Instance->atranslations_supported = 1;
	} else {
	    $Instance->atranslations_supported = 0;
	}
	
	if ( $form->hasValidData( 'cannedmsg_supported' ) && $form->cannedmsg_supported == true )
	{
		$Instance->cannedmsg_supported = 1;
	} else {
	    $Instance->cannedmsg_supported = 0;
	}
	
	if ( $form->hasValidData( 'faq_supported' ) && $form->faq_supported == true )
	{
		$Instance->faq_supported = 1;
	} else {
	    $Instance->faq_supported = 0;
	}
	
	if ( $form->hasValidData( 'cobrowse_supported' ) && $form->cobrowse_supported == true )
	{
		$Instance->cobrowse_supported = 1;
	} else {
	    $Instance->cobrowse_supported = 0;
	}
	
	if ( $form->hasValidData( 'feature_1_supported' ) && $form->feature_1_supported == true )
	{
		$Instance->feature_1_supported = 1;
	} else {
	    $Instance->feature_1_supported = 0;
	}
	
	if ( $form->hasValidData( 'feature_2_supported' ) && $form->feature_2_supported == true )
	{
		$Instance->feature_2_supported = 1;
	} else {
	    $Instance->feature_2_supported = 0;
	}
	
	if ( $form->hasValidData( 'feature_3_supported' ) && $form->feature_3_supported == true )
	{
		$Instance->feature_3_supported = 1;
	} else {
	    $Instance->feature_3_supported = 0;
	}
	
	$Instance->saveThis();	
	$tpl->set('updated',true);	
}

if (isset($_POST['UpdateReseller']) )
{
	$definition = array(			
			'ResellerTitle' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'string'
			),
			'ResellerMaxRequest' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'string'
			),
			'ResellerMaxInstance' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'string'
			),
			'ResellerSecretHash' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'string'
			),
			'ResellerRequest' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'string'
			),
			'Reseller' => new ezcInputFormDefinitionElement(
					ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
			)			
	);
	
	$form = new ezcInputForm( INPUT_POST, $definition );
	$Errors = array();
	
	if ( $form->hasValidData( 'ResellerTitle' ) )
	{
		$Instance->reseller_tite = $form->ResellerTitle;
	}
	
	if ( $form->hasValidData( 'ResellerMaxRequest' ) )
	{
		$Instance->reseller_max_instance_request = $form->ResellerMaxRequest;
	}
	
	if ( $form->hasValidData( 'ResellerMaxInstance' ) )
	{
		$Instance->reseller_max_instances = $form->ResellerMaxInstance;
	}
	
	if ( $form->hasValidData( 'ResellerSecretHash' ) )
	{
		$Instance->reseller_secret_hash = $form->ResellerSecretHash;
	}
	
	if ( $form->hasValidData( 'ResellerRequest' ) )
	{
		$Instance->reseller_request = $form->ResellerRequest;
	}
	
	if ( $form->hasValidData( 'Reseller' ) && $form->Reseller == true )
	{
		$Instance->is_reseller = $form->Reseller;
	} else {
		$Instance->is_reseller = false;
	}
		
	$Instance->saveThis();	
	$tpl->set('updated',true);	
}


if (isset($_POST['Update_departament']) || isset($_POST['Save_departament'])  )
{
   $definition = array(
        'Address' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
        ),
        'ClientTitle' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
        ),
        'Email' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'validate_email'
        ), 
   		'Suspended' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
        ),
        'Terminate' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
        ),
        'Request' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'string'
        ),
        'RequestUsed' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'int'
        ),      
        'Expires' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'string'
        )       
    );

    $form = new ezcInputForm( INPUT_POST, $definition );
    $Errors = array();

    if ( $form->hasValidData( 'Address' ) )
    {
        $Instance->address = $form->Address;
    }
    
    if ( $form->hasValidData( 'ClientTitle' ) )
    {
        $Instance->client_title = $form->ClientTitle;
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
    
    if ( $form->hasValidData( 'Suspended' ) && $form->Suspended == true )
    {
    	$Instance->suspended = 1;
    } else {
    	$Instance->suspended = 0;
    }
    
    if ( $form->hasValidData( 'Terminate' ) && $form->Terminate == true )
    {
    	$Instance->terminate = 1;
    } else {
    	$Instance->terminate = 0;
    }
    
    if ( $form->hasValidData( 'RequestUsed' ) )
    {
        $Instance->request_used = $form->RequestUsed;
    }
    
    if ( $form->hasValidData( 'Expires' ) && ($time = strtotime($form->Expires)) !== false )
    {
    	$Instance->expires = $time;
    } else {
    	$Errors[] = 'Please enter valid date';
    }

    if (!isset($_POST['csfr_token']) || !$currentUser->validateCSFRToken($_POST['csfr_token'])) {
     	erLhcoreClassModule::redirect('instance/list');
    	exit;
    }

    if (count($Errors) == 0)
    {
        $Instance->saveThis();

        if (isset($_POST['Save_departament'])) {
            erLhcoreClassModule::redirect('instance/list');
            exit;
        } else {
            $tpl->set('updated',true);
        }

    }  else {
        $tpl->set('errors',$Errors);
    }
}

erLhcoreClassChatEventDispatcher::getInstance()->dispatch('instance.editinstance',array('instance' => & $Instance));

$tpl->set('instance',$Instance);

$Result['content'] = $tpl->fetch();

$Result['path'] = array(
array('url' => erLhcoreClassDesign::baseurl('system/configuration'),'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('department/edit','System configuration')),
array('url' => erLhcoreClassDesign::baseurl('instance/list'),'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Instances')),
array('title' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Edit instance').' - '.$Instance->address));

?>