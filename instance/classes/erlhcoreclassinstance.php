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

   // Takes actions on instance database based on applied operators limits
   public static function performOperatorsLimit($instance) {
       $cfg = erConfigClassLhConfig::getInstance();
       $secretHash = $cfg->getSetting('site','seller_secret_hash');
       
       $hash = sha1($instance->id . date('Ym') . $secretHash . '_' . $instance->max_operators);
       
       $url = erConfigClassLhConfig::getInstance()->getSetting( 'site', 'http_mode').$instance->address . '.' . $cfg->getSetting( 'site', 'seller_domain').'/index.php/instance/setoperatorslimits/' . $instance->id . '/' . date('Ym') . '/' . $instance->max_operators . '/' . $hash;
       $response = erLhcoreClassModelChatOnlineUser::executeRequest($url);
             
       if ($response == 'ok') {
           return true;
       } else {
           throw new Exception('Could not apply a limits');
       }
   }
   
   public static function removeCustomer($instance) {
   
	   	$cfg = erConfigClassLhConfig::getInstance();
	   	$secretHash = $cfg->getSetting('site','seller_secret_hash');
	   
	   	$hash = sha1($instance->id . date('Ym') . $secretHash);

        for ($i = 1; $i < 20; $i++) {
           $url = erConfigClassLhConfig::getInstance()->getSetting( 'site', 'http_mode').$instance->address . '.' . $cfg->getSetting( 'site', 'seller_domain').'/index.php/instance/remove/' . $instance->id . '/' . date('Ym') . '/' . $hash;
           $response = erLhcoreClassModelChatOnlineUser::executeRequest($url);
           $responseData = json_decode($response);
           if (isset($responseData->error) && $responseData->error == false) {
               break;
           }
        }

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
   		if (in_array($instance, array('wscb','www','dev','dev2','demo','admin','manager'))){
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

       $mail = new PHPMailer();
       $mail->CharSet = 'UTF-8';
       $mail->Sender = $mail->From = $cfg->getSetting( 'site', 'seller_mail');
       $mail->FromName = $cfg->getSetting( 'site', 'seller_title');
       $mail->Subject = $cfg->getSetting( 'site', 'seller_title');
       $mail->AddReplyTo($cfg->getSetting( 'site', 'seller_mail'),$cfg->getSetting( 'site', 'seller_title'));
       $mail->AddAddress( $instance->email );

       erLhcoreClassChatMail::setupSMTP($mail);

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
       $tpl->setArray(array('instance' => $instance, 'email' => $instance->email, 'password' => $password, 'client_attributes_array' => $instance->client_attributes_array));

       // Dispatch event for listeners
       erLhcoreClassChatEventDispatcher::getInstance()->dispatch('instance.registered.created', array(
           'instance' => & $instance,
           'tpl' => & $tpl,
           'mail' => & $mail,
           'password' => $password
       ));

       $mail->Body = $tpl->fetch();
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

   /**
    * Sends expire mail
    */
   public static function sendExpireMail(erLhcoreClassModelInstance $instance, $expireOption)
   {
       $cfg = erConfigClassLhConfig::getInstance();
       
       $originalSiteAccess = erLhcoreClassSystem::instance()->SiteAccess;
       
       if ($instance->locale != '') {
           erLhcoreClassSystem::instance()->setSiteAccessByLocale($instance->locale);
       }
       
       $tpl = erLhcoreClassTemplate::getInstance( 'lhinstance/expire_options_mails/' . $expireOption['template']);
       $tpl->setArray(array('instance' => $instance, 'email' => $instance->email, 'client_attributes_array' => $instance->client_attributes_array));
       
       $mail = new PHPMailer();
       $mail->CharSet = 'UTF-8';
       $mail->Sender = $mail->From = $cfg->getSetting( 'site', 'seller_mail');
       $mail->FromName = $cfg->getSetting( 'site', 'seller_title');
       $mail->Subject = $expireOption['mail']['subject'];
       $mail->AddReplyTo($cfg->getSetting( 'site', 'seller_mail'),$cfg->getSetting( 'site', 'seller_title'));
       
       $mail->Body = $tpl->fetch();
       $mail->AddAddress( $instance->email );
       
       erLhcoreClassChatMail::setupSMTP($mail);
       
       $mail->Send();
       $mail->ClearAddresses();
   }
   
   /**
    * @desc returns expire options
    * 
    * @return array()
    */
   public static function getExpireOptions()
   {
       $expireOptionsFile = ltrim(erLhcoreClassDesign::design('expire_options/expire_options.php'),'/');
        
       if (file_exists($expireOptionsFile)) {
           return include $expireOptionsFile;
       }
       
       return array();
   }
   
   /**
    * Processes all informing actions about expiring instances.
    * Sponsored :)
    * 
    * */
   public static function informAboutExpiration(){
       
       $status = array();
       
       foreach (self::getExpireOptions() as $expireOption) {

           foreach (erLhcoreClassModelInstance::getList($expireOption['filter']) as $item) {

               $status[] = "Expire option - ".$expireOption['template'].'-'.$item->id;

               foreach ($expireOption['set'] as $attr => $attrValue) {
                   $item->$attr = $attrValue;                       
               }
               
               $item->saveThis();
               
               // Send e-mail only if enabled
               if ($expireOption['enabled'] == true) {
                    self::sendExpireMail($item, $expireOption);
                    $status[] = "Informing about expiration...";
               }
           }
       }
       
       return $status;
   }
   
   private static $persistentSession;

   public static $instanceChat = null;
}

?>