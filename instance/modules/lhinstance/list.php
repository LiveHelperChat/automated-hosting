<?php

try {
	$tpl = erLhcoreClassTemplate::getInstance( 'lhinstance/list.tpl.php');


	$pages = new lhPaginator();
	$pages->items_total = erLhcoreClassModelInstance::getCount();
	$pages->translationContext = 'abstract/list';
	$pages->serverURL = erLhcoreClassDesign::baseurl('instance/list');
	$pages->setItemsPerPage(20);
	$pages->paginate();

	$tpl->set('pages',$pages);

	$items = array();
	if ($pages->items_total > 0) {
	    $items = erLhcoreClassModelInstance::getList(array('offset' => $pages->low, 'limit' => $pages->items_per_page,'sort' => 'id ASC'));
	}

	$tpl->set('items',$items);
	$tpl->set('pages',$pages);

	$Result['content'] = $tpl->fetch();

	$Result['path'] = array(array('url' => erLhcoreClassDesign::baseurl('system/configuration'),'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('system/htmlcode','System configuration')),
			array('title' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Instances'))
	);
} catch (Exception $e) {
	print_r($e);
}

?>