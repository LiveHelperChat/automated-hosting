<?php $system_configuration_tabs_chat_enabled = 
erLhcoreClassInstance::getInstance()->chat_supported == 1 || 
erLhcoreClassInstance::getInstance()->chatbox_supported == 1 ||
erLhcoreClassInstance::getInstance()->faq_supported == 1 ||
erLhcoreClassInstance::getInstance()->questionnaire_supported == 1 
;?>