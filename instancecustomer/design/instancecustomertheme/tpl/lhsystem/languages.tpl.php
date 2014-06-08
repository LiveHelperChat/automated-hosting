<h1><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/languages','Languages configuration')?></h1>
<?php if (isset($errors)) : ?>
		<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
<?php endif; ?>

<?php if (isset($updated)) : $msg = erTranslationClassLhTranslation::getInstance()->getTranslation('system/languages','Settings updated'); ?>
	<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success.tpl.php'));?>
<?php endif; ?>


<div class="section-container auto" data-section>

  <?php if ($currentUser->hasAccessTo('lhsystem','changelanguage')) : ?>
  <section <?php if ($tab == '') : ?>class="active"<?php endif;?>>
	<p class="title" data-section-title><a href="#panel1"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/languages','Your language');?></a></p>
	<div class="content" data-section-content>
		<div>
			<form action="<?php echo erLhcoreClassDesign::baseurl('system/languages')?>" method="post">
				<?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>
				<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/languages','Language')?></label>
				<select name="language">
					<?php
					$userLanguage = erLhcoreClassModelUserSetting::getSetting('user_language',erLhcoreClassSystem::instance()->Language);
					foreach (erLhcoreClassSiteaccessGenerator::getLanguages() as $language) : ?>
						<option value="<?php echo $language['locale']?>" <?php $userLanguage == $language['locale'] ? print 'selected="selected"' : ''?>><?php echo $language['locale']?></option>
					<?php endforeach;?>
				</select>

				<input type="hidden" name="StoreUserSettings" value="1" />
				<input type="submit" class="button small round" name="StoreUserSettingsAction" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Save'); ?>" />
			</form>
		</div>
	</div>
  </section>
  <?php endif; ?>

</div>

