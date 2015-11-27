<?php

$tpl = erLhcoreClassTemplate::getInstance('lhinstance/assign.tpl.php');
$Instance = erLhcoreClassModelInstance::fetch((int) $Params['user_parameters']['instance_id']);

/**
 * Assign Instance
 * */
if (isset($_POST['AssignInstance'])) {

    $definition = array (
        'InstanceAddress' => new ezcInputFormDefinitionElement(ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'),
    );

    $form = new ezcInputForm(INPUT_POST, $definition);
    $Errors = array();

    if ($form->hasValidData('InstanceAddress') && $form->InstanceAddress != '') {

        $instanceAssign = erLhcoreClassModelInstance::findOne(array('filter' => array('address' => $form->InstanceAddress)));

        if ($instanceAssign !== false && $instanceAssign->reseller_id !== $Instance->id) {
            $instanceAssign->reseller_id = $Instance->id;
            $instanceAssign->saveThis();
        }
    }
}

/**
 * Unasign instance
 */
if (is_numeric($Params['user_parameters_unordered']['unasign']) && $Params['user_parameters_unordered']['unasign'] > 0) {
    $instanceAssign = erLhcoreClassModelInstance::fetch($Params['user_parameters_unordered']['unasign']);
    $instanceAssign->reseller_id = 0;
    $instanceAssign->saveThis();
}

/**
 * Child instances
 * */
$pages = new lhPaginator();
$pages->items_total = erLhcoreClassModelInstance::getCount(array('filter' => array('reseller_id' => $Instance->id)));
$pages->translationContext = 'abstract/list';
$pages->serverURL = erLhcoreClassDesign::baseurl('instance/assign') . '/' . $Instance->id;
$pages->setItemsPerPage(20);
$pages->paginate();

$tpl->set('pages',$pages);

$items = array();
if ($pages->items_total > 0) {
    $items = erLhcoreClassModelInstance::getList(array('filter' => array('reseller_id' => $Instance->id), 'offset' => $pages->low, 'limit' => $pages->items_per_page, 'sort' => 'id ASC'));
}

$tpl->set('items',$items);
$tpl->set('pages',$pages);

$tpl->set('instance',$Instance);

$Result['content'] = $tpl->fetch();
$Result['path'] = array(
    array(
        'url' => erLhcoreClassDesign::baseurl('system/configuration'),
        'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('department/edit', 'System configuration')
    ),
    array(
        'url' => erLhcoreClassDesign::baseurl('instance/list'),
        'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Instances')
    ),
    array(
        'url' => erLhcoreClassDesign::baseurl('instance/edit') . '/' . $Instance->id,
        'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Instance') . ' - ' . $Instance->address
    ),
    array(
        'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Child instances')
    )
);

?>