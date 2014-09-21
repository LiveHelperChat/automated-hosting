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
       		   'locale'  		=> $this->locale,
       		   'siteaccess'  	=> $this->siteaccess,
       		   'is_reseller'  	=> $this->is_reseller,
       		   'reseller_tite'  				=> $this->reseller_tite,
       		   'reseller_max_instance_request'  => $this->reseller_max_instance_request,
       		   'reseller_secret_hash'  			=> $this->reseller_secret_hash,
       		   'reseller_max_instances'  		=> $this->reseller_max_instances,
       		   'reseller_id'  		=> $this->reseller_id,
       		   'reseller_request'  	=> $this->reseller_request,
       		   'reseller_suspended' => $this->reseller_suspended,
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
   
   public function removeThis() {   	 
	   	try {
	   		
	   		$clients = self::getList(array('limit' => 1000000,'filter' => array('reseller_id' => $this->id)));
	   		foreach ($clients as $client) {
	   			$statusRemove = $client->removeThis();
	   			
	   			// Something failed
	   			if ($statusRemove == false) {
	   				return false;
	   			}
	   		}
	   		
	   		// Instance was created so we have to remove customer data first
	   		if ($this->status == 1) {
	   			erLhcoreClassInstance::removeCustomer($this);	 
	   		}  	  
	   		
	   		erLhcoreClassInstance::getSession()->delete($this);	   
	   		return true;	   
	   	} catch (Exception $e) {
	   		return false;
	   	}
   }

   public function __get($var) {
	   	switch ($var) {
	   		case 'is_active':
	   			$this->is_active = $this->request > 0 && $this->expires > time() && $this->suspended == 0 && $this->reseller_suspended == 0;
	   			return $this->is_active;
	   		break;
	   		
	   		case 'reseller':
	   			try {
	   				$this->reseller = $this->reseller_id > 0  ? self::fetch( $this->reseller_id): false;
	   			} catch (Exception $e) {
	   				$this->reseller = false;
	   			}
	   			return $this->reseller;
	   		break;
	   		
	   		case 'reseller_instances_count':
	   				$this->reseller_instances_count = self::getCount(array('filter' => array('reseller_id' => $this->id)));
	   				return $this->reseller_instances_count;
	   			break;
	   			
	   		default:
	   			;
	   		break;
	   	}
   }

   public function saveThis(){
   		erLhcoreClassInstance::getSession()->saveOrUpdate($this);
   		if ($this->is_reseller == 1) {
   			$db = ezcDbInstance::get();
   			$stmt = $db->prepare('UPDATE lhc_instance_client SET reseller_suspended = :reseller_suspended WHERE reseller_id = :reseller_id');
   			$stmt->bindValue( ':reseller_suspended',$this->suspended);
   			$stmt->bindValue( ':reseller_id',$this->id);
   			$stmt->execute();
   		}
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
   
   public $is_reseller = 0;
   public $reseller_tite = '';
   public $reseller_max_instance_request = 0;
   public $reseller_secret_hash = '';
   public $reseller_max_instances = 0;
   public $reseller_id = 0;
   public $reseller_request = 0;
   
   // Then reseller get's suspended this attribute is set to 1, to avoid double fetching each time in instance part.
   public $reseller_suspended = 0;
      
   public $locale = '';
   public $siteaccess = 'eng';
   
   public $status = self::PENDING_CREATE;
   
}

?>