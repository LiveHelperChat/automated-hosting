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
                new ezcPersistentCodeManager( './extension/instancecustomer/pos' )
            );
        }
        return self::$persistentSession;
   }

   public static function setupInstance($db)
   {
        $cfg = erConfigClassLhConfig::getInstance();
       
   		$subdomain = str_replace('.'.$cfg->getSetting( 'site', 'seller_domain'), '', $_SERVER['HTTP_HOST']);   		
   		$items = erLhcoreClassModelInstance::getList(array('filter' => array('address' => $subdomain)));
   		
   		if ( !empty($items) ) {
   			erLhcoreClassInstance::$instanceChat = array_shift($items);
   			$db->query('USE '.$cfg->getSetting( 'db', 'database_user_prefix').erLhcoreClassInstance::$instanceChat->id);
   		} else {
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
   
   private static $persistentSession;

   public static $instanceChat = null;
}

?>