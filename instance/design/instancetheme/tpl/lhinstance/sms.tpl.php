<div class="row">
	<div class="columns col-xs-8">

		<div class="form-group">
			<label><input <?php echo $instance->sms_supported == 1 ? 'checked="checked"' : ''?> type="checkbox" value="on" name="sms_supported"> <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','SMS supported')?></label>
		</div>

		<div class="form-group">
			<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Phone number')?></label> <input class="form-control" type="text" value="<?php echo htmlspecialchars($instance->phone_number)?>" name="phone_number" autocomplete="off">
		</div>

		<div class="form-group">
			<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Add SMS to user, Enter how many sms you want to add to user')?></label> <input placeholder="Number" class="form-control" type="text" value="" name="add_sms_to_user" autocomplete="off">
		</div>

		<div class="row">
			<div class="columns col-xs-6">
				<div class="form-group">
					<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','SMS left')?></label> <input class="form-control" type="text" disabled="disabled" value="<?php echo htmlspecialchars($instance->sms_left)?>" autocomplete="off">
				</div>
			</div>
			<div class="columns col-xs-6">
				<div class="form-group">
					<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Total SMS send during lifetime')?></label> <input class="form-control" type="text" disabled="disabled" value="<?php echo htmlspecialchars($instance->sms_processed)?>" autocomplete="off">
				</div>
			</div>
		</div>

		<div class="form-group">
			<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','SMS plan, current user SMS plan from which limits are calculated')?></label> <input class="form-control" type="text" value="<?php echo htmlspecialchars($instance->sms_plan)?>" name="sms_plan" placeholder="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Number')?>" autocomplete="off">
		</div>

		<div class="row">
			<div class="columns col-xs-6">
				<div class="form-group">
					<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Soft limit type')?></label><select name="soft_limit_type" class="form-control">
						<option value="0" <?php echo $instance->soft_limit_type == 0 ? 'selected="selected"' : ''?>><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Percentenge')?></option>
						<option value="1" <?php echo $instance->soft_limit_type == 1 ? 'selected="selected"' : ''?>><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Number')?></option>
					</select>
				</div>
			</div>
			<div class="columns col-xs-6">
				<div class="form-group">
					<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Soft limit value')?></label> <input name="soft_limit" placeholder="Number" class="form-control" type="text" value="<?php echo htmlspecialchars($instance->soft_limit)?>" autocomplete="off">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="columns col-xs-6">
				<div class="form-group">
					<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Hard limit type')?></label><select name="hard_limit_type" class="form-control">
						<option value="0" <?php echo $instance->hard_limit_type == 0 ? 'selected="selected"' : ''?>><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Percentenge')?></option>
						<option value="1" <?php echo $instance->hard_limit_type == 1 ? 'selected="selected"' : ''?>><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Number')?></option>
					</select>
				</div>
			</div>
			<div class="columns col-xs-6">
				<div class="form-group">
					<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Hard limit value')?></label> <input class="form-control" type="text" placeholder="Number" value="<?php echo htmlspecialchars($instance->hard_limit)?>" name="hard_limit" autocomplete="off">
				</div>
			</div>
		</div>
	</div>
	<div class="columns col-xs-4">
        <ul>
            <li><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Can send SMS')?> - <b><?php $instance->can_send_sms == 1 ? print 'Y' : print 'N'?></b></li>
            <li><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','SMS left')?> - (<b><?php echo $instance->sms_used_percentenge?>%</b>)</li>
            <li><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Soft limit in effect')?> - <b><?php $instance->soft_limit_in_effect == true ? print 'Y' : print 'N'?></b></li>
            <li><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Soft warning send')?> - <b><?php $instance->soft_warning_send == 1 ? print 'Y' : print 'N'?></b></li>
            <li><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Hard limit in effect')?> - <b><?php $instance->hard_limit_in_effect == 1 ? print 'Y' : print 'N'?></b></li>
            <li><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Hard warning send')?> - <b><?php $instance->hard_warning_send == 1 ? print 'Y' : print 'N'?></b></li>
        </ul>       
	</div>
</div>

<input type="submit" class="btn btn-default" name="UpdateSMS" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Update')?>" />

