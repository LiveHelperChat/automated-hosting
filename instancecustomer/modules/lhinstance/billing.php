<?php

$tpl = erLhcoreClassTemplate::getInstance('lhinstance/billing.tpl.php');

$db = ezcDbInstance::get(); // Needed to load correct data
$instance = erLhcoreClassInstance::getInstance();
$tpl->set('instance',$instance);

$pages = new lhPaginator();
$pages->items_total = erLhcoreClassModelInstanceInvoice::getCount(array('filter' => array('instance_id' => $instance->id)));
$pages->translationContext = 'instance/billing';
$pages->serverURL = erLhcoreClassDesign::baseurl('instance/billing');
$pages->setItemsPerPage(20);
$pages->paginate();

$tpl->set('pages',$pages);

$items = array();
if ($pages->items_total > 0) {
	$items = erLhcoreClassModelInstanceInvoice::getList(array('filter' => array('instance_id' => $instance->id),'offset' => $pages->low, 'limit' => $pages->items_per_page));
}

$tpl->set('items',$items);

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
$Result['path'] = array(array('title' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Billing')));

?>