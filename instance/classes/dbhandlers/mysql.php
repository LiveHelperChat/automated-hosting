<?php

class erLhcoreClassInstanceDBMysql {
      
   public static function deleteDB($client_id)
   {   
   		$cfg = erConfigClassLhConfig::getInstance();
   		
	   	$db = ezcDbInstance::get();	   	
	   	$db->query('DROP DATABASE IF EXISTS '.$cfg->getSetting( 'db', 'database_user_prefix').$client_id.';');
   }
   
   public static function createDB($client_id)
   {
   		$cfg = erConfigClassLhConfig::getInstance();
   		
   		self::deleteDB($client_id);
   		$db = ezcDbInstance::get();
   		$db->query('CREATE DATABASE '.$cfg->getSetting( 'db', 'database_user_prefix').$client_id.';');
   }
}

?>