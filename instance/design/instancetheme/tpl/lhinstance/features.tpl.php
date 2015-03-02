<div class="form-group">											 
	<label><input <?php echo $instance->files_supported == 1 ? 'checked="checked"' : ''?> type="checkbox" value="on" name="files_supported" > <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Files supported')?> </label>
</div>

<div class="form-group">											 
	<label><input <?php echo $instance->atranslations_supported == 1 ? 'checked="checked"' : ''?> type="checkbox" value="on" name="atranslations_supported" > <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Automatic translations supported')?></label>
</div>

<div class="form-group">											 
	<label><input <?php echo $instance->cobrowse_supported == 1 ? 'checked="checked"' : ''?> type="checkbox" value="on" name="cobrowse_supported" > <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Co-Browse supported')?> </label>
</div>

<div class="form-group">											 
	<label><input <?php echo $instance->forms_supported == 1 ? 'checked="checked"' : ''?> type="checkbox" value="on" name="forms_supported" > <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Forms supported')?></label>
</div>

<div class="form-group">											 
	<label><input <?php echo $instance->cannedmsg_supported == 1 ? 'checked="checked"' : ''?> type="checkbox" value="on" name="cannedmsg_supported" > <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Canned messages supported')?></label>
</div>

<div class="form-group">											 
	<label><input <?php echo $instance->faq_supported == 1 ? 'checked="checked"' : ''?> type="checkbox" value="on" name="faq_supported" > <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','FAQ supported')?></label>
</div>

<div class="form-group">											 
	<label><input <?php echo $instance->reporting_supported == 1 ? 'checked="checked"' : ''?> type="checkbox" value="on" name="reporting_supported" > <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Reporting supported')?></label>
</div>

<div class="form-group">											 
	<label><input <?php echo $instance->chatbox_supported == 1 ? 'checked="checked"' : ''?> type="checkbox" value="on" name="chatbox_supported" > <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Chatbox supported')?> </label>
</div>

<div class="form-group">											 
	<label><input <?php echo $instance->browseoffers_supported == 1 ? 'checked="checked"' : ''?> type="checkbox" value="on" name="browseoffers_supported" > <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Browse offers supported')?></label>
</div>

<div class="form-group">											 
	<label><input <?php echo $instance->questionnaire_supported == 1 ? 'checked="checked"' : ''?> type="checkbox" value="on" name="questionnaire_supported" > <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Questionnaire supported')?></label>
</div>

<div class="form-group">											 
	<label><input <?php echo $instance->proactive_supported == 1 ? 'checked="checked"' : ''?> type="checkbox" value="on" name="proactive_supported" > <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Proactive supported')?></label>
</div>

<div class="form-group">											 
	<label><input <?php echo $instance->screenshot_supported == 1 ? 'checked="checked"' : ''?> type="checkbox" value="on" name="screenshot_supported" > <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Screenshot supported')?></label>
</div>

<div class="form-group">											 
	<label><input <?php echo $instance->blocked_supported == 1 ? 'checked="checked"' : ''?> type="checkbox" value="on" name="blocked_supported" > <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Block users supported')?></label>
</div>
               
<?php include(erLhcoreClassDesign::designtpl('lhinstance/features_multiinclude.tpl.php'));?>

<input type="submit" class="btn btn-default" name="UpdateFeatures" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Update');?>"/>				  
	
