<h1><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','New instance');?></h1>

<?php if (isset($errors)) : ?>
	<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
<?php endif; ?>

<form action="<?php echo erLhcoreClassDesign::baseurl('instance/new')?>" method="post">

	<?php include(erLhcoreClassDesign::designtpl('lhinstance/form.tpl.php'));?>

	<?php include(erLhcoreClassDesign::designtpl('lhinstance/form_attributes.tpl.php'));?>
	
	<?php include(erLhcoreClassDesign::designtpl('lhinstance/form_reseller.tpl.php'));?>
		
	<?php include(erLhcoreClassDesign::designtpl('lhinstance/features.tpl.php'));?>
		
	<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>

	<div class="btn-group" role="group" aria-label="...">
        <input type="submit" class="btn btn-default" name="Save_departament" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Save');?>"/>
        <input type="submit" class="btn btn-default" name="Cancel_departament" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Cancel');?>"/>
    </div>
    
</form>
