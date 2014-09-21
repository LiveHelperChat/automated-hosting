<?php

try {
	$tpl = erLhcoreClassTemplate::getInstance( 'lhinstance/invoices.tpl.php');


	$pages = new lhPaginator();
	$pages->items_total = erLhcoreClassModelInstanceInvoice::getCount();
	$pages->translationContext = 'abstract/list';
	$pages->serverURL = erLhcoreClassDesign::baseurl('instance/invoices');
	$pages->setItemsPerPage(20);
	$pages->paginate();

	$tpl->set('pages',$pages);

	$items = array();
	if ($pages->items_total > 0) {
	    $items = erLhcoreClassModelInstanceInvoice::getList(array('offset' => $pages->low, 'limit' => $pages->items_per_page));
	}

	$tpl->set('items',$items);
	$tpl->set('pages',$pages);

	$Result['content'] = $tpl->fetch();

	$Result['path'] = array(array('url' => erLhcoreClassDesign::baseurl('system/configuration'),'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('system/htmlcode','System configuration')),
			array('title' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Invoices'))
	);
	
} catch (Exception $e) {
	print_r($e);
}

?>