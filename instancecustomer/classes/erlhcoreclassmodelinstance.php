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
               'full_domain'    	=> $this->full_domain,
               'date_format'    		=> $this->date_format,
               'date_hour_format'    	=> $this->date_hour_format,
               'date_date_hour_format'  => $this->date_date_hour_format,
               'suspended'  	=> $this->suspended,
               'terminate'  	=> $this->terminate,
       		   'locale'  		=> $this->locale,
       		   'siteaccess'  	=> $this->siteaccess,
       		   'is_reseller'  	=> $this->is_reseller,
       		   'reseller_tite'  			=> $this->reseller_tite,
       		   'reseller_max_instance_request'  => $this->reseller_max_instance_request,
       		   'reseller_secret_hash'  		=> $this->reseller_secret_hash,
       		   'reseller_max_instances'  	=> $this->reseller_max_instances,
       		   'reseller_id'  				=> $this->reseller_id,
       		   'reseller_request'  			=> $this->reseller_request,
       		   'reseller_suspended'  		=> $this->reseller_suspended,
               'files_supported' => $this->files_supported,
               'default_url' => $this->default_url,
               'atranslations_supported' => $this->atranslations_supported,
               'cobrowse_supported' => $this->cobrowse_supported,
               'cobrowse_forms_supported' => $this->cobrowse_forms_supported,
               'forms_supported' => $this->forms_supported,
               'faq_supported' => $this->faq_supported,
               'cannedmsg_supported' => $this->cannedmsg_supported,
               'feature_1_supported' => $this->feature_1_supported,
               'feature_2_supported' => $this->feature_2_supported,
               'feature_3_supported' => $this->feature_3_supported,
               'feature_4_supported' => $this->feature_4_supported,
               'feature_5_supported' => $this->feature_5_supported,
               'feature_6_supported' => $this->feature_6_supported,
               'reporting_supported' => $this->reporting_supported,
               'chatbox_supported' => $this->chatbox_supported,
               'browseoffers_supported' => $this->browseoffers_supported,
               'questionnaire_supported' => $this->questionnaire_supported,
               'proactive_supported' => $this->proactive_supported,
               'screenshot_supported' => $this->screenshot_supported,
               'blocked_supported' => $this->blocked_supported,
               'client_title' => $this->client_title,
               'phone_number_data' => $this->phone_number_data,
               'sms_left' => $this->sms_left,
               'sms_plan' => $this->sms_plan,
               'soft_limit_type' => $this->soft_limit_type,
               'soft_limit' => $this->soft_limit,
               'hard_limit_type' => $this->hard_limit_type,
               'hard_limit' => $this->hard_limit,
               'sms_processed' => $this->sms_processed,
               'sms_supported' => $this->sms_supported,
               'soft_warning_send' => $this->soft_warning_send,
               'hard_warning_send' => $this->hard_warning_send,
               'phone_default_department' => $this->phone_default_department,
               'phone_response_data' => $this->phone_response_data,
               'phone_response_timeout_data' => $this->phone_response_timeout_data,
               'footprint_supported' => $this->footprint_supported,
               'previouschats_supported' => $this->previouschats_supported,
               'chatremarks_supported' => $this->chatremarks_supported,
               'autoresponder_supported' => $this->autoresponder_supported,
               'geoadjustment_supported' => $this->geoadjustment_supported,
               'onlinevisitortrck_supported' => $this->onlinevisitortrck_supported,
               'chat_supported' => $this->chat_supported,
               'custom_fields_1' => $this->custom_fields_1,
               'custom_fields_2' => $this->custom_fields_2,
               'custom_fields_3' => $this->custom_fields_3,
               'custom_fields_4' => $this->custom_fields_4,
               'custom_fields_5' => $this->custom_fields_5,
               'custom_fields_6' => $this->custom_fields_6,
               'speech_supported' => $this->speech_supported,
               'transfer_supported' => $this->transfer_supported,
               'operatorschat_supported' => $this->operatorschat_supported,
               'xmpp_supported' => $this->xmpp_supported,
               'offline_supported' => $this->offline_supported,
               'sugarcrm_supported' => $this->sugarcrm_supported,
               'attr_int_1' => $this->attr_int_1,
               'attr_int_2' => $this->attr_int_2,
               'attr_int_3' => $this->attr_int_3,
               'attr_int_4' => $this->attr_int_4,
               'attr_int_5' => $this->attr_int_5,
               'attr_int_6' => $this->attr_int_6,
               'max_operators' => $this->max_operators,
               'one_per_account' => $this->one_per_account,
               'full_xmpp_chat_supported' => $this->full_xmpp_chat_supported,
               'full_xmpp_visitors_tracking' => $this->full_xmpp_visitors_tracking,
               'client_attributes' => $this->client_attributes,
               'expire_inform_status' => $this->expire_inform_status,
               'login_ip_security' => $this->login_ip_security,
               'is_remote' => $this->is_remote
       );
   }
   
   public function setState( array $properties )
   {
       foreach ( $properties as $key => $val )
       {
           $this->$key = $val;
       }
   }

    public function removeInstanceData() {

        $hasFiles = true;
        while ($hasFiles) {
            $files = erLhAbstractModelFormCollected::getList(array('limit' => 1000));
            foreach ($files as $item) {
                $item->removeThis();
            }
            if (count($files) == 0) {
                $hasFiles = false;
            }
        }

        foreach (erLhAbstractModelWidgetTheme::getList(array('limit' => 1000000)) as $item){
            $item->removeThis();
        }

        $hasFiles = true;
        while ($hasFiles) {
            $files = erLhcoreClassChat::getList(array('limit' => 1000));
            foreach ($files as $item) {
                $item->removeThis();
            }
            if (count($files) == 0) {
                $hasFiles = false;
            }
        }

        $hasFiles = true;
        while ($hasFiles) {
            $files = erLhcoreClassChat::getList(array('limit' => 1000),'erLhcoreClassModelChatFile','lh_chat_file');
            foreach ($files as $item){
                $item->removeThis();
            }
            if (count($files) == 0) {
                $hasFiles = false;
            }
        }


        foreach (erLhcoreClassModelUser::getUserList(array('limit' => 1000000)) as $item){
            $item->removeFile();
        }

        // Dispatch event for extensions
        erLhcoreClassChatEventDispatcher::getInstance()->dispatch('instance.destroyed', array(
            'instance' => $this
        ));

        return true;
    }
   
   public static function fetch($dep_id, $useCache = false) {

   		if ($useCache == true && isset($GLOBALS['erLhcoreClassModelInstance'.$dep_id])) return $GLOBALS['erLhcoreClassModelInstance'.$dep_id];

   		$GLOBALS['erLhcoreClassModelInstance'.$dep_id] = erLhcoreClassInstance::getSession()->load( 'erLhcoreClassModelInstance', (int)$dep_id );

   		return $GLOBALS['erLhcoreClassModelInstance'.$dep_id];
   }

   public function __toString() {
   		return $this->email;
   }
   
   public function getCustomFieldsData($fieldId) {
       return unserialize($this->{'custom_fields_'.$fieldId});
   }
   
   public function __get($var) {
	   	switch ($var) {
	   		case 'is_active':
	   			$this->is_active = $this->request > 0 && ($this->expires == 0 || $this->expires > time()) && $this->suspended == 0 && $this->reseller_suspended == 0;	   			
	   			return $this->is_active;
	   		break;
	   		
	   		case 'sms_used_percentenge':
	   		    return round(($this->sms_left / $this->sms_plan) * 100, 2);
	   		    break;
	   		
	   		case 'soft_limit_in_effect':
	   		    $soft_limit_in_effect = false;
	   		    if ($this->soft_limit_type == 0 && (($this->sms_left / $this->sms_plan) * 100) < $this->soft_limit) {
	   		        $soft_limit_in_effect = true;
	   		    } elseif ($this->soft_limit_type == 1 && $this->sms_left < $this->soft_limit) {
	   		        $soft_limit_in_effect = true;
	   		    }
	   		    return $soft_limit_in_effect;
	   		    break;
	   		
	   		case 'hard_limit_in_effect':
	   		    $hard_limit_in_effect = false;
	   		    if ($this->hard_limit_type == 0 && (($this->sms_left / $this->sms_plan) * 100) < $this->hard_limit) {
	   		        $hard_limit_in_effect = true;
	   		    } elseif ($this->hard_limit_type == 1 && $this->sms_left < $this->hard_limit) {
	   		        $hard_limit_in_effect = true;
	   		    }
	   		    return $hard_limit_in_effect;
	   		    break;
	   		
	   		case 'can_send_sms':
	   		    $this->can_send_sms = $this->sms_supported == true && $this->hard_limit_in_effect == false;
	   		    return $this->can_send_sms;
	   		    break;

   		    case 'phone_response':
   		        $this->phone_response = $this->phone_response_data;
   		        return $this->phone_response;
   		        break;
   		    
   		    case 'phone_response_timeout':
   		        $this->phone_response_timeout = $this->phone_response_timeout_data;
   		        return $this->phone_response_timeout;
   		        break;
	   		    
	   		case 'phone_number_departments':
	   		          $this->phone_number_departments = array();
	   		          foreach ($this->phone_number as $phoneData) {
	   		              if ($phoneData['phone'] != '') {
	   		                  $this->phone_number_departments[$phoneData['phone']] = $phoneData['department'];
	   		              }
	   		          }
	   		          
	   		          return $this->phone_number_departments;
	   		    break;    

	   		case 'phone_number_first':
	   		      $this->phone_number_first = '';	   		      
	   		      foreach ($this->phone_number as $phone) {
	   		          if ($phone['phone'] != '') {
	   		              $this->phone_number_first = $phone['phone'];
	   		              return $this->phone_number_first;
	   		          }
	   		      }	   		      
	   		      return $this->phone_number_first;
	   		    break;    
	   		    
	   		case 'phone_number':
	   		      $phoneNumber = json_decode($this->phone_number_data,true);
	   		      if ($phoneNumber !== false) {
	   		          $this->phone_number = $phoneNumber;
	   		      } else {
	   		          $this->phone_number = array(array('phone' => $this->phone_number_data, 'department' => 0));	   		         
	   		      }
	   		      
	   		      for ($i = count($this->phone_number); $i < 15; $i++) {
	   		          $this->phone_number = array(array('phone' => '', 'department' => 0));
	   		      }
	   		      
	   		      return $this->phone_number;
	   		    break;
	   		        
	   		case 'translation_config':
	   		    if (($this->translation_config = CSCacheAPC::getMem()->getSession('automatic_translations')) == false) {
    	   		    $db = ezcDbInstance::get();
    	   		    $cfg = erConfigClassLhConfig::getInstance();
    	   		    $db->query('USE '.$cfg->getSetting( 'db', 'database' ));	
    	   		    // Fetches from manager
    	   		    $this->translation_config = erLhcoreClassModelChatConfig::fetch('translation_data')->data;
    	   		    $db->query('USE '.$cfg->getSetting( 'db', 'database_user_prefix').erLhcoreClassInstance::$instanceChat->id);
    	   		    CSCacheAPC::getMem()->setSession('automatic_translations', $this->translation_config);
	   		    }
	   		    return $this->translation_config;
	   	    break;
	   		        
	   		case 'reseller_instances_count':
	   			$db = ezcDbInstance::get();
	   			$cfg = erConfigClassLhConfig::getInstance();
	   			$db->query('USE '.$cfg->getSetting( 'db', 'database' ));
	   			$this->reseller_instances_count = self::getCount(array('filter' => array('reseller_id' => $this->id)));
	   			$db->query('USE '.$cfg->getSetting( 'db', 'database_user_prefix').erLhcoreClassInstance::$instanceChat->id);
	   			return $this->reseller_instances_count;
	   		break;
	   		
	   		case 'client_attributes_array':
	   		    $this->client_attributes_array = json_decode($this->client_attributes,true);
	   		    if (!is_array($this->client_attributes_array)) {
	   		        $this->client_attributes_array = array();
	   		    }
	   		    return $this->client_attributes_array;
	   		    break;
	   		    
	   		default:
	   			;
	   		break;
	   	}
   }

   public function getPhoneAttribute($attr) {
       $cfg = erConfigClassLhConfig::getInstance();
       $phoneAttributes = $cfg->getSetting('site','phoneattributes');
       
       if (isset($phoneAttributes[$attr])) {
           return $phoneAttributes[$attr];
       }
             
       return '';
   }
   
   public function addSMSMessageSend($number) {
       $this->sms_left-= $number;
       $this->sms_processed += $number;
       
       if ($this->soft_limit_in_effect == true && $this->soft_warning_send == 0) {
                               
           $this->soft_warning_send = 1;

           // Send mail to global administrator
           $mail = new PHPMailer(true);
           $mail->CharSet = "UTF-8";
           $mail->Subject = erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Instance has reached soft SMS limit').' - '.$this->id;
           $mail->AddReplyTo($this->email,(string)$this->address);
           
           $tpl = new erLhcoreClassTemplate();
           
           $tpl->set('instance',$this);
           
           // Remove new line characters
           $content = str_replace("\n", "", $tpl->fetch('lhinstance/mail/phone_soft_limit.tpl.php'));
           // Replace br with new line characters
           $content = str_replace("<br/>", "\n", $content);
           
           $mail->Body = $content;
           $mail->AddAddress( erConfigClassLhConfig::getInstance()->getSetting('site','support_mail') );
           
           erLhcoreClassChatMail::setupSMTP($mail);
           
           try {
               $mail->Send();
           } catch (Exception $e) {
                
           }
           
           $mail->ClearAddresses();
                    
           // Send mail to instance admin
           $mail = new PHPMailer(true);
           $mail->CharSet = "UTF-8";
           $mail->Subject = erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','You have reached soft SMS limit');
           $mail->AddReplyTo($this->email,(string)$this->address);
            
           $tpl = new erLhcoreClassTemplate();
            
           $tpl->set('instance',$this);
            
           // Remove new line characters
           $content = str_replace("\n", "", $tpl->fetch('lhinstance/mail/phone_soft_limit_user.tpl.php'));
           // Replace br with new line characters
           $content = str_replace("<br/>", "\n", $content);
            
           $mail->Body = $content;
           $mail->AddAddress( $this->email );
            
           erLhcoreClassChatMail::setupSMTP($mail);
           
           try {
               $mail->Send();
           } catch (Exception $e) {           
           }
           
           $mail->ClearAddresses();           
       }
       
       if ($this->hard_limit_in_effect == true && $this->hard_warning_send == 0) {          
           $this->hard_warning_send = 1;
           
           // Send mail to global administrator
           $mail = new PHPMailer(true);
           $mail->CharSet = "UTF-8";
           $mail->Subject = erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Instance has reached hard SMS limit').' - '.$this->id;
           $mail->AddReplyTo($this->email,(string)$this->address);
            
           $tpl = new erLhcoreClassTemplate();
            
           $tpl->set('instance',$this);
            
           // Remove new line characters
           $content = str_replace("\n", "", $tpl->fetch('lhinstance/mail/phone_hard_limit.tpl.php'));
           // Replace br with new line characters
           $content = str_replace("<br/>", "\n", $content);
            
           $mail->Body = $content;
           $mail->AddAddress( erConfigClassLhConfig::getInstance()->getSetting('site','support_mail') );
            
           erLhcoreClassChatMail::setupSMTP($mail);
            
           try {
               $mail->Send();
           } catch (Exception $e) {
           
           }
            
           $mail->ClearAddresses();
           
           // Send mail to instance admin
           $mail = new PHPMailer(true);
           $mail->CharSet = "UTF-8";
           $mail->Subject = erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','You have reached hard SMS limit');
           $mail->AddReplyTo($this->email,(string)$this->address);
           
           $tpl = new erLhcoreClassTemplate();
           
           $tpl->set('instance',$this);
           
           // Remove new line characters
           $content = str_replace("\n", "", $tpl->fetch('lhinstance/mail/phone_hard_limit_user.tpl.php'));
           // Replace br with new line characters
           $content = str_replace("<br/>", "\n", $content);
           
           $mail->Body = $content;
           $mail->AddAddress( $this->email );
           
           erLhcoreClassChatMail::setupSMTP($mail);
            
           try {
               $mail->Send();
           } catch (Exception $e) {
                
           }
            
           $mail->ClearAddresses();
       }
            
       $this->saveToInstanceThis();
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
   
   public static function getCount($params = array())
   {
   	
   	if (isset($params['switch_db'])) {
	   	$db = ezcDbInstance::get();
	   		
	   	$cfg = erConfigClassLhConfig::getInstance();
	   	$db->query('USE '.$cfg->getSetting( 'db', 'database' ));
   	}
	   	
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
      
   	if (isset($params['switch_db'])) {
	   		$db->query('USE '.$cfg->getSetting( 'db', 'database_user_prefix').erLhcoreClassInstance::$instanceChat->id);
	   	}
      return $result;
   }

   public static function getList($paramsSearch = array())
   {
   	if (isset($paramsSearch['switch_db'])) {
   		$db = ezcDbInstance::get();
   	
   		$cfg = erConfigClassLhConfig::getInstance();
   		$db->query('USE '.$cfg->getSetting( 'db', 'database' ));
   	}
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
       

       if (isset($paramsSearch['switch_db'])) {
       	$db->query('USE '.$cfg->getSetting( 'db', 'database_user_prefix').erLhcoreClassInstance::$instanceChat->id);
       }
       
      return $objects;
   }

   const PENDING_CREATE = 0;
   const WORKING = 1;

   public $id = null;
   public $request = 0;   
   public $expires = 0;
   public $address = '';
   public $full_domain = 0;
   public $email = '';
   public $time_zone = '';
   public $date_format = 'Y-m-d';
   public $date_hour_format = 'H:i:s';
   public $date_date_hour_format = 'Y-m-d H:i:s';
   public $status = self::PENDING_CREATE;
   public $files_supported = 1;
   public $atranslations_supported = 1;
   public $cobrowse_supported = 1;
   public $cobrowse_forms_supported = 1;
   public $forms_supported = 1;
   public $cannedmsg_supported = 1;
   public $faq_supported = 1;
   public $feature_1_supported = 1;
   public $feature_2_supported = 1;
   public $feature_3_supported = 1;   
   public $feature_4_supported = 1;   
   public $feature_5_supported = 1;   
   public $feature_6_supported = 1;   
   public $reporting_supported = 1;
   public $chatbox_supported = 1;
   public $browseoffers_supported = 1;
   public $questionnaire_supported = 1;
   public $proactive_supported = 1;
   public $screenshot_supported = 1;
   public $blocked_supported = 1;
   public $footprint_supported = 1;
   public $previouschats_supported = 1;
   public $chatremarks_supported = 1;
   public $autoresponder_supported = 1;
   public $geoadjustment_supported = 1;
   public $onlinevisitortrck_supported = 1;
   public $speech_supported = 1;   
   public $transfer_supported = 1;   
   public $operatorschat_supported = 1;
   public $chat_supported = 1;
   public $xmpp_supported = 1;
   public $offline_supported = 1;
   public $sugarcrm_supported = 1;
   
   public $phone_number_data = '';   
   public $sms_left = 0;   
   public $sms_plan = 1000;   
   public $soft_limit_type = 0;   
   public $soft_limit = 15;   
   public $hard_limit_type = 0;   
   public $hard_limit = -15;   
   public $sms_processed = 0;   
   public $sms_supported = 0;   
   public $soft_warning_send = 0;   
   public $hard_warning_send = 0;
      
   public $attr_int_1 = 0;   
   public $attr_int_2 = 0;   
   public $attr_int_3 = 0;   
   public $attr_int_4 = 0;   
   public $attr_int_5 = 0;   
   public $attr_int_6 = 0;   

   public $max_operators = 0;
   public $one_per_account = 0;
   
   public $is_reseller = 0;
   public $client_title = '';
   public $reseller_tite = '';
   public $reseller_max_instance_request = 0;
   public $reseller_secret_hash = '';
   public $reseller_max_instances = 0;
   public $reseller_id = 0;
   public $reseller_request = 0;
   public $phone_default_department = 0;
   public $phone_response_data = '';   
   public $phone_response_timeout_data = '';
   public $client_attributes = '';
   public $default_url = '';
   
   public $full_xmpp_chat_supported = 1;
   public $full_xmpp_visitors_tracking = 1;
   
   public $expire_inform_status = 0;
   public $is_remote = 0;
   
   public $custom_fields_1 = '';
   public $custom_fields_2 = '';
   public $custom_fields_3 = '';
   public $custom_fields_4 = '';
   public $custom_fields_5 = '';
   public $custom_fields_6 = '';
      
   // Then reseller get's suspended this attribute is set to 1, to avoid double fetching each time in instance part.
   public $reseller_suspended = 0;
   
   public $locale = '';
   public $siteaccess = 'eng';
   
   public $login_ip_security = '';
}

?>