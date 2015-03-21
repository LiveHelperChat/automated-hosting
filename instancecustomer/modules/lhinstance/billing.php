<?php

$tpl = erLhcoreClassTemplate::getInstance('lhinstance/billing.tpl.php');

$db = ezcDbInstance::get(); // Needed to load correct data
$instance = erLhcoreClassInstance::getInstance();
$tpl->set('instance',$instance);


if (isset($_POST['SaveClientName'])) {
    $definition = array(
        'ClientTitle' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
        ));
    
    $form = new ezcInputForm( INPUT_POST, $definition );
    
    if ( $form->hasValidData( 'ClientTitle' ) ) {
        $instance->client_title = $form->ClientTitle;
    } else {
        $instance->client_title = '';
    }
    
    $instance->saveToInstanceThis();
    
    $tpl->set('client_title_updated',true);
}

if (isset($_POST['SaveDefaultDepartment'])) {
    $definition = array(
        'DepartmentID' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'int',array('min_range' => 1)
        ));
    
    $form = new ezcInputForm( INPUT_POST, $definition );
    
    if ( $form->hasValidData( 'DepartmentID' ) ) {
        $instance->phone_default_department = $form->DepartmentID;
    } else {
        $instance->phone_default_department = 0;
    }
    
    $instance->saveToInstanceThis();
    
    $tpl->set('sms_updated',true);
    $tpl->set('tab','sms');
}

if (isset($_POST['RequestAction'])) {
    
    $definition = array(
        'files_supported' => new ezcInputFormDefinitionElement(
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
        'sms_supported' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
        ),
        'onlinevisitortrck_supported' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
        ),
        'chat_supported' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'boolean'
        )
    );
    
    
    $form = new ezcInputForm( INPUT_POST, $definition );
    $Errors = array();
    $modules = array(
        'reporting_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Files supported'),
        'atranslations_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Automatic translations supported'),
        'cobrowse_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Co-Browse supported'),
        'forms_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Forms supported'),
        'cannedmsg_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Canned messages supported'),
        'faq_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','FAQ supported'),
        'reporting_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Reporting supported'),
        'chatbox_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Chatbox supported'),
        'browseoffers_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Browse offers supported'),
        'questionnaire_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Questionnaire supported'),
        'proactive_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Proactive supported'),
        'screenshot_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Screenshot supported'),
        'blocked_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','User blocking supported'),
        'files_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Files supported'),
        'sms_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','SMS chat supported'),
        'onlinevisitortrck_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Online visitors list supported'),
        'geoadjustment_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','GEO adjustment supporte'),
        'chatremarks_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Chat notes supported'),
        'autoresponder_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Autoresponder supported'),
        'previouschats_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Previous chats supported'),
        'footprint_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Footprint supported'),
        'chat_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Chat supported'),
    );
    
    $requestedModules = array(
        
    );
    
    if ( $form->hasValidData( 'previouschats_supported' ) && $form->previouschats_supported == true ) {
        $requestedModules[] = $modules['previouschats_supported'];      
    }
    
    if ( $form->hasValidData( 'chat_supported' ) && $form->chat_supported == true ) {
        $requestedModules[] = $modules['chat_supported'];      
    }
    
    if ( $form->hasValidData( 'footprint_supported' ) && $form->footprint_supported == true ) {
        $requestedModules[] = $modules['footprint_supported'];      
    }
    
    if ( $form->hasValidData( 'autoresponder_supported' ) && $form->autoresponder_supported == true ) {
        $requestedModules[] = $modules['autoresponder_supported'];      
    }
    
    if ( $form->hasValidData( 'reporting_supported' ) && $form->reporting_supported == true ) {
        $requestedModules[] = $modules['reporting_supported'];      
    }
    
    if ( $form->hasValidData( 'chatremarks_supported' ) && $form->chatremarks_supported == true ) {
        $requestedModules[] = $modules['chatremarks_supported'];      
    }
    
    if ( $form->hasValidData( 'geoadjustment_supported' ) && $form->geoadjustment_supported == true ) {
        $requestedModules[] = $modules['geoadjustment_supported'];      
    }
    
    if ( $form->hasValidData( 'onlinevisitortrck_supported' ) && $form->onlinevisitortrck_supported == true ) {
        $requestedModules[] = $modules['onlinevisitortrck_supported'];      
    }
    
    if ( $form->hasValidData( 'chatbox_supported' ) && $form->chatbox_supported == true ) {
        $requestedModules[] = $modules['chatbox_supported'];   
    }
    
    if ( $form->hasValidData( 'browseoffers_supported' ) && $form->browseoffers_supported == true ) {
        $requestedModules[] = $modules['browseoffers_supported']; 
    }
    
    if ( $form->hasValidData( 'questionnaire_supported' ) && $form->questionnaire_supported == true ) {
        $requestedModules[] = $modules['questionnaire_supported']; 
    }
    
    if ( $form->hasValidData( 'proactive_supported' ) && $form->proactive_supported == true ) {
        $requestedModules[] = $modules['proactive_supported']; 
    }
    
    if ( $form->hasValidData( 'blocked_supported' ) && $form->blocked_supported == true ) {
        $requestedModules[] = $modules['blocked_supported']; 
    }
    
    if ( $form->hasValidData( 'screenshot_supported' ) && $form->screenshot_supported == true ) {
        $requestedModules[] = $modules['screenshot_supported']; 
    }
    
    if ( $form->hasValidData( 'files_supported' ) && $form->files_supported == true ) {
        $requestedModules[] = $modules['files_supported']; 
    }
    
    if ( $form->hasValidData( 'forms_supported' ) && $form->forms_supported == true ) {
        $requestedModules[] = $modules['forms_supported']; 
    }
    
    if ( $form->hasValidData( 'atranslations_supported' ) && $form->atranslations_supported == true ) {
        $requestedModules[] = $modules['atranslations_supported']; 
    }
    
    if ( $form->hasValidData( 'cannedmsg_supported' ) && $form->cannedmsg_supported == true ) {
        $requestedModules[] = $modules['cannedmsg_supported'];
    }
    
    if ( $form->hasValidData( 'faq_supported' ) && $form->faq_supported == true ) {
        $requestedModules[] = $modules['faq_supported'];
    }
    
    if ( $form->hasValidData( 'cobrowse_supported' ) && $form->cobrowse_supported == true ) {
         $requestedModules[] = $modules['cobrowse_supported'];
    }
    
    if ( $form->hasValidData( 'feature_1_supported' ) && $form->feature_1_supported == true ) {
       $requestedModules[] = $modules['feature_1_supported'];
    }
    
    if ( $form->hasValidData( 'feature_2_supported' ) && $form->feature_2_supported == true ) {
        $requestedModules[] = $modules['feature_2_supported'];
    }
    
    if ( $form->hasValidData( 'feature_3_supported' ) && $form->feature_3_supported == true ) {
        $requestedModules[] = $modules['feature_3_supported'];
    }
            
    erLhcoreClassChatEventDispatcher::getInstance()->dispatch('instance.requestfeatures',array('requested' => & $requestedModules));
    
    if (!empty($requestedModules)) {
               
        $mail = new PHPMailer(true);
        $mail->CharSet = "UTF-8";
        $mail->Subject = erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','More features requested by intance').' - '.$instance->id;
        $mail->AddReplyTo($instance->email,(string)$instance->address);
        $mail->Body = erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','User requested more feature')."\n".implode("\n", $requestedModules);
        $mail->AddAddress( erConfigClassLhConfig::getInstance()->getSetting('site','support_mail') );
        
        erLhcoreClassChatMail::setupSMTP($mail);

        try {
            $mail->Send();
        } catch (Exception $e) {
           
        }
        
        $mail->ClearAddresses();
                
        $tpl->set('request_send',true);
    } else {
        $tpl->set('errors',array(erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Please choose at least one valid module!')));
    }
}


$pages = new lhPaginator();
$pages->items_total = erLhcoreClassModelInstanceInvoice::getCount(array('filter' => array('instance_id' => $instance->id)));
$pages->translationContext = 'instance/billing';
$pages->serverURL = erLhcoreClassDesign::baseurl('instance/billing');
$pages->setItemsPerPage(20);
$pages->paginate();

$tpl->set('pages',$pages);

$items = array();
if ($pages->items_total > 0) {
	$items = erLhcoreClassModelInstanceInvoice::getList(array('filter' => array('instance_id' => $instance->id),'offset' => $pages->low, 'limit' => $pages->items_per_page));
}

$tpl->set('items',$items);

if ($instance->is_reseller) {
	
	$pagesInstances = new lhPaginator();
	$pagesInstances->items_total = erLhcoreClassModelInstance::getCount(array('switch_db' => true,'filter' => array('reseller_id' => $instance->id)));
	$pagesInstances->translationContext = 'instance/billing';
	$pagesInstances->serverURL = erLhcoreClassDesign::baseurl('instance/billinginstance');
	$pagesInstances->setItemsPerPage(20);
	$pagesInstances->paginate();
	
	$tpl->set('pagesInstance',$pagesInstances);
	
	$items = array();
	if ($pagesInstances->items_total > 0) {
		$items = erLhcoreClassModelInstance::getList(array('switch_db' => true,'filter' => array('reseller_id' => $instance->id),'offset' => $pagesInstances->low, 'limit' => $pagesInstances->items_per_page));
	}
	
	$tpl->set('itemsInstance',$items);
}

$Result['content'] = $tpl->fetch();
$Result['path'] = array(array('title' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Billing')));

?>