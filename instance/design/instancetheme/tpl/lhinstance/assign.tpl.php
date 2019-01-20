<h1><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Assigned instances');?> - <?php echo htmlspecialchars($instance->address)?></h1>

<?php if (isset($errors)) : ?>
	<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
<?php endif; ?>

<?php if (isset($updated)) : $msg = erTranslationClassLhTranslation::getInstance()->getTranslation('user/account','Updated'); ?>
	<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success.tpl.php'));?>
<?php endif; ?>

<form class="form-inline" method="post" action="<?php echo erLhcoreClassDesign::baseurl('instance/assign')?>/<?php echo $instance->id?>">
  <div class="form-group">
     <input type="text" name="InstanceAddress" class="form-control" placeholder="Instance address">
  </div>
  <button type="submit" name="AssignInstance" class="btn btn-secondary">Assign</button>
</form>

<?php $listInstancesParams = array(
   'show_unasign' => true,
   'show_configuration' => true,
); ?>
<?php include(erLhcoreClassDesign::designtpl('lhinstance/list_body.tpl.php')); ?>

<?php if (isset($pages)) : ?>
    <?php include(erLhcoreClassDesign::designtpl('lhkernel/paginator.tpl.php')); ?>
<?php endif;?>