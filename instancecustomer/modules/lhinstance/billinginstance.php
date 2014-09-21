<?php

$tpl = erLhcoreClassTemplate::getInstance('lhinstance/billinginstance.tpl.php');

$db = ezcDbInstance::get(); // Needed to load correct data
$instance = erLhcoreClassInstance::getInstance();
$tpl->set('instance',$instance);

if ($instance->is_reseller) {
	
	$pagesInstances = new lhPaginator();
	$pagesInstances->items_total = erLhcoreClassModelInstance::getCount(array('switch_db' => true,'filter' => array('reseller_id' => $instance->id)));
	$pagesInstances->translationContext = 'instance/billing';
	$pagesInstances->serverURL = erLhcoreClassDesign::baseurl('instance/billinginstance');
	$pagesInstances->setItemsPerPage(20);
	$pagesInstances->paginate();
	
	$tpl->set('pagesInstance',$pagesInstances);
	
	$items = array();
	if ($pagesInstances->items_total > 0) {
		$items = erLhcoreClassModelInstance::getList(array('switch_db' => true,'filter' => array('reseller_id' => $instance->id),'offset' => $pagesInstances->low, 'limit' => $pagesInstances->items_per_page));
	}
	
	$tpl->set('itemsInstance',$items);
}

$Result['content'] = $tpl->fetch();
$Result['path'] = array(array('title' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Billing instance')));

?>