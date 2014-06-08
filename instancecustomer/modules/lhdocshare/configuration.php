<?php

$tpl = erLhcoreClassTemplate::getInstance( 'lhdocshare/configuration.tpl.php');

$docSharer = erLhcoreClassModelChatConfig::fetch('doc_sharer');
$data = (array)$docSharer->data;

if ( isset($_POST['StoreConfiguration']) ) {

    $definition = array( 
        'MaxFileSize' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'int', array('min_range' => 2)
        ),       
        'PdftoppmLimit' => new ezcInputFormDefinitionElement(
            ezcInputFormDefinitionElement::OPTIONAL, 'int', array('min_range' => 0)
        )       
    );

    $Errors = array();

    $form = new ezcInputForm( INPUT_POST, $definition );
    $Errors = array();

    if (!isset($_POST['csfr_token']) || !$currentUser->validateCSFRToken($_POST['csfr_token'])) {
    	erLhcoreClassModule::redirect('docshare/configuration');
    	exit;
    }

    if ( $form->hasValidData( 'PdftoppmLimit' ) ) {
    	$data['pdftoppm_limit'] = $form->PdftoppmLimit;
    } else {
    	$data['pdftoppm_limit'] = '0';
    }
  
    if ( $form->hasValidData( 'MaxFileSize' )) {
    	$data['max_file_size'] = $form->MaxFileSize;
    } else {
    	$data['max_file_size'] = 2;
    }

    if (count($Errors) == 0) {
        $docSharer->value = serialize($data);
        $docSharer->saveThis();
        $tpl->set('updated','done');
    }  else {
        $tpl->set('errors',$Errors);
    }
}

$tpl->set('docsharer_data',$data);

$Result['content'] = $tpl->fetch();
$Result['path'] = array(
array('url' => erLhcoreClassDesign::baseurl('docshare/index'), 'title' => erTranslationClassLhTranslation::getInstance()->getTranslation('docshare/index','Documents sharer')),
array('title' => erTranslationClassLhTranslation::getInstance()->getTranslation('docshare/configuration','Documents sharer configuration')));

?>