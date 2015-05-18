<?php if (erLhcoreClassInstance::getInstance()->max_operators > 0 && erLhcoreClassModelUser::getUserCount()+1 > erLhcoreClassInstance::getInstance()->max_operators) : 
$errorsOriginal = isset($errors) ? $errors : false;
$errors = array(erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','You have exceeded maximum number of allowed operators!')); ?>
	<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
<?php 

if ($errorsOriginal == false) {
	unset($errors);
} else {
	$errors = $errorsOriginal;
}

endif;?>