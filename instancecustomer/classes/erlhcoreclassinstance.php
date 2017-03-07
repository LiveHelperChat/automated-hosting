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
        if (isset($_SERVER['HTTP_HOST']))
        {
            $cfg = erConfigClassLhConfig::getInstance();
            
            if ($cfg->getSetting( 'site', 'remote_instance', false) == false)
            {
           		$subdomain = str_replace('.'.$cfg->getSetting( 'site', 'seller_domain'), '', $_SERVER['HTTP_HOST']);
           		
           		$session = erLhcoreClassInstance::getSession();
           		$q = $session->createFindQuery('erLhcoreClassModelInstance');
           		$q->where( $q->expr->eq( 'address', $q->bindValue( $subdomain ) ) . ' OR (full_domain = 1 AND ' . $q->expr->eq( 'address', $q->bindValue( $_SERVER['HTTP_HOST'] ) ). ')' );
           		$items = $session->find($q);
           		
           		if ( !empty($items) ) {
           			erLhcoreClassInstance::$instanceChat = array_shift($items);
           			$db->query('USE '.$cfg->getSetting( 'db', 'database_user_prefix').erLhcoreClassInstance::$instanceChat->id);
           		} else {

           		    // Try to find record in alias tables
           		    $alias = erLhcoreClassModelInstanceAlias::findOne(array('filter' => array('address' => $_SERVER['HTTP_HOST'])));

           		    if ($alias instanceof erLhcoreClassModelInstanceAlias)
           		    {
           		        erLhcoreClassInstance::$instanceChat = $alias->instance;
           		        
           		        if ($alias->url != '') {
           		           erLhcoreClassInstance::$instanceChat->default_url = $alias->url;
           		        }
           		        
           		        $db->query('USE '.$cfg->getSetting( 'db', 'database_user_prefix').erLhcoreClassInstance::$instanceChat->id);           		        
           		    } else {
               			header('Location: '.$cfg->getSetting( 'site', 'seller_url'));
               			exit; 
           			}
           		}
           		
            } else {
                $session = erLhcoreClassInstance::getSession();
                $q = $session->createFindQuery('erLhcoreClassModelInstance');
                $items = $session->find($q);
                
                if ( empty($items) ) {
                    
                    $data = self::getInstanceData( $_SERVER['HTTP_HOST'] );
                    
                    // Create same record as in manager
                    $instance = new erLhcoreClassModelInstance();
                    $instance->setState($data);
                    $instance->id = null;
                    $instance->saveThis();
                    
                    // Save locally
                    erLhcoreClassInstance::getSession()->saveOrUpdate($instance);   

                    // Set instance
                    erLhcoreClassInstance::$instanceChat = $instance;
                    
                } else {
                    erLhcoreClassInstance::$instanceChat = array_shift($items);
                }
            }
        }
   }

   public static function getInstanceData($address) {
       
       $cfg = erConfigClassLhConfig::getInstance();

       $url = erConfigClassLhConfig::getInstance()->getSetting( 'site', 'http_mode') . $cfg->getSetting( 'site', 'manager_subdomain') . '.' . $cfg->getSetting( 'site', 'seller_domain').'/index.php/instance/apigetinstance/';
            
       $response = json_decode(self::executeRequest(array('host' => $address), array(
           'host_request' => $url
       )),true);
       
       if ($response === null) {
           throw new Exception('Unhandled exception in API call');
       }
       
       if ($response['error'] == false) {
           return $response['data'];
       }
       
       if ($response['error'] == true) {
           throw new Exception('Instance not found - ' . $response['message']);
       }
   }
      
   public static function executeRequest($postFields, $params = array()) {
       $postFields = array_filter($postFields);
       $ch = curl_init();
       $hostRequest = isset($params['host_request']) ? $params['host_request'] : '';
   
       curl_setopt($ch, CURLOPT_URL, $hostRequest . '?' . http_build_query($postFields));
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt($ch, CURLOPT_TIMEOUT, 10);
       curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 10);
       curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
       curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
       @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Some hostings produces wargning...
       $content = curl_exec($ch);
                 
       if (isset($params['return_url'])) {
           return curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
       }
   
       return $content;
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