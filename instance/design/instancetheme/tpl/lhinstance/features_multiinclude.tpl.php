<div class="form-group">											 
	<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Feature 1')?> <input <?php echo $instance->feature_1_supported == 1 ? 'checked="checked"' : ''?> type="checkbox" value="on" name="feature_1_supported" ></label>
</div>

<div class="form-group">											 
	<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Feature 2')?> <input <?php echo $instance->feature_2_supported == 1 ? 'checked="checked"' : ''?> type="checkbox" value="on" name="feature_2_supported" ></label>
</div>

<div class="form-group">											 
	<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Feature 3')?> <input <?php echo $instance->feature_3_supported == 1 ? 'checked="checked"' : ''?> type="checkbox" value="on" name="feature_3_supported" ></label>
</div>