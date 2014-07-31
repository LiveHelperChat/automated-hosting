<?php

class erLhcoreClassModelInstance {

    public function getState()
   {
       return array (
               'id'       		=> $this->id,
               'request'     	=> $this->request,               
               'expires'     	=> $this->expires,
               'address' 		=> $this->address,
               'email'    		=> $this->email,
               'status'    		=> $this->status,
               'time_zone'    	=> $this->time_zone,
               'date_format'    		=> $this->date_format,
               'date_hour_format'    	=> $this->date_hour_format,
               'date_date_hour_format'  => $this->date_date_hour_format,
       		   'suspended'  	=> $this->suspended,
       		   'terminate'  	=> $this->terminate,
       );
   }

   public function setState( array $properties )
   {
       foreach ( $properties as $key => $val )
       {
           $this->$key = $val;
       }
   }

   public function fetch($dep_id, $useCache = false) {

   		if ($useCache == true && isset($GLOBALS['erLhcoreClassModelInstance'.$dep_id])) return $GLOBALS['erLhcoreClassModelInstance'.$dep_id];

   		$GLOBALS['erLhcoreClassModelInstance'.$dep_id] = erLhcoreClassInstance::getSession()->load( 'erLhcoreClassModelInstance', (int)$dep_id );

   		return $GLOBALS['erLhcoreClassModelInstance'.$dep_id];
   }

   public function __toString() {
   		return $this->email;
   }

  /*  public function removeThis() {
   		$db = ezcDbInstance::get();
   		$cfg = erConfigClassLhConfig::getInstance();
   		$db->query('DROP DATABASE IF EXISTS '.$cfg->getSetting( 'db', 'database_user_prefix').$this->id.';');

   		erLhcoreClassInstance::getSession()->delete($this);
   } */
   
   public function removeThis() {   	 
	   	try {
	   		erLhcoreClassInstance::removeCustomer($this);
	   	  
	   		erLhcoreClassInstance::getSession()->delete($this);
	   
	   		return true;
	   
	   	} catch (Exception $e) {
	   		return false;
	   	}
   }

   public function __get($var) {
	   	switch ($var) {
	   		case 'is_active':
	   			$this->is_active = $this->request > 0 && $this->expires > time() && $this->suspended == 0;
	   			return $this->is_active;
	   		break;

	   		default:
	   			;
	   		break;
	   	}
   }

   public function saveThis(){
   		erLhcoreClassInstance::getSession()->saveOrUpdate($this);
   }
   
   public function saveToInstanceThis() {
	   	$db = ezcDbInstance::get();
	   	$cfg = erConfigClassLhConfig::getInstance();
	   	$db->query('USE '.$cfg->getSetting( 'db', 'database' ));
	   	$this->saveThis();	   	
	   	$db->query('USE '.$cfg->getSetting( 'db', 'database_user_prefix').erLhcoreClassInstance::$instanceChat->id);
   }
   
   public function setPassword($password) {
	   	$cfg = erConfigClassLhConfig::getInstance();
	   
	   	$db = ezcDbInstance::get();
	   	$db->query('USE '.$cfg->getSetting( 'db', 'database_user_prefix').$this->id); // Switch to intance DB
	   		
	   	$secretHash = $cfg->getSetting( 'site', 'secrethash' );
	   	$password = sha1($password.$secretHash.sha1($password));
	   	 
	   	$stmt = $db->prepare('UPDATE lh_users SET password = :password WHERE id = 1');
	   	$stmt->bindValue( ':password',$password);
	   	$stmt->execute();
	   
	   	$db->query('USE '.$cfg->getSetting( 'db', 'database' ));
   }
    
   public function setUsername($username) {
	   	$cfg = erConfigClassLhConfig::getInstance();
	   
	   	$db = ezcDbInstance::get();
	   	$db->query('USE '.$cfg->getSetting( 'db', 'database_user_prefix').$this->id); // Switch to intance DB
	   
	   	$stmt = $db->prepare('UPDATE lh_users SET username = :username WHERE id = 1');
	   	$stmt->bindValue( ':username',$username);
	   	$stmt->execute();
	   
	   	$db->query('USE '.$cfg->getSetting( 'db', 'database' ));
   }
   
   public static function getCount($params = array())
   {
       $session = erLhcoreClassDepartament::getSession();
       $q = $session->database->createSelectQuery();
       $q->select( "COUNT(id)" )->from( "lhc_instance_client" );

       if (isset($params['filter']) && count($params['filter']) > 0)
       {
           $conditions = array();

           foreach ($params['filter'] as $field => $fieldValue)
           {
               $conditions[] = $q->expr->eq( $field, $q->bindValue($fieldValue) );
           }

           $q->where(
                 $conditions
           );
      }

      $stmt = $q->prepare();
      $stmt->execute();
      $result = $stmt->fetchColumn();

      return $result;
   }

   public static function getList($paramsSearch = array())
   {
       $paramsDefault = array('limit' => 32, 'offset' => 0);

       $params = array_merge($paramsDefault,$paramsSearch);

       $session = erLhcoreClassInstance::getSession();
       $q = $session->createFindQuery( 'erLhcoreClassModelInstance' );

       $conditions = array();

      if (isset($params['filter']) && count($params['filter']) > 0)
      {
           foreach ($params['filter'] as $field => $fieldValue)
           {
               $conditions[] = $q->expr->eq( $field, $q->bindValue($fieldValue) );
           }
      }

      if (isset($params['filterin']) && count($params['filterin']) > 0)
      {
           foreach ($params['filterin'] as $field => $fieldValue)
           {
               $conditions[] = $q->expr->in( $field, $fieldValue );
           }
      }

      if (isset($params['filterlt']) && count($params['filterlt']) > 0)
      {
           foreach ($params['filterlt'] as $field => $fieldValue)
           {
               $conditions[] = $q->expr->lt( $field, $q->bindValue($fieldValue) );
           }
      }

      if (isset($params['filtergt']) && count($params['filtergt']) > 0)
      {
           foreach ($params['filtergt'] as $field => $fieldValue)
           {
               $conditions[] = $q->expr->gt( $field,$q->bindValue( $fieldValue ));
           }
      }

      if (count($conditions) > 0)
      {
          $q->where(
                     $conditions
          );
      }

      $q->limit($params['limit'],$params['offset']);

      $q->orderBy(isset($params['sort']) ? $params['sort'] : 'id ASC' );


       $objects = $session->find( $q );

      return $objects;
   }

   const PENDING_CREATE = 0;
   const WORKING = 1;

   public $id = null;
   public $request = 0;   
   public $expires = 0;
   public $suspended = 0;
   public $terminate = 0;
   public $address = '';
   public $email = '';
   public $time_zone = '';
   public $date_format = 'Y-m-d';
   public $date_hour_format = 'H:i:s';
   public $date_date_hour_format = 'Y-m-d H:i:s';
   public $status = self::PENDING_CREATE;
   
}

?>