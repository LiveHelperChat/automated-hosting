<?php
#[\AllowDynamicProperties]
class erLhcoreClassModelInstanceAlias
{
    use erLhcoreClassDBTrait;
    
    public static $dbTable = 'lhc_instance_client_alias';
    
    public static $dbTableId = 'id';
    
    public static $dbSessionHandler = 'erLhcoreClassInstance::getSession';
    
    public static $dbSortOrder = 'DESC';
    
    public function getState()
    {
        return array(
            'id' => $this->id,
            'instance_id' => $this->instance_id,
            'address' => $this->address,
            'url' => $this->url,
        );
    }

    public function __toString()
    {
        return $this->address;
    }
   

    public function __get($var)
    {
        switch ($var) {
                      
            default:
                ;
                break;
        }
    }

    public $id = null;

    public $instance_id = 0;

    public $address = 0;

    public $url = 0;    
}

?>