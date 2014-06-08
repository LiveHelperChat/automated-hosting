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
		
		$instanceCustomer = erLhcoreClassInstance::getInstance();
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


