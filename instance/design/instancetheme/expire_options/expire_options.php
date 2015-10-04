<?php
/**
 * Settings specification
 * 
 * First one (Pre-Expiration Notice) is sent 10 days before expiration. 
 * Second one (Expiration Notice) is sent day of expiration. 
 * Third one (Post-Expiration Notice) is sent 10 days after expiration.
 * 
 * */
return array(
    array(
        'filter' => array(
            'filterlt' => array(
                'expires' => time() + (10 * 24 * 3600)
            ),
            'filtergt' => array(
                'expires' => 0
            ),
            'filter' => array(
                'expire_inform_status' => 0
            )
        ),
        'template' => 'case1.tpl.php',
        'set' => array(
            'expire_inform_status' => 1
        ),
        'mail' => array(
            'subject' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Your instance will expire in 10 days')
        ),
        'enabled' => false
    ),
    array(
        'filter' => array(
            'filterlt' => array(
                'expires' => time() + (1 * 24 * 3600)
            ),
            'filtergt' => array(
                'expires' => 0
            ),
            'filter' => array(
                'expire_inform_status' => 1
            )
        ),
        'template' => 'case2.tpl.php',
        'set' => array(
            'expire_inform_status' => 2
        ),
        'mail' => array(
            'subject' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Your instance will expire in 1 day')
        ),
        'enabled' => false
    ),
    array(
        'filter' => array(
            'filterlt' => array(
                'expires' => time() - (24 * 3600 * 10)
            ),
            'filtergt' => array(
                'expires' => 0
            ),
            'filter' => array(
                'expire_inform_status' => 2
            )
        ),
        'template' => 'case3.tpl.php',
        'mail' => array(
            'subject' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Your instance has expired 10 days ago')
        ),
        'set' => array(
            'expire_inform_status' => 3
        ),
        'enabled' => false
    )
);

?>