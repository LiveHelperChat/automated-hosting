<?php

class erLhcoreClassModelInstanceInvoice {

   public function getState()
   {
       return array (
               'id'       		=> $this->id,
               'txn_id'     	=> $this->txn_id,               
               'instance_id'    => $this->instance_id,
               'order_item' 	=> $this->order_item,
               'odate'    		=> $this->odate,
               'log'    		=> $this->log,
               'currency'    	=> $this->currency,
               'amount'    		=> $this->amount
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
   
   		if ($useCache == true && isset($GLOBALS['erLhcoreClassModelInstanceInvoice'.$dep_id])) return $GLOBALS['erLhcoreClassModelInstanceInvoice'.$dep_id];
   		
   		$db = ezcDbInstance::get();   		 
   		$cfg = erConfigClassLhConfig::getInstance();
   		$db->query('USE '.$cfg->getSetting( 'db', 'database' ));   		
   		$GLOBALS['erLhcoreClassModelInstanceInvoice'.$dep_id] = erLhcoreClassInstance::getSession()->load( 'erLhcoreClassModelInstanceInvoice', (int)$dep_id );
   		$db->query('USE '.$cfg->getSetting( 'db', 'database_user_prefix').erLhcoreClassInstance::$instanceChat->id);
   		
   		return $GLOBALS['erLhcoreClassModelInstanceInvoice'.$dep_id];
   }

   public function __toString() {
   		return $this->order_item;
   }
   
   public function removeThis() { 
	   	erLhcoreClassInstance::getSession()->delete($this);	   	
   }

   public function __get($var) {
	   	switch ($var) {

	   		case 'amount_front':
	   				$this->amount_front = round($this->amount/100,2);
	   				return $this->amount_front;
	   			break;

	   		case 'price_front':
	   				$this->price_front = $this->amount_front . ' ' . $this->currency;
	   				return $this->price_front;
	   			break;

	   		case 'json_data':
	   				$this->json_data = json_decode($this->log,true);
	   				return $this->json_data;
	   			break;
	   			
	   		case 'option_selection1':
	   				$this->option_selection1 = isset($this->json_data['option_selection1']) ? $this->json_data['option_selection1'] : '-';
	   				return $this->option_selection1;
	   			break;
	   			
	   		case 'date_front':
	   				$this->date_front = date('Y-m-d H:i:s',$this->odate);
	   				return $this->date_front;
	   			break;
	   			
	   		case 'instance':
	   		      try{
    	   		      $this->instance = erLhcoreClassInstance::getInstance();    	   		     
	   		      } catch (Exception $e) {
	   		          $this->instance = false;
	   		      }
	   		      
	   		      return $this->instance;
	   		    break;	
	   			
	   		case 'customer_name':
	   		    
	   		    if ($this->instance !== false && $this->instance->client_title != '') {
	   		        $this->customer_name = $this->instance->client_title;
	   		        return $this->customer_name;
	   		    } else {	   		    
    	   			$this->customer_name = isset($this->json_data['payer_email']) ? $this->json_data['payer_email'] : '';
    	   			if (isset($this->json_data['first_name'])){
    	   				$this->customer_name .= "<br/>".$this->json_data['first_name'].' '.$this->json_data['last_name'];
    	   			}
    	   			return $this->customer_name;
	   		    }
	   			break;
	   			   			
	   		default:
	   			;
	   		break;
	   	}
   }

   public function saveThis(){
   		if ($this->id == null) {
   			$this->odate = time();
   		}  
   		erLhcoreClassInstance::getSession()->saveOrUpdate($this);
   }
   
   public static function getCount($params = array())
   {
   	   $db = ezcDbInstance::get();
   	   
   	   $cfg = erConfigClassLhConfig::getInstance();
   	   $db->query('USE '.$cfg->getSetting( 'db', 'database' ));
   	
       $session = erLhcoreClassDepartament::getSession();
       $q = $session->database->createSelectQuery();
       $q->select( "COUNT(id)" )->from( "lhc_instance_invoice" );

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
      $db->query('USE '.$cfg->getSetting( 'db', 'database_user_prefix').erLhcoreClassInstance::$instanceChat->id);
      return $result;
   }

   public static function getList($paramsSearch = array())
   {
   	   $db = ezcDbInstance::get();
   	   
   	   $cfg = erConfigClassLhConfig::getInstance();
   	   $db->query('USE '.$cfg->getSetting( 'db', 'database' ));
   	
       $paramsDefault = array('limit' => 32, 'offset' => 0);

       $params = array_merge($paramsDefault,$paramsSearch);

       $session = erLhcoreClassInstance::getSession();
       $q = $session->createFindQuery( 'erLhcoreClassModelInstanceInvoice' );

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
      $q->orderBy(isset($params['sort']) ? $params['sort'] : 'id DESC' );

      $objects = $session->find( $q );       
      $db->query('USE '.$cfg->getSetting( 'db', 'database_user_prefix').erLhcoreClassInstance::$instanceChat->id);
       
      return $objects;
   }

   public $id = null;
   public $txn_id = 0;   
   public $instance_id = 0;
   public $order_item = '';
   public $odate = 0;
   public $log = '';
   public $currency = '';   
   public $amount = 0;
}

?>