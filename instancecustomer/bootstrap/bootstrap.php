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


