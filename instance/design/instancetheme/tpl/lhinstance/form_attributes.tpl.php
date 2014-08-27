<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Date format')?></label>
<input type="text" value="<?php echo $instance->date_format?>" name="DateFormat">			

<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Hour format')?></label>
<input type="text" value="<?php echo $instance->date_hour_format?>" name="DateHourFormat">	

<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Date and hour format')?></label>
<input type="text" value="<?php echo $instance->date_date_hour_format?>" name="DateAndHourFormat">	
	
<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Instance time zone');?></label>
<?php $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL); ?>
<select name="UserTimeZone">
		<option value="">[[<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('user/edit','Application default time zone');?>]]</option>
	<?php foreach ($tzlist as $zone) : ?>
		<option value="<?php echo htmlspecialchars($zone)?>" <?php $instance->time_zone == $zone ? print 'selected="selected"' : ''?>><?php echo htmlspecialchars($zone)?></option>
	<?php endforeach;?>
</select>

<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Default frontend users site access')?></label>
		<select name="FrontSiteaccess">
            <?php foreach ($locales as $locale ) : ?>
            <option value="<?php echo $locale?>" <?php $instance->siteaccess == $locale ? print 'selected="selected"' : ''?> ><?php echo $locale?></option>
            <?php endforeach; ?>
        </select>
								
        <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Default operators language')?></label>
<select name="Language">
	<?php foreach (erLhcoreClassSiteaccessGenerator::getLanguages() as $language) : ?>
		<option value="<?php echo $language['locale']?>" <?php $instance->locale == $language['locale'] ? print 'selected="selected"' : ''?>><?php echo $language['locale']?></option>
	<?php endforeach;?>
</select>