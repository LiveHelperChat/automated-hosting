<?php

class erLhcoreClassInstanceAPI {

   public static function getInstanceByHost($host)
   {
       $cfg = erConfigClassLhConfig::getInstance();
       
       $subdomain = str_replace('.'.$cfg->getSetting( 'site', 'seller_domain'), '', $host);
       
       $session = erLhcoreClassInstance::getSession();
       $q = $session->createFindQuery('erLhcoreClassModelInstance');
       $q->where( $q->expr->eq( 'address', $q->bindValue( $subdomain ) ) . ' OR (full_domain = 1 AND ' . $q->expr->eq( 'address', $q->bindValue( $host ) ). ')' );
       $items = $session->find($q);
       
       if (empty($items)) {
           throw new Exception('Host not found!');
       }
       
       $item = array_shift($items);
       
       return $item;
   }   
}

?>