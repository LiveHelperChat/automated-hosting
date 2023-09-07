<?php
#[\AllowDynamicProperties]
class erLhcoreClassInstanceDBDirectAdmin {
      
   public static function deleteDB($client_id)
   {   
   		$cfg = erConfigClassLhConfig::getInstance();
   	
	   	$sock = new HTTPSocket;
	   	$sock->connect('ssl://' . $cfg->getSetting( 'site', 'direct_admin_ip'),$cfg->getSetting( 'site', 'direct_admin_port'));
	   	
	   	$sock->set_login($cfg->getSetting( 'site', 'direct_admin_user'), $cfg->getSetting( 'site', 'direct_admin_pass'));
	   	
	   	$sock->set_method('POST');
	   	
	   	$sock->query('/CMD_API_DATABASES',
	   			array(
	   					'action' => 'delete',	   				
	   					'select0' => $cfg->getSetting( 'db', 'database_user_prefix') . $client_id,   					
	   			));
	   	
	   	return $sock->fetch_body();
   }
   
   public static function createDB($client_id)
   {
   		$cfg = erConfigClassLhConfig::getInstance();
	   	
	   	$sock = new HTTPSocket;
	   	$sock->connect('ssl://' . $cfg->getSetting( 'site', 'direct_admin_ip'),$cfg->getSetting( 'site', 'direct_admin_port'));
	   	
	   	$sock->set_login($cfg->getSetting( 'site', 'direct_admin_user'), $cfg->getSetting( 'site', 'direct_admin_pass'));
	   	
	   	$sock->set_method('POST');
	   	
	   	$sock->query('/CMD_API_DATABASES',
	   			array(
	   					'action' => 'create',
	   					'name' => "client{$client_id}",
	   					'userlist' => $cfg->getSetting( 'site', 'direct_admin_dbuser'),
	   					'passwd' => $cfg->getSetting( 'site', 'direct_admin_dbpass'),
	   					'passwd2' => $cfg->getSetting( 'site', 'direct_admin_dbpass')
	   			));
	   	
	   	return $sock->fetch_body();
   }
}

?>