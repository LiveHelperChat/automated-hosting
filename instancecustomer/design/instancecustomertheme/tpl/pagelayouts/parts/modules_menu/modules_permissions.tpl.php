<?php 
	$useQuestionary = $currentUser->hasAccessTo('lhquestionary','manage_questionary') && erLhcoreClassInstance::getInstance()->questionnaire_supported == 1;
	$useFaq = $currentUser->hasAccessTo('lhfaq','manage_faq') && erLhcoreClassInstance::getInstance()->faq_supported == 1;
	$useChatbox = $currentUser->hasAccessTo('lhchatbox','manage_chatbox') && erLhcoreClassInstance::getInstance()->chatbox_supported == 1;
	$useBo = $currentUser->hasAccessTo('lhbrowseoffer','manage_bo') && erLhcoreClassInstance::getInstance()->browseoffers_supported == 1;
	$useFm = $currentUser->hasAccessTo('lhform','manage_fm') && erLhcoreClassInstance::getInstance()->forms_supported == 1;
?>