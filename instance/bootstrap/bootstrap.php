<?php
#[\AllowDynamicProperties]
class erLhcoreClassExtensionInstance {

	public function __construct() 
	{
		
	}
	
	public function run()
	{		
	    $this->registerAutoload();
	}

	public function registerAutoload()
	{
	    spl_autoload_register(array(
	        $this,
	        'autoload'
	    ), true, false);
	}
	
	public function autoload($className)
	{
	    $classesAutoload = array(
	        'erLhcoreClassModelInstanceAlias'   => 'extension/instance/classes/erlhcoreclassmodelinstancealias.php',
            'erLhcoreClassModelInstance'        => 'extension/instance/classes/erlhcoreclassmodelinstance.php',
            'erLhcoreClassInstance'             => 'extension/instance/classes/erlhcoreclassinstance.php',
            'erLhcoreClassInstanceDBMysql'      => 'extension/instance/classes/dbhandlers/mysql.php',
            'erLhcoreClassInstanceDBDirectAdmin'=> 'extension/instance/classes/dbhandlers/directadmin.php',
            'HTTPSocket'                        => 'extension/instance/classes/dbhandlers/httpsocket.php',
            'erLhcoreClassModelInstanceInvoice'	=> 'extension/instance/classes/erlhcoreclassmodelinstanceinvoice.php',
	    );
	
	    if (key_exists($className, $classesAutoload)) {
	        include_once $classesAutoload[$className];
	    }
	}
}


