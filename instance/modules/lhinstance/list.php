<?php

try {
	$tpl = erLhcoreClassTemplate::getInstance( 'lhinstance/list.tpl.php');

	if (isset($_GET['doSearch'])) {
	    $filterParams = erLhcoreClassSearchHandler::getParams(array('customfilterfile' => 'extension/instance/classes/filter/filter.php', 'format_filter' => true, 'use_override' => true, 'uparams' => $Params['user_parameters_unordered']));
	    $filterParams['is_search'] = true;
	} else {
	    $filterParams = erLhcoreClassSearchHandler::getParams(array('customfilterfile' => 'extension/instance/classes/filter/filter.php', 'format_filter' => true, 'uparams' => $Params['user_parameters_unordered']));
	    $filterParams['is_search'] = false;
	}
	
	$append = erLhcoreClassSearchHandler::getURLAppendFromInput($filterParams['input_form']);

	$pages = new lhPaginator();
	$pages->items_total = erLhcoreClassModelInstance::getCount($filterParams['filter']);
	$pages->translationContext = 'abstract/list';
	$pages->serverURL = erLhcoreClassDesign::baseurl('instance/list') . $append;
	$pages->setItemsPerPage(20);
	$pages->paginate();

	$tpl->set('pages',$pages);
	
	$filterParams['input_form']->form_action = erLhcoreClassDesign::baseurl('instance/list');
	
	$tpl->set('input',$filterParams['input_form']);
	
	$items = array();
	if ($pages->items_total > 0) {
	    $items = erLhcoreClassModelInstance::getList(array_merge($filterParams['filter'],array('offset' => $pages->low, 'limit' => $pages->items_per_page,'sort' => 'id ASC')));
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