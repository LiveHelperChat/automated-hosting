<?php

$cfg = erConfigClassLhConfig::getInstance();
$secretHash = $cfg->getSetting('site', 'seller_secret_hash');
$validateHash = sha1((string) $Params['user_parameters']['id'] . (string) $Params['user_parameters']['date'] . $secretHash . '_' . (string) $Params['user_parameters']['operators']);

if ((string) $Params['user_parameters']['hash'] == $validateHash && $Params['user_parameters']['id'] == erLhcoreClassInstance::$instanceChat->id && date('Ym') == (string) $Params['user_parameters']['date']) {
    
    if ($Params['user_parameters']['operators'] > 0) {
        $userCount = erLhcoreClassModelUser::getUserCount(array(
            'filter' => array(
                'disabled' => 0
            )
        ));
        
        // We have to disable exceeded users
        if ($userCount > $Params['user_parameters']['operators']) {
            $users = erLhcoreClassModelUser::getUserList(array(
                'sort' => 'id ASC',
                'filter' => array('disabled' => 0),
                'offset' => (int) $Params['user_parameters']['operators'],
                'limit' => 100000000
            ));
            
            foreach ($users as $user) {
                $user->disabled = 1;
                $user->saveThis();
            }
        }
    }
    
    echo "ok";
    
} else {
    echo 'Invalid hash';
}

exit();