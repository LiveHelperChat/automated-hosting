<?php

$tpl = erLhcoreClassTemplate::getInstance('lhinstance/billing.tpl.php');

$db = ezcDbInstance::get(); // Needed to load correct data
$tpl->set('instance',erLhcoreClassInstance::getInstance());

$Result['content'] = $tpl->fetch();
$Result['path'] = array(array('title' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Billing')));

?>