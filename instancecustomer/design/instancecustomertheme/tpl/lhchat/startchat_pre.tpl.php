<?php $chat_startchat_enabled = erLhcoreClassInstance::getInstance()->is_active;?>

<?php if ($chat_startchat_enabled === false) : ?>

<?php $errors = array('Your instance has reached the limit of request!')?>

<?php if (isset($errors)) : ?>
		<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
<?php endif; ?>

<?php endif; ?>