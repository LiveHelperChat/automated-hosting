<?php 

$instance = erLhcoreClassInstance::getInstance();
$hashValidation = sha1(erConfigClassLhConfig::getInstance()->getSetting('site','seller_secret_hash').sha1(erConfigClassLhConfig::getInstance()->getSetting('site','seller_secret_hash').$instance->address.$Params['user_parameters']['ts']));

if (time() < $Params['user_parameters']['ts']+60 && (time() + 61) > $Params['user_parameters']['ts'] && $hashValidation == $Params['user_parameters']['hash']) {
    $users = erLhcoreClassModelUser::getUserList(array('limit' => 1,'sort' => 'id ASC'));    
    if (!empty($users)) {
        $user = array_shift($users);
        
        // Login user and redirect
        erLhcoreClassUser::instance()->setLoggedUser($user->id);
        header('Location: ' .erLhcoreClassDesign::baseurldirect('site_admin'));
        exit;
                
    } else {
        die('Could not find a user');
    } 
    
} else {
    die('Invalid hash or it has expired');
}
exit;
?>