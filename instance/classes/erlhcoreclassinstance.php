<?php

class erLhcoreClassInstance{

   function __construct()
   {

   }

   public static function getSession()
   {
        if ( !isset( self::$persistentSession ) )
        {
            self::$persistentSession = new ezcPersistentSession(
                ezcDbInstance::get(),
                new ezcPersistentCodeManager( './extension/instance/pos' )
            );
        }
        return self::$persistentSession;
   }

   public static function setupInstance($db)
   {
   		$parts = explode('.', $_SERVER['HTTP_HOST']);
   		$subdomain = array_shift($parts);
   		$items = erLhcoreClassModelInstance::getList(array('filter' => array('address' => $subdomain)));

   		if ( !empty($items) ) {
   			erLhcoreClassInstance::$instanceChat = array_shift($items);
   			$cfg = erConfigClassLhConfig::getInstance();
   			$db->query('USE '.$cfg->getSetting( 'db', 'database_user_prefix').erLhcoreClassInstance::$instanceChat->id);
   		} else {
   			$cfg = erConfigClassLhConfig::getInstance();
   			header('Location: '.$cfg->getSetting( 'site', 'seller_url'));
   			exit;
   		}
   }

   public static function removeCustomer($instance) {
   
	   	$cfg = erConfigClassLhConfig::getInstance();
	   	$secretHash = $cfg->getSetting('site','seller_secret_hash');
	   
	   	$hash = sha1($instance->id . date('Ym') . $secretHash);
	   
	   	$url = erConfigClassLhConfig::getInstance()->getSetting( 'site', 'http_mode').$instance->address . '.' . $cfg->getSetting( 'site', 'seller_domain').'/index.php/instance/remove/' . $instance->id . '/' . date('Ym') . '/' . $hash;
	   	$response = erLhcoreClassModelChatOnlineUser::executeRequest($url);
	   	   	
	   	$responseData = json_decode($response);
	   	   	
	   	
	   	if (isset($responseData->error) && $responseData->error == false){
	   		self::deleteDatabase($instance->id);
	   		return true;
	   	} else {
	   		throw new Exception('Instance removement failed');
	   	}
   }
   
   public static function deleteDatabase($client_id){
	   	$cfg = erConfigClassLhConfig::getInstance();
	   	$cfg->getSetting( 'site', 'instance_handler');
	   	call_user_func($cfg->getSetting( 'site', 'instance_handler').'::deleteDB',$client_id);
   }
   
   public static function createDatabase($client_id) {
   		$cfg = erConfigClassLhConfig::getInstance();
   		$cfg->getSetting( 'site', 'instance_handler');   		
   		call_user_func($cfg->getSetting( 'site', 'instance_handler').'::createDB',$client_id);
   }
   
   public static function getInstance() {
   		if (self::$instanceChat !== null) {
   			return self::$instanceChat;
   		}

   		ezcDbInstance::get();
   		return self::$instanceChat;
   }

   public static function instanceExists($instance) {
   		if (in_array($instance, array('www','dev','dev2','demo','admin','manager'))){
   			return true;
   		}

   		return erLhcoreClassModelInstance::getCount(array('filter' => array('address' => $instance))) > 0;
   }

   public static function createCustomer($instance) {

   		$originalSiteAccess = erLhcoreClassSystem::instance()->SiteAccess;
   		if ($instance->locale != '') {
   			erLhcoreClassSystem::instance()->setSiteAccessByLocale($instance->locale);
   		}
   		
   		$password = erLhcoreClassModelForgotPassword::randomPassword(10);
   		$chat_box_hash = erLhcoreClassModelForgotPassword::randomPassword(10);
   		$searchArray = array('{email_replace}','{password_hash}','{export_hash_chats}','{chat_box_hash}','{chat_box_hash_length}');
   		
   		$cfg = erConfigClassLhConfig::getInstance();   		   		
   		$replaceArray = array($instance->email,sha1($password. $cfg->getSetting( 'site', 'secrethash') .sha1($password)),erLhcoreClassModelForgotPassword::randomPassword(10),$chat_box_hash,strlen($chat_box_hash));

	   	$db = ezcDbInstance::get();
	   		   	
	   	self::deleteDatabase($instance->id);
	   	self::createDatabase($instance->id);
	      		   	
	   	$db->query('USE '.$cfg->getSetting( 'db', 'database_user_prefix').$instance->id);
	   	$sql = file_get_contents('extension/instance/doc/db_3.sql');
	   	$sql = str_replace($searchArray, $replaceArray, $sql);
	   	$db->query($sql);
	   	
	   	$dbPostUpdate = ltrim(erLhcoreClassDesign::design('db_post_update/db.sql'),'/');
	   	if (file_exists($dbPostUpdate)){
	   	    $db->query(file_get_contents($dbPostUpdate));
	   	}
	   	
	   	// Insert default user language
	   	if ($instance->locale != ''){
	   		$stm = $db->prepare("INSERT INTO `lh_users_setting` (`user_id`, `identifier`, `value`) VALUES (1,'user_language',:value)");
	   		$stm->bindValue(':value',$instance->locale);
	   		$stm->execute();
	   	} else {
	   		$stm = $db->prepare("INSERT INTO `lh_users_setting` (`user_id`, `identifier`, `value`) VALUES (1,'user_language',:value)");
	   		$stm->bindValue(':value','en_EN');
	   		$stm->execute();	   		
	   	}

	   	$tpl = erLhcoreClassTemplate::getInstance( 'lhinstance/email.tpl.php');
	   	$tpl->setArray(array('instance' => $instance, 'email' => $instance->email, 'password' => $password));

	   	$mail = new PHPMailer();
	   	$mail->CharSet = 'UTF-8';
	   	$mail->Sender = $mail->From = $cfg->getSetting( 'site', 'seller_mail');
	   	$mail->FromName = $cfg->getSetting( 'site', 'seller_title');
	   	$mail->Subject = $cfg->getSetting( 'site', 'seller_title');
	   	$mail->AddReplyTo($cfg->getSetting( 'site', 'seller_mail'),$cfg->getSetting( 'site', 'seller_title'));

	   	$mail->Body = $tpl->fetch();
	   	$mail->AddAddress( $instance->email );

	   	erLhcoreClassChatMail::setupSMTP($mail);

	   	$mail->Send();
	   	$mail->ClearAddresses();

	   	$db->query('USE '.$cfg->getSetting( 'db', 'database'));
	   	
	   	// Activate instance
	   	$sql = "UPDATE lhc_instance_client SET status = 1 WHERE id = {$instance->id}";
	   	$db->query($sql);
	   		   		   	
	   	if ($instance->locale != '') {
	   		erLhcoreClassSystem::instance()->setSiteAccess($originalSiteAccess);
	   	}
   }

   private static $persistentSession;

   public static $instanceChat = null;
}

?>