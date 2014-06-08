<h1><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('docshare/configuration','Configuration');?></h1>

<?php if (isset($errors)) : ?>
	<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
<?php endif; ?>

<?php if (isset($updated) && $updated == 'done') : $msg = erTranslationClassLhTranslation::getInstance()->getTranslation('docshare/configuration','Settings updated'); ?>
	<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success.tpl.php'));?>
<?php endif; ?>

<form action="" method="post">

<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>

<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('docshare/configuration','Maximum number of pages to conver, 0 for no limit'); ?></label>
<input type="text" name="PdftoppmLimit" value="<?php isset($docsharer_data['pdftoppm_limit']) ? print $docsharer_data['pdftoppm_limit'] : print '0' ?>">

<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('docshare/configuration','Maximum file size in MB')?></label>
<input type="text" name="MaxFileSize" value="<?php isset($docsharer_data['max_file_size']) ? print $docsharer_data['max_file_size'] : print '2' ?>">

<input type="submit" class="button small radius" name="StoreConfiguration" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Save'); ?>" />

</form>