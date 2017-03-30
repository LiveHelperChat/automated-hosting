<?php 

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
	        'erLhcoreClassModelInstanceAlias' => 'extension/instance/classes/erlhcoreclassmodelinstancealias.php',
	    );
	
	    if (key_exists($className, $classesAutoload)) {
	        include_once $classesAutoload[$className];
	    }
	}
}


