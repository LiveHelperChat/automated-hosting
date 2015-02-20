<div class="form-group">											 
	<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Files supported')?> <input disabled <?php echo $instance->files_supported == 1 ? 'checked="checked"' : ''?> type="checkbox" value="on" name="files_supported" ></label>
</div>

<div class="form-group">											 
	<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Automatic translations supported')?> <input disabled <?php echo $instance->atranslations_supported == 1 ? 'checked="checked"' : ''?> type="checkbox" value="on" name="atranslations_supported" ></label>
</div>

<div class="form-group">											 
	<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Co-Browse supported')?> <input disabled <?php echo $instance->cobrowse_supported == 1 ? 'checked="checked"' : ''?> type="checkbox" value="on" name="cobrowse_supported" ></label>
</div>