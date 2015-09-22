<?php
$tpl = erLhcoreClassTemplate::getInstance('lhinstance/new.tpl.php');
$Instance = new erLhcoreClassModelInstance();

// Allow extensions to setup default attributes
erLhcoreClassChatEventDispatcher::getInstance()->dispatch('instance.new_instance', array(
    'instance' => & $Instance
));

$cfgSite = erConfigClassLhConfig::getInstance();
$tpl->set('locales', $cfgSite->getSetting('site', 'available_site_access'));

if (isset($_POST['Cancel_departament'])) {
    erLhcoreClassModule::redirect('instance/list');
    exit();
}

$modules = array(
    'reporting_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Statistic supported'),
    'atranslations_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Automatic translations supported'),
    'cobrowse_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Co-Browse supported'),
    'cobrowse_forms_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Co-Browse forms filling supported'),
    'forms_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Forms supported'),
    'cannedmsg_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Canned messages supported'),
    'faq_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'FAQ supported'),
    'reporting_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Reporting supported'),
    'chatbox_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Chatbox supported'),
    'browseoffers_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Browse offers supported'),
    'questionnaire_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Questionnaire supported'),
    'proactive_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Proactive supported'),
    'screenshot_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Screenshot supported'),
    'blocked_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'User blocking supported'),
    'files_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Files supported'),
    'sms_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'SMS chat supported'),
    'onlinevisitortrck_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Online visitors list supported'),
    'geoadjustment_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'GEO adjustment supporte'),
    'chatremarks_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Chat notes supported'),
    'autoresponder_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Autoresponder supported'),
    'previouschats_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Previous chats supported'),
    'footprint_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Footprint supported'),
    'chat_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Chat supported'),
    'speech_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Speech supported'),
    'transfer_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Chat transfer supported'),
    'operatorschat_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Chat between operators supported'),
    'xmpp_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'XMPP supported'),
    'offline_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Offline supported'),
    'sugarcrm_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'SugarCRM supported'),
    'full_xmpp_chat_supported' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Full XMPP chat supported'),
    'full_xmpp_visitors_tracking' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Track online visitors in XMPP')
);

erLhcoreClassChatEventDispatcher::getInstance()->dispatch('instance.features_titles', array(
    'features' => & $modules
));

$tpl->set('modules_features', $modules);

if (isset($_POST['Save_departament'])) {
    $definition = array(
        'Address' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'),
        'Email' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'validate_email'),
        'Request' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'string'),
        'RequestUsed' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'int'),
        'Status' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'int', array(
            'min_range' => 0
        )),
        'Expires' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'string'),
        'DateFormat' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'string'),
        'DateHourFormat' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'string'),
        'DateAndHourFormat' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'string'),
        'UserTimeZone' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'string'),
        'FrontSiteaccess' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'string'),
        'Language' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'string'),
        'UserTimeZone' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'string'),
        'ResellerTitle' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'string'),
        'ResellerMaxRequest' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'string'),
        'ResellerMaxInstance' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'string'),
        'ResellerSecretHash' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'string'),
        'ResellerRequest' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'string'),
        'Reseller' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'files_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'atranslations_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'cobrowse_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'forms_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'cannedmsg_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'faq_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'feature_1_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'feature_2_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'feature_3_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'reporting_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'chatbox_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'browseoffers_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'questionnaire_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'proactive_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'screenshot_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'blocked_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'footprint_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'previouschats_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'autoresponder_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'chatremarks_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'geoadjustment_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'onlinevisitortrck_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'speech_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'transfer_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'operatorschat_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'chat_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'xmpp_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'offline_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'sugarcrm_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'cobrowse_forms_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'AttrInt1' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'int'),
        'AttrInt2' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'int'),
        'AttrInt3' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'int'),
        'max_operators' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'int'),
        'one_per_account' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'full_xmpp_chat_supported' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean'),
        'full_xmpp_visitors_tracking' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'boolean')
    );
    
    $form = new ezcInputForm(INPUT_POST, $definition);
    $Errors = array();
    
    if ($form->hasValidData('speech_supported') && $form->speech_supported == true) {
        $Instance->speech_supported = 1;
    } else {
        $Instance->speech_supported = 0;
    }
    
    if ($form->hasValidData('one_per_account') && $form->one_per_account == true) {
        $Instance->one_per_account = 1;
    } else {
        $Instance->one_per_account = 0;
    }
    
    if ($form->hasValidData('full_xmpp_chat_supported') && $form->full_xmpp_chat_supported == true) {
        $Instance->full_xmpp_chat_supported = 1;
    } else {
        $Instance->full_xmpp_chat_supported = 0;
    }
    
    if ($form->hasValidData('full_xmpp_visitors_tracking') && $form->full_xmpp_visitors_tracking == true) {
        $Instance->full_xmpp_visitors_tracking = 1;
    } else {
        $Instance->full_xmpp_visitors_tracking = 0;
    }
    
    if ($form->hasValidData('max_operators')) {
        $Instance->max_operators = $form->max_operators;
    } else {
        $Instance->max_operators = 0;
    }
    
    if ($form->hasValidData('cobrowse_forms_supported') && $form->cobrowse_forms_supported == true) {
        $Instance->cobrowse_forms_supported = 1;
    } else {
        $Instance->cobrowse_forms_supported = 0;
    }
    
    if ($form->hasValidData('sugarcrm_supported') && $form->sugarcrm_supported == true) {
        $Instance->sugarcrm_supported = 1;
    } else {
        $Instance->sugarcrm_supported = 0;
    }
    
    if ($form->hasValidData('chat_supported') && $form->chat_supported == true) {
        $Instance->chat_supported = 1;
    } else {
        $Instance->chat_supported = 0;
    }
    
    if ($form->hasValidData('AttrInt1')) {
        $Instance->attr_int_1 = $form->AttrInt1;
    }
    
    if ($form->hasValidData('AttrInt2')) {
        $Instance->attr_int_2 = $form->AttrInt2;
    }
    
    if ($form->hasValidData('AttrInt3')) {
        $Instance->attr_int_3 = $form->AttrInt3;
    }
    
    if ($form->hasValidData('xmpp_supported') && $form->xmpp_supported == true) {
        $Instance->xmpp_supported = 1;
    } else {
        $Instance->xmpp_supported = 0;
    }
    
    if ($form->hasValidData('offline_supported') && $form->offline_supported == true) {
        $Instance->offline_supported = 1;
    } else {
        $Instance->offline_supported = 0;
    }
    
    if ($form->hasValidData('transfer_supported') && $form->transfer_supported == true) {
        $Instance->transfer_supported = 1;
    } else {
        $Instance->transfer_supported = 0;
    }
    
    if ($form->hasValidData('operatorschat_supported') && $form->operatorschat_supported == true) {
        $Instance->operatorschat_supported = 1;
    } else {
        $Instance->operatorschat_supported = 0;
    }
    
    if ($form->hasValidData('ResellerTitle')) {
        $Instance->reseller_tite = $form->ResellerTitle;
    }
    
    if ($form->hasValidData('ResellerMaxRequest')) {
        $Instance->reseller_max_instance_request = $form->ResellerMaxRequest;
    }
    
    if ($form->hasValidData('reporting_supported') && $form->reporting_supported == true) {
        $Instance->reporting_supported = 1;
    } else {
        $Instance->reporting_supported = 0;
    }
    
    if ($form->hasValidData('previouschats_supported') && $form->previouschats_supported == true) {
        $Instance->previouschats_supported = 1;
    } else {
        $Instance->previouschats_supported = 0;
    }
    
    if ($form->hasValidData('geoadjustment_supported') && $form->geoadjustment_supported == true) {
        $Instance->geoadjustment_supported = 1;
    } else {
        $Instance->geoadjustment_supported = 0;
    }
    
    if ($form->hasValidData('onlinevisitortrck_supported') && $form->onlinevisitortrck_supported == true) {
        $Instance->onlinevisitortrck_supported = 1;
    } else {
        $Instance->onlinevisitortrck_supported = 0;
    }
    
    if ($form->hasValidData('chatremarks_supported') && $form->chatremarks_supported == true) {
        $Instance->chatremarks_supported = 1;
    } else {
        $Instance->chatremarks_supported = 0;
    }
    
    if ($form->hasValidData('autoresponder_supported') && $form->autoresponder_supported == true) {
        $Instance->autoresponder_supported = 1;
    } else {
        $Instance->autoresponder_supported = 0;
    }
    
    if ($form->hasValidData('chatbox_supported') && $form->chatbox_supported == true) {
        $Instance->chatbox_supported = 1;
    } else {
        $Instance->chatbox_supported = 0;
    }
    
    if ($form->hasValidData('footprint_supported') && $form->footprint_supported == true) {
        $Instance->footprint_supported = 1;
    } else {
        $Instance->footprint_supported = 0;
    }
    
    if ($form->hasValidData('browseoffers_supported') && $form->browseoffers_supported == true) {
        $Instance->browseoffers_supported = 1;
    } else {
        $Instance->browseoffers_supported = 0;
    }
    
    if ($form->hasValidData('questionnaire_supported') && $form->questionnaire_supported == true) {
        $Instance->questionnaire_supported = 1;
    } else {
        $Instance->questionnaire_supported = 0;
    }
    
    if ($form->hasValidData('proactive_supported') && $form->proactive_supported == true) {
        $Instance->proactive_supported = 1;
    } else {
        $Instance->proactive_supported = 0;
    }
    
    if ($form->hasValidData('blocked_supported') && $form->blocked_supported == true) {
        $Instance->blocked_supported = 1;
    } else {
        $Instance->blocked_supported = 0;
    }
    
    if ($form->hasValidData('screenshot_supported') && $form->screenshot_supported == true) {
        $Instance->screenshot_supported = 1;
    } else {
        $Instance->screenshot_supported = 0;
    }
    
    if ($form->hasValidData('files_supported') && $form->files_supported == true) {
        $Instance->files_supported = 1;
    } else {
        $Instance->files_supported = 0;
    }
    
    if ($form->hasValidData('forms_supported') && $form->forms_supported == true) {
        $Instance->forms_supported = 1;
    } else {
        $Instance->forms_supported = 0;
    }
    
    if ($form->hasValidData('atranslations_supported') && $form->atranslations_supported == true) {
        $Instance->atranslations_supported = 1;
    } else {
        $Instance->atranslations_supported = 0;
    }
    
    if ($form->hasValidData('cannedmsg_supported') && $form->cannedmsg_supported == true) {
        $Instance->cannedmsg_supported = 1;
    } else {
        $Instance->cannedmsg_supported = 0;
    }
    
    if ($form->hasValidData('faq_supported') && $form->faq_supported == true) {
        $Instance->faq_supported = 1;
    } else {
        $Instance->faq_supported = 0;
    }
    
    if ($form->hasValidData('cobrowse_supported') && $form->cobrowse_supported == true) {
        $Instance->cobrowse_supported = 1;
    } else {
        $Instance->cobrowse_supported = 0;
    }
    
    if ($form->hasValidData('feature_1_supported') && $form->feature_1_supported == true) {
        $Instance->feature_1_supported = 1;
    } else {
        $Instance->feature_1_supported = 0;
    }
    
    if ($form->hasValidData('feature_2_supported') && $form->feature_2_supported == true) {
        $Instance->feature_2_supported = 1;
    } else {
        $Instance->feature_2_supported = 0;
    }
    
    if ($form->hasValidData('feature_3_supported') && $form->feature_3_supported == true) {
        $Instance->feature_3_supported = 1;
    } else {
        $Instance->feature_3_supported = 0;
    }
    
    if ($form->hasValidData('ResellerMaxInstance')) {
        $Instance->reseller_max_instances = $form->ResellerMaxInstance;
    }
    
    if ($form->hasValidData('ResellerSecretHash')) {
        $Instance->reseller_secret_hash = $form->ResellerSecretHash;
    }
    
    if ($form->hasValidData('ResellerRequest')) {
        $Instance->reseller_request = $form->ResellerRequest;
    }
    
    if ($form->hasValidData('Reseller') && $form->Reseller == true) {
        $Instance->is_reseller = $form->Reseller;
    }
    
    if ($form->hasValidData('Language')) {
        $Instance->locale = $form->Language;
    }
    
    if ($form->hasValidData('DateFormat')) {
        $Instance->date_format = $form->DateFormat;
    }
    
    if ($form->hasValidData('DateHourFormat')) {
        $Instance->date_hour_format = $form->DateHourFormat;
    }
    
    if ($form->hasValidData('DateAndHourFormat')) {
        $Instance->date_date_hour_format = $form->DateAndHourFormat;
    }
    
    if ($form->hasValidData('UserTimeZone')) {
        $Instance->time_zone = $form->UserTimeZone;
    }
    
    if ($form->hasValidData('FrontSiteaccess')) {
        $Instance->siteaccess = $form->FrontSiteaccess;
    }
    
    if ($form->hasValidData('Address') && erLhcoreClassInstance::instanceExists($form->Address) == false) {
        $Instance->address = $form->Address;
    } else {
        $Errors[] = 'Instance exists';
    }
    
    if ($form->hasValidData('Email')) {
        $Instance->email = $form->Email;
    } else {
        $Errors[] = 'Please enter valid e-mail';
    }
    
    if ($form->hasValidData('Request')) {
        $Instance->request = $form->Request;
    }
    
    if ($form->hasValidData('RequestUsed')) {
        $Instance->request_used = $form->RequestUsed;
    }
    
    if ($form->hasValidData('Status')) {
        $Instance->status = $form->Status;
    }
    
    if (! isset($_POST['csfr_token']) || ! $currentUser->validateCSFRToken($_POST['csfr_token'])) {
        erLhcoreClassModule::redirect('instance/list');
        exit();
    }
    
    if ($form->hasValidData('Expires') && ($time = strtotime($form->Expires)) !== false) {
        $Instance->expires = $time;
    } elseif ($form->hasValidData('Expires') && $form->Expires == 0) {
        $Instance->expires = 0;
    } else {
        $Errors[] = 'Please enter valid date';
    }
    
    if (count($Errors) == 0) {
        $Instance->saveThis();
        erLhcoreClassModule::redirect('instance/list');
        exit();
    } else {
        $tpl->set('errors', $Errors);
    }
}

$tpl->set('instance', $Instance);

$Result['content'] = $tpl->fetch();

$Result['path'] = array(
    array(
        'url' => erLhcoreClassDesign::baseurl('system/configuration'),
        'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('department/new', 'System configuration')
    ),
    array(
        'url' => erLhcoreClassDesign::baseurl('instance/list'),
        'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Instances')
    ),
    array(
        'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'New instance')
    )
);

?>