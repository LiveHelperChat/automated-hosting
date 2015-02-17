<h1><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/languages','Languages configuration')?></h1>
<?php if (isset($errors)) : ?>
		<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
<?php endif; ?>

<?php if (isset($updated)) : $msg = erTranslationClassLhTranslation::getInstance()->getTranslation('system/languages','Settings updated'); ?>
	<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success.tpl.php'));?>
<?php endif; ?>

<div role="tabpanel">

	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">	
	    <?php if ($currentUser->hasAccessTo('lhsystem','changelanguage')) : ?>
		<li role="presentation" <?php if ($tab == '') : ?> class="active" <?php endif;?>><a href="#yourlanguage" aria-controls="yourlanguage" role="tab" data-toggle="tab"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/languages','Your language');?></a></li>
		<?php endif;?>					
	</ul>

	<div class="tab-content">
	  <?php if ($currentUser->hasAccessTo('lhsystem','changelanguage')) : ?>
	  <div role="tabpanel" class="tab-pane active" id="yourlanguage">
			<form action="<?php echo erLhcoreClassDesign::baseurl('system/languages')?>" method="post">
    				<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>
    				
    				<div class="form-group">
        				<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/languages','Language')?></label> 
        				<select name="language" class="form-control">
        					<?php
                                $userLanguage = erLhcoreClassModelUserSetting::getSetting('user_language', erLhcoreClassSystem::instance()->Language);
                                foreach (erLhcoreClassSiteaccessGenerator::getLanguages() as $language) :
                            ?>
        						<option value="<?php echo $language['locale']?>" <?php $userLanguage == $language['locale'] ? print 'selected="selected"' : ''?>><?php echo $language['locale']?></option>
        					<?php endforeach;?>
        				</select> 
    				</div>
    				
    				<input type="hidden" name="StoreUserSettings" value="1" /> 
    				<input type="submit" class="btn btn-default" name="StoreUserSettingsAction" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Save'); ?>" />
			</form>
		</div>
	  <?php endif;?>
	</div>
</div>