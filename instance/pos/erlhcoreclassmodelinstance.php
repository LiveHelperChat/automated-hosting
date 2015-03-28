<?php

$def = new ezcPersistentObjectDefinition();
$def->table = "lhc_instance_client";
$def->class = "erLhcoreClassModelInstance";

$def->idProperty = new ezcPersistentObjectIdProperty();
$def->idProperty->columnName = 'id';
$def->idProperty->propertyName = 'id';
$def->idProperty->generator = new ezcPersistentGeneratorDefinition(  'ezcPersistentNativeGenerator' );

$def->properties['request'] = new ezcPersistentObjectProperty();
$def->properties['request']->columnName   = 'request';
$def->properties['request']->propertyName = 'request';
$def->properties['request']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['expires'] = new ezcPersistentObjectProperty();
$def->properties['expires']->columnName   = 'expires';
$def->properties['expires']->propertyName = 'expires';
$def->properties['expires']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['address'] = new ezcPersistentObjectProperty();
$def->properties['address']->columnName   = 'address';
$def->properties['address']->propertyName = 'address';
$def->properties['address']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['email'] = new ezcPersistentObjectProperty();
$def->properties['email']->columnName   = 'email';
$def->properties['email']->propertyName = 'email';
$def->properties['email']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['client_title'] = new ezcPersistentObjectProperty();
$def->properties['client_title']->columnName   = 'client_title';
$def->properties['client_title']->propertyName = 'client_title';
$def->properties['client_title']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['status'] = new ezcPersistentObjectProperty();
$def->properties['status']->columnName   = 'status';
$def->properties['status']->propertyName = 'status';
$def->properties['status']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['time_zone'] = new ezcPersistentObjectProperty();
$def->properties['time_zone']->columnName   = 'time_zone';
$def->properties['time_zone']->propertyName = 'time_zone';
$def->properties['time_zone']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['date_format'] = new ezcPersistentObjectProperty();
$def->properties['date_format']->columnName   = 'date_format';
$def->properties['date_format']->propertyName = 'date_format';
$def->properties['date_format']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['date_hour_format'] = new ezcPersistentObjectProperty();
$def->properties['date_hour_format']->columnName   = 'date_hour_format';
$def->properties['date_hour_format']->propertyName = 'date_hour_format';
$def->properties['date_hour_format']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['date_date_hour_format'] = new ezcPersistentObjectProperty();
$def->properties['date_date_hour_format']->columnName   = 'date_date_hour_format';
$def->properties['date_date_hour_format']->propertyName = 'date_date_hour_format';
$def->properties['date_date_hour_format']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['suspended'] = new ezcPersistentObjectProperty();
$def->properties['suspended']->columnName   = 'suspended';
$def->properties['suspended']->propertyName = 'suspended';
$def->properties['suspended']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['terminate'] = new ezcPersistentObjectProperty();
$def->properties['terminate']->columnName   = 'terminate';
$def->properties['terminate']->propertyName = 'terminate';
$def->properties['terminate']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

/**
 * Default back office user language
 * */
$def->properties['locale'] = new ezcPersistentObjectProperty();
$def->properties['locale']->columnName   = 'locale';
$def->properties['locale']->propertyName = 'locale';
$def->properties['locale']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

/**
 * Default frontend site siteaccess
 * */
$def->properties['siteaccess'] = new ezcPersistentObjectProperty();
$def->properties['siteaccess']->columnName   = 'siteaccess';
$def->properties['siteaccess']->propertyName = 'siteaccess';
$def->properties['siteaccess']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['is_reseller'] = new ezcPersistentObjectProperty();
$def->properties['is_reseller']->columnName   = 'is_reseller';
$def->properties['is_reseller']->propertyName = 'is_reseller';
$def->properties['is_reseller']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['reseller_tite'] = new ezcPersistentObjectProperty();
$def->properties['reseller_tite']->columnName   = 'reseller_tite';
$def->properties['reseller_tite']->propertyName = 'reseller_tite';
$def->properties['reseller_tite']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

/**
 * Max number of request instance can have at reseller
 * */
$def->properties['reseller_max_instance_request'] = new ezcPersistentObjectProperty();
$def->properties['reseller_max_instance_request']->columnName   = 'reseller_max_instance_request';
$def->properties['reseller_max_instance_request']->propertyName = 'reseller_max_instance_request';
$def->properties['reseller_max_instance_request']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

/**
 * How many request reseller has to sell
 * */
$def->properties['reseller_request'] = new ezcPersistentObjectProperty();
$def->properties['reseller_request']->columnName   = 'reseller_request';
$def->properties['reseller_request']->propertyName = 'reseller_request';
$def->properties['reseller_request']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['reseller_secret_hash'] = new ezcPersistentObjectProperty();
$def->properties['reseller_secret_hash']->columnName   = 'reseller_secret_hash';
$def->properties['reseller_secret_hash']->propertyName = 'reseller_secret_hash';
$def->properties['reseller_secret_hash']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['reseller_max_instances'] = new ezcPersistentObjectProperty();
$def->properties['reseller_max_instances']->columnName   = 'reseller_max_instances';
$def->properties['reseller_max_instances']->propertyName = 'reseller_max_instances';
$def->properties['reseller_max_instances']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['reseller_id'] = new ezcPersistentObjectProperty();
$def->properties['reseller_id']->columnName   = 'reseller_id';
$def->properties['reseller_id']->propertyName = 'reseller_id';
$def->properties['reseller_id']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['reseller_suspended'] = new ezcPersistentObjectProperty();
$def->properties['reseller_suspended']->columnName   = 'reseller_suspended';
$def->properties['reseller_suspended']->propertyName = 'reseller_suspended';
$def->properties['reseller_suspended']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['files_supported'] = new ezcPersistentObjectProperty();
$def->properties['files_supported']->columnName   = 'files_supported';
$def->properties['files_supported']->propertyName = 'files_supported';
$def->properties['files_supported']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['atranslations_supported'] = new ezcPersistentObjectProperty();
$def->properties['atranslations_supported']->columnName   = 'atranslations_supported';
$def->properties['atranslations_supported']->propertyName = 'atranslations_supported';
$def->properties['atranslations_supported']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['cobrowse_supported'] = new ezcPersistentObjectProperty();
$def->properties['cobrowse_supported']->columnName   = 'cobrowse_supported';
$def->properties['cobrowse_supported']->propertyName = 'cobrowse_supported';
$def->properties['cobrowse_supported']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['forms_supported'] = new ezcPersistentObjectProperty();
$def->properties['forms_supported']->columnName   = 'forms_supported';
$def->properties['forms_supported']->propertyName = 'forms_supported';
$def->properties['forms_supported']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['forms_supported'] = new ezcPersistentObjectProperty();
$def->properties['forms_supported']->columnName   = 'forms_supported';
$def->properties['forms_supported']->propertyName = 'forms_supported';
$def->properties['forms_supported']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['cannedmsg_supported'] = new ezcPersistentObjectProperty();
$def->properties['cannedmsg_supported']->columnName   = 'cannedmsg_supported';
$def->properties['cannedmsg_supported']->propertyName = 'cannedmsg_supported';
$def->properties['cannedmsg_supported']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['faq_supported'] = new ezcPersistentObjectProperty();
$def->properties['faq_supported']->columnName   = 'faq_supported';
$def->properties['faq_supported']->propertyName = 'faq_supported';
$def->properties['faq_supported']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['screenshot_supported'] = new ezcPersistentObjectProperty();
$def->properties['screenshot_supported']->columnName   = 'screenshot_supported';
$def->properties['screenshot_supported']->propertyName = 'screenshot_supported';
$def->properties['screenshot_supported']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['proactive_supported'] = new ezcPersistentObjectProperty();
$def->properties['proactive_supported']->columnName   = 'proactive_supported';
$def->properties['proactive_supported']->propertyName = 'proactive_supported';
$def->properties['proactive_supported']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['questionnaire_supported'] = new ezcPersistentObjectProperty();
$def->properties['questionnaire_supported']->columnName   = 'questionnaire_supported';
$def->properties['questionnaire_supported']->propertyName = 'questionnaire_supported';
$def->properties['questionnaire_supported']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['browseoffers_supported'] = new ezcPersistentObjectProperty();
$def->properties['browseoffers_supported']->columnName   = 'browseoffers_supported';
$def->properties['browseoffers_supported']->propertyName = 'browseoffers_supported';
$def->properties['browseoffers_supported']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['chatbox_supported'] = new ezcPersistentObjectProperty();
$def->properties['chatbox_supported']->columnName   = 'chatbox_supported';
$def->properties['chatbox_supported']->propertyName = 'chatbox_supported';
$def->properties['chatbox_supported']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['reporting_supported'] = new ezcPersistentObjectProperty();
$def->properties['reporting_supported']->columnName   = 'reporting_supported';
$def->properties['reporting_supported']->propertyName = 'reporting_supported';
$def->properties['reporting_supported']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['blocked_supported'] = new ezcPersistentObjectProperty();
$def->properties['blocked_supported']->columnName   = 'blocked_supported';
$def->properties['blocked_supported']->propertyName = 'blocked_supported';
$def->properties['blocked_supported']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['previouschats_supported'] = new ezcPersistentObjectProperty();
$def->properties['previouschats_supported']->columnName   = 'previouschats_supported';
$def->properties['previouschats_supported']->propertyName = 'previouschats_supported';
$def->properties['previouschats_supported']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['chatremarks_supported'] = new ezcPersistentObjectProperty();
$def->properties['chatremarks_supported']->columnName   = 'chatremarks_supported';
$def->properties['chatremarks_supported']->propertyName = 'chatremarks_supported';
$def->properties['chatremarks_supported']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['autoresponder_supported'] = new ezcPersistentObjectProperty();
$def->properties['autoresponder_supported']->columnName   = 'autoresponder_supported';
$def->properties['autoresponder_supported']->propertyName = 'autoresponder_supported';
$def->properties['autoresponder_supported']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['geoadjustment_supported'] = new ezcPersistentObjectProperty();
$def->properties['geoadjustment_supported']->columnName   = 'geoadjustment_supported';
$def->properties['geoadjustment_supported']->propertyName = 'geoadjustment_supported';
$def->properties['geoadjustment_supported']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['onlinevisitortrck_supported'] = new ezcPersistentObjectProperty();
$def->properties['onlinevisitortrck_supported']->columnName   = 'onlinevisitortrck_supported';
$def->properties['onlinevisitortrck_supported']->propertyName = 'onlinevisitortrck_supported';
$def->properties['onlinevisitortrck_supported']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

/**
 * For customer custom features
 * */
$def->properties['feature_1_supported'] = new ezcPersistentObjectProperty();
$def->properties['feature_1_supported']->columnName   = 'feature_1_supported';
$def->properties['feature_1_supported']->propertyName = 'feature_1_supported';
$def->properties['feature_1_supported']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['feature_2_supported'] = new ezcPersistentObjectProperty();
$def->properties['feature_2_supported']->columnName   = 'feature_2_supported';
$def->properties['feature_2_supported']->propertyName = 'feature_2_supported';
$def->properties['feature_2_supported']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['feature_3_supported'] = new ezcPersistentObjectProperty();
$def->properties['feature_3_supported']->columnName   = 'feature_3_supported';
$def->properties['feature_3_supported']->propertyName = 'feature_3_supported';
$def->properties['feature_3_supported']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;


/**
 * For customer custom extensions storage in instance
 * */
$def->properties['custom_fields_1'] = new ezcPersistentObjectProperty();
$def->properties['custom_fields_1']->columnName   = 'custom_fields_1';
$def->properties['custom_fields_1']->propertyName = 'custom_fields_1';
$def->properties['custom_fields_1']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['custom_fields_2'] = new ezcPersistentObjectProperty();
$def->properties['custom_fields_2']->columnName   = 'custom_fields_2';
$def->properties['custom_fields_2']->propertyName = 'custom_fields_2';
$def->properties['custom_fields_2']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['custom_fields_3'] = new ezcPersistentObjectProperty();
$def->properties['custom_fields_3']->columnName   = 'custom_fields_3';
$def->properties['custom_fields_3']->propertyName = 'custom_fields_3';
$def->properties['custom_fields_3']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;


// Phone attributes, can be used by SMS extension for automated hosting
$def->properties['phone_number'] = new ezcPersistentObjectProperty();
$def->properties['phone_number']->columnName   = 'phone_number';
$def->properties['phone_number']->propertyName = 'phone_number';
$def->properties['phone_number']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['sms_left'] = new ezcPersistentObjectProperty();
$def->properties['sms_left']->columnName   = 'sms_left';
$def->properties['sms_left']->propertyName = 'sms_left';
$def->properties['sms_left']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['sms_plan'] = new ezcPersistentObjectProperty();
$def->properties['sms_plan']->columnName   = 'sms_plan';
$def->properties['sms_plan']->propertyName = 'sms_plan';
$def->properties['sms_plan']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['soft_limit_type'] = new ezcPersistentObjectProperty();
$def->properties['soft_limit_type']->columnName   = 'soft_limit_type';
$def->properties['soft_limit_type']->propertyName = 'soft_limit_type';
$def->properties['soft_limit_type']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['soft_limit'] = new ezcPersistentObjectProperty();
$def->properties['soft_limit']->columnName   = 'soft_limit';
$def->properties['soft_limit']->propertyName = 'soft_limit';
$def->properties['soft_limit']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['hard_limit_type'] = new ezcPersistentObjectProperty();
$def->properties['hard_limit_type']->columnName   = 'hard_limit_type';
$def->properties['hard_limit_type']->propertyName = 'hard_limit_type';
$def->properties['hard_limit_type']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['hard_limit'] = new ezcPersistentObjectProperty();
$def->properties['hard_limit']->columnName   = 'hard_limit';
$def->properties['hard_limit']->propertyName = 'hard_limit';
$def->properties['hard_limit']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['sms_processed'] = new ezcPersistentObjectProperty();
$def->properties['sms_processed']->columnName   = 'sms_processed';
$def->properties['sms_processed']->propertyName = 'sms_processed';
$def->properties['sms_processed']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['sms_supported'] = new ezcPersistentObjectProperty();
$def->properties['sms_supported']->columnName   = 'sms_supported';
$def->properties['sms_supported']->propertyName = 'sms_supported';
$def->properties['sms_supported']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['soft_warning_send'] = new ezcPersistentObjectProperty();
$def->properties['soft_warning_send']->columnName   = 'soft_warning_send';
$def->properties['soft_warning_send']->propertyName = 'soft_warning_send';
$def->properties['soft_warning_send']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['hard_warning_send'] = new ezcPersistentObjectProperty();
$def->properties['hard_warning_send']->columnName   = 'hard_warning_send';
$def->properties['hard_warning_send']->propertyName = 'hard_warning_send';
$def->properties['hard_warning_send']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['phone_default_department'] = new ezcPersistentObjectProperty();
$def->properties['phone_default_department']->columnName   = 'phone_default_department';
$def->properties['phone_default_department']->propertyName = 'phone_default_department';
$def->properties['phone_default_department']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['footprint_supported'] = new ezcPersistentObjectProperty();
$def->properties['footprint_supported']->columnName   = 'footprint_supported';
$def->properties['footprint_supported']->propertyName = 'footprint_supported';
$def->properties['footprint_supported']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['chat_supported'] = new ezcPersistentObjectProperty();
$def->properties['chat_supported']->columnName   = 'chat_supported';
$def->properties['chat_supported']->propertyName = 'chat_supported';
$def->properties['chat_supported']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

return $def;

?>