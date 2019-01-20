<div class="row">
	<div class="columns col-8">

		<div class="form-group">
			<label><input <?php echo $instance->sms_supported == 1 ? 'checked="checked"' : ''?> type="checkbox" value="on" name="sms_supported"> <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','SMS supported')?></label>
		</div>

		<div class="row">
			<div class="columns col-6">
				<div class="form-group">
					<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','SMS message send to the user')?></label> <input class="form-control" type="text" disabled="disabled" title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','SMS text which should receive user')?>" value="<?php echo htmlspecialchars($instance->phone_response)?>" autocomplete="off">
				</div>
			</div>
			<div class="columns col-6">
				<div class="form-group">
					<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Automatic SMS responder timeout in minits, zero means disabled')?></label> <input class="form-control" type="text" disabled="disabled" title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','After how many minits system should send SMS to user, changeable by user')?>" value="<?php echo htmlspecialchars($instance->phone_response_timeout)?>" autocomplete="off">
				</div>
			</div>
		</div>


		<div class="row">		 
		   <?php foreach ($instance->phone_number as $key => $phoneNumber) : $numberRow = $key + 1;?>
		   <div class="columns col-4">
				<div class="form-group">
					<label><?php echo $numberRow?>. <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Phone and department')?></label>
					<div class="input-group">
						<input class="form-control" type="text" value="<?php echo htmlspecialchars($phoneNumber['phone'])?>" name="phone_number[<?php echo $key?>]" autocomplete="off">
						<div class="input-group-addon"><?php echo htmlspecialchars($phoneNumber['department'])?></div>
					</div>
				</div>
			</div>
		  <?php endforeach;?>
		</div>

		<div class="form-group">
			<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Add SMS to user, Enter how many sms you want to add to user')?></label> <input placeholder="Number" class="form-control" type="text" value="" name="add_sms_to_user" autocomplete="off">
		</div>

		<div class="row">
			<div class="columns col-6">
				<div class="form-group">
					<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','SMS left')?></label> <input class="form-control" type="text" disabled="disabled" value="<?php echo htmlspecialchars($instance->sms_left)?>" autocomplete="off">
				</div>
			</div>
			<div class="columns col-6">
				<div class="form-group">
					<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Total SMS send during lifetime')?></label> <input class="form-control" type="text" disabled="disabled" value="<?php echo htmlspecialchars($instance->sms_processed)?>" autocomplete="off">
				</div>
			</div>
		</div>

		<div class="form-group">
			<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','SMS plan, current user SMS plan from which limits are calculated')?></label> <input class="form-control" type="text" value="<?php echo htmlspecialchars($instance->sms_plan)?>" name="sms_plan" placeholder="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Number')?>" autocomplete="off">
		</div>

		<div class="row">
			<div class="columns col-6">
				<div class="form-group">
					<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Soft limit type')?></label><select name="soft_limit_type" class="form-control">
						<option value="0" <?php echo $instance->soft_limit_type == 0 ? 'selected="selected"' : ''?>><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Percentenge')?></option>
						<option value="1" <?php echo $instance->soft_limit_type == 1 ? 'selected="selected"' : ''?>><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Number')?></option>
					</select>
				</div>
			</div>
			<div class="columns col-6">
				<div class="form-group">
					<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Soft limit value')?></label> <input name="soft_limit" placeholder="Number" class="form-control" type="text" value="<?php echo htmlspecialchars($instance->soft_limit)?>" autocomplete="off">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="columns col-6">
				<div class="form-group">
					<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Hard limit type')?></label><select name="hard_limit_type" class="form-control">
						<option value="0" <?php echo $instance->hard_limit_type == 0 ? 'selected="selected"' : ''?>><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Percentenge')?></option>
						<option value="1" <?php echo $instance->hard_limit_type == 1 ? 'selected="selected"' : ''?>><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Number')?></option>
					</select>
				</div>
			</div>
			<div class="columns col-6">
				<div class="form-group">
					<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Hard limit value')?></label> <input class="form-control" type="text" placeholder="Number" value="<?php echo htmlspecialchars($instance->hard_limit)?>" name="hard_limit" autocomplete="off">
				</div>
			</div>
		</div>
	</div>
	<div class="columns col-4">
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

<input type="submit" class="btn btn-secondary" name="UpdateSMS" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Update')?>" />

