<?php 

class erLhcoreClassExtensionInstancecustomer {

	public function __construct() {
		
	}
	
	public function run(){		
		
		$dispatcher = erLhcoreClassChatEventDispatcher::getInstance();
		
		// Attatch event listeners
		$dispatcher->listen('user.edit.photo_path',array($this,'userEditPhotoPath'));
				
		$dispatcher->listen('chat.getstatus',array($this,'getStatus'));
		$dispatcher->listen('file.storescreenshot.screenshot_path',array($this,'screenshotPath'));
		$dispatcher->listen('file.uploadfile.file_path',array($this,'screenshotPath'));
		$dispatcher->listen('file.uploadfileadmin.file_path',array($this,'screenshotPath'));
		$dispatcher->listen('file.new.file_path',array($this,'newFilePath'));
		
		// Themes listeners
		$dispatcher->listen('theme.edit.logo_image_path',array($this,'themeStoragePath'));
		$dispatcher->listen('theme.edit.need_help_image_path',array($this,'themeStoragePath'));	
		$dispatcher->listen('theme.edit.offline_image_path',array($this,'themeStoragePath'));
		$dispatcher->listen('theme.edit.online_image_path',array($this,'themeStoragePath'));
		$dispatcher->listen('theme.edit.copyright_image_path',array($this,'themeStoragePath'));
		$dispatcher->listen('theme.edit.operator_image_path',array($this,'themeStoragePath'));
		$dispatcher->listen('theme.edit.popup_image_path',array($this,'themeStoragePath'));
		$dispatcher->listen('theme.edit.close_image_path',array($this,'themeStoragePath'));
		$dispatcher->listen('theme.edit.restore_image_path',array($this,'themeStoragePath'));
		$dispatcher->listen('theme.edit.minimize_image_path',array($this,'themeStoragePath'));
		
		// Permissions
		$dispatcher->listen('feature.can_use_forms',array($this,'canUseForms'));
		$dispatcher->listen('form.index',array($this,'canUseForms'));
		$dispatcher->listen('form.embedcode',array($this,'canUseForms'));
		
		// Canned messages
		$dispatcher->listen('chat.cannedmsg',array($this,'canUseCannedMessages'));
		$dispatcher->listen('chat.newcannedmsg',array($this,'canUseCannedMessages'));
		
		// FAQ
		$dispatcher->listen('faq.list',array($this,'canUseFAQ'));
		$dispatcher->listen('faq.view',array($this,'canUseFAQ'));
		
		// Browse offers
		$dispatcher->listen('browseoffer.index',array($this,'canUseBO'));
		$dispatcher->listen('browseoffer.htmlcode',array($this,'canUseBO'));
		$dispatcher->listen('feature.can_use_browse_offers',array($this,'canUseBO'));
		
		// Questionary
		$dispatcher->listen('questionary.edit',array($this,'canUseQuestionary'));
		$dispatcher->listen('questionary.list',array($this,'canUseQuestionary'));
		$dispatcher->listen('questionary.new',array($this,'canUseQuestionary'));
		
		// Chatbox
		$dispatcher->listen('chatbox.list',array($this,'canUseChatbox'));
		$dispatcher->listen('chatbox.configuration',array($this,'canUseChatbox'));
				
		// Statistic
		$dispatcher->listen('chat.statistic',array($this,'canUseStatistic'));
		
		// Pro active
		$dispatcher->listen('feature.can_use_proactive',array($this,'canUseProactive'));
		
		// Auto responder
		$dispatcher->listen('feature.can_use_autoresponder',array($this,'canUseAutoresponder'));
		
		$dispatcher->listen('chat.geoadjustment',array($this,'canUseGeoAdjustment'));
		
		// Block users
		$dispatcher->listen('chat.blockedusers',array($this,'canUseBlock'));

		// Automated hosting overrides mail sending parameters
		$dispatcher->listen('chatmail.setup_smtp',array($this,'setupSMTP'));
		
		// temporary path
		$dispatcher->listen('theme.temppath',array($this,'tempStoragePath'));
		
		// Disable database variables cache
		$dispatcher->listen('tpl.new',array($this,'changeTemplateSettings'));
		
		// Forms module listener
		$dispatcher->listen('form.fill.file_path',array($this,'formFillPath'));
		
		erLhcoreClassModule::$cacheDbVariables = false;
		
		// Disable cache expire for customers, only through command line possible
		erConfigClassLhCacheConfig::getInstance()->setExpiredInRuntime(true);
		
		$instanceCustomer = erLhcoreClassInstance::getInstance();
				
		erLhcoreClassModule::$defaultTimeZone = $instanceCustomer->time_zone;
		erLhcoreClassModule::$dateFormat = $instanceCustomer->date_format;
		erLhcoreClassModule::$dateHourFormat = $instanceCustomer->date_hour_format;
		erLhcoreClassModule::$dateDateHourFormat = $instanceCustomer->date_date_hour_format;

		
		$cfgSite = erConfigClassLhConfig::getInstance();
		$sysConfiguration = erLhcoreClassSystem::instance();
		$defaultSiteAccess = $cfgSite->getSetting( 'site', 'default_site_access' );
				
		// Perhaps we need to change default siteaccess
		if (
			$sysConfiguration->SiteAccess != 'site_admin' && 		// Change only if it's not admin
			$sysConfiguration->SiteAccess == $defaultSiteAccess &&  // Change only if current siteaccess is the default siteaccess we want to change
			!isset($_POST['switchLang']) && 						// Change only if customer is not doing anything
			$instanceCustomer->siteaccess != ''	&&					// Change only if it's filled
			$instanceCustomer->siteaccess != $sysConfiguration->SiteAccess	// Change only if it's different
		) {						
			$optionsSiteAccessOverride = $cfgSite->getSetting('site_access_options',$instanceCustomer->siteaccess);
			$sysConfiguration->Language = $optionsSiteAccessOverride['locale'];
			$sysConfiguration->SiteAccess = $instanceCustomer->siteaccess;
			$sysConfiguration->ContentLanguage = $optionsSiteAccessOverride['content_language'];
			$sysConfiguration->ThemeSite = $optionsSiteAccessOverride['theme'];
			
			if ($defaultSiteAccess != $sysConfiguration->SiteAccess) {
				$sysConfiguration->WWWDirLang = '/'.$sysConfiguration->SiteAccess;
			}
		}		
	}
	
	public function setupSMTP($params) {
	    $params['phpmailer']->Sender = erConfigClassLhConfig::getInstance()->getSetting('site','sender_mail');
	    $params['phpmailer']->From = erConfigClassLhConfig::getInstance()->getSetting('site','seller_mail');
	    $params['phpmailer']->FromName =  erConfigClassLhConfig::getInstance()->getSetting('site','seller_title');
	    return array('status' => erLhcoreClassChatEventDispatcher::STOP_WORKFLOW);
	}
	
	public function canUseStatistic()
	{
	    if (erLhcoreClassInstance::getInstance()->reporting_supported == 0) {
	        // No permission to use statistic
	        die('You do not have permission to use statistic');
	    }
	}
	
	public function canUseBlock()
	{
	    if (erLhcoreClassInstance::getInstance()->blocked_supported == 0) {
	        // No permission to use statistic
	        die('You do not have permission to block users');
	    }
	}
	
	public function canUseAutoresponder()
	{
	    if (erLhcoreClassInstance::getInstance()->autoresponder_supported == 0) {
	        // No permission to use statistic
	        die('You do not have permission to use Autoresponder');
	    }
	}
	
	public function canUseForms()
	{
	    if (erLhcoreClassInstance::getInstance()->forms_supported == 0) {
	        // No permission to use forms, just exist
	        die('You do not have permission to use forms');
	    }
	}
	
	public function canUseCannedMessages()
	{
	    if (erLhcoreClassInstance::getInstance()->cannedmsg_supported == 0) {
	        // No permission to use forms, just exist
	        die('You do not have permission to use canned messages');
	    }
	}
	
	public function canUseQuestionary()
	{
	    if (erLhcoreClassInstance::getInstance()->questionnaire_supported == 0) {
	        // No permission to use forms, just exist
	        die('You do not have permission to use questionary');
	    }
	}
	
	public function canUseFAQ()
	{
	    if (erLhcoreClassInstance::getInstance()->faq_supported == 0) {
	        // No permission to use forms, just exist
	        die('You do not have permission to use FAQ');
	    }
	}
	
	public function canUseGeoAdjustment()
	{
	    if (erLhcoreClassInstance::getInstance()->geoadjustment_supported == 0) {
	        // No permission to use forms, just exist
	        die('You do not have permission to use GEO adjustment');
	    }
	}
	
	public function canUseChatbox()
	{
	    if (erLhcoreClassInstance::getInstance()->chatbox_supported == 0) {
	        // No permission to use forms, just exist
	        die('You do not have permission to use Chatbox');
	    }
	}
	
	public function canUseBO()
	{
	    if (erLhcoreClassInstance::getInstance()->browseoffers_supported == 0) {
	        // No permission to use forms, just exist
	        die('You do not have permission to use Browse Offers');
	    }
	}
	
	public function canUseProactive()
	{
	    if (erLhcoreClassInstance::getInstance()->proactive_supported == 0) {
	        // No permission to use forms, just exist
	        die('You do not have permission to use Pro active invitations');
	    }
	}
	
	public function changeTemplateSettings($params) {
		$params['tpl']->cacheDbVariables = false;
	}
	
	public function formFillPath($params) {			
		$params['path'] = 'var/storageform/'.date('Y').'y/'.date('m').'/'.date('d').'/'.erLhcoreClassInstance::getInstance()->id . '/' . $params['storage_id'].'/';
	}
	
	public function tempStoragePath($params){
		$params['dir'] = 'var/tmpfiles/'.erLhcoreClassInstance::getInstance()->id.'/';
	}
	
	public function themeStoragePath($params){
		$params['dir'] = 'var/storagetheme/'.date('Y').'y/'.date('m').'/'.date('d').'/'.erLhcoreClassInstance::getInstance()->id.'/'.$params['storage_id'].'/';
	}
		
	public function screenshotPath($params) {
		$params['path'] = 'var/storage/'.date('Y').'y/'.date('m').'/'.date('d').'/'.erLhcoreClassInstance::getInstance()->id.'/'.$params['storage_id'].'/';
	}

	public function newFilePath($params) {
		$params['path'] = 'var/storage/'.date('Y').'y/'.date('m').'/'.date('d').'/'.erLhcoreClassInstance::getInstance()->id.'/au/';
	}

	public function getStatus($params){
		if (erLhcoreClassInstance::getInstance()->is_active === false) {
			// Hide widget if expired
			exit;
		}
	}
	
	public function userEditPhotoPath($params) {		
		$params['dir'] = 'var/userphoto/' . date('Y') . 'y/' . date('m') . '/' . date('d') .'/'. erLhcoreClassInstance::getInstance()->id . '/' . $params['storage_id'] . '/';
	}
}


