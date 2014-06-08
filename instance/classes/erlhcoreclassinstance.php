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

   		$password = erLhcoreClassModelForgotPassword::randomPassword(10);
   		$chat_box_hash = erLhcoreClassModelForgotPassword::randomPassword(10);
   		$searchArray = array('{email_replace}','{password_hash}','{export_hash_chats}','{chat_box_hash}','{chat_box_hash_length}');
   		
   		$cfg = erConfigClassLhConfig::getInstance();   		   		
   		$replaceArray = array($instance->email,sha1($password. $cfg->getSetting( 'site', 'secrethash') .sha1($password)),erLhcoreClassModelForgotPassword::randomPassword(10),$chat_box_hash,strlen($chat_box_hash));

	   	$db = ezcDbInstance::get();
	   	$db->query('DROP DATABASE IF EXISTS lhc_manage_client_'.$instance->id.';');
	   	$db->query('CREATE DATABASE lhc_manage_client_'.$instance->id.';');
	   	$db->query('USE lhc_manage_client_'.$instance->id);
	   	$sql = file_get_contents('extension/instance/doc/db_3.sql');
	   	$sql = str_replace($searchArray, $replaceArray, $sql);
	   	$db->query($sql);
	   	
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
	   	$instance->status = erLhcoreClassModelInstance::WORKING;
	   	$instance->saveThis();
   }

   private static $persistentSession;

   public static $instanceChat = null;
}

?>