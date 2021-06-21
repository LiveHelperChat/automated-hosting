<?php if (isset($sms_updated)) : $msg = erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Updated!'); ?>
	<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success.tpl.php'));?>
<?php endif; ?>





<div class="row" ng-non-bindable>
	<div class="columns col-xs-8">

		<form action="<?php echo erLhcoreClassDesign::baseurl('instance/billing')?>#sms" method="post">
			<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Default department for incomming SMS chat');?></label>
			<div class="row">
				<div class="col-xs-6">
					<div class="form-group">       		
                    <?php
                    $params = array(
                        'input_name' => 'DepartmentID',
                        'display_name' => 'name',
                        'css_class' => 'form-control',
                        'selected_id' => $instance->phone_default_department,
                        'list_function' => 'erLhcoreClassModelDepartament::getList',
                        'list_function_params' => array('limit' => '1000000')
                    );
                    
                    if (empty($limitDepartments)) {
                        $params['optional_field'] = erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Automatically select first department');
                    }
                    
                    echo erLhcoreClassRenderHelper::renderCombobox($params);
                    ?>
                    </div>
				</div>				
			</div>

			<div class="row">		 
		   <?php $numberRow = 0; foreach ($instance->phone_number as $key => $phoneNumber) : if ($phoneNumber['phone'] != '') : $numberRow++; ?>
		   <div class="columns col-xs-4">
					<div class="form-group">
						<label><?php echo $numberRow?>. <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Phone')?> - <?php echo htmlspecialchars($phoneNumber['phone'])?></label>         			 
                      <?php
            $params = array(
                'input_name' => 'PhoneDepartment[' . $key . ']',
                'display_name' => 'name',
                'css_class' => 'form-control',
                'selected_id' => $phoneNumber['department'],
                'list_function' => 'erLhcoreClassModelDepartament::getList',
                'list_function_params' => array('limit' => '1000000')
            );
            
            if (empty($limitDepartments)) {
                $params['optional_field'] = erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit', 'Use default department');
            }
            
            echo erLhcoreClassRenderHelper::renderCombobox($params);
            ?>                   
        		</div>
				</div>
		  <?php endif; endforeach;?>
		</div>

				
		<div class="row">
			<div class="columns col-xs-6">
				<div class="form-group">
					<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','SMS message send to the user')?></label> <input name="SMSMessageToUser" class="form-control" type="text"  title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','SMS text which should receive user')?>" value="<?php echo htmlspecialchars($instance->phone_response)?>" autocomplete="off">
				</div>
			</div>
			<div class="columns col-xs-6">
				<div class="form-group">
					<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Automatic SMS responder timeout in minits, zero means disabled')?></label> <input class="form-control" name="SMSMessageToUserTimeout" type="text" title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','After how many minits system should send SMS to user, changeable by user')?>" value="<?php echo htmlspecialchars($instance->phone_response_timeout)?>" autocomplete="off">
				</div>
			</div>
		</div>

		
		<input type="submit" class="btn btn-primary" value="Save" name="SaveDefaultDepartment" />

		</form>

		<hr>

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
			<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','SMS plan, current user SMS plan from which limits are calculated')?></label> <input class="form-control" type="text" readonly="readonly" value="<?php echo htmlspecialchars($instance->sms_plan)?>" name="sms_plan" placeholder="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Number')?>" autocomplete="off">
		</div>

		<div class="row">
			<div class="columns col-xs-6">
				<div class="form-group">
					<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Soft limit type')?></label><select disabled="disabled" name="soft_limit_type" class="form-control">
						<option value="0" <?php echo $instance->soft_limit_type == 0 ? 'selected="selected"' : ''?>><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Percentenge')?></option>
						<option value="1" <?php echo $instance->soft_limit_type == 1 ? 'selected="selected"' : ''?>><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Number')?></option>
					</select>
				</div>
			</div>
			<div class="columns col-xs-6">
				<div class="form-group">
					<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Soft limit value')?></label> <input name="soft_limit" placeholder="Number" class="form-control" readonly="readonly" type="text" value="<?php echo htmlspecialchars($instance->soft_limit)?>" autocomplete="off">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="columns col-xs-6">
				<div class="form-group">
					<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Hard limit type')?></label><select disabled="disabled" name="hard_limit_type" class="form-control">
						<option value="0" <?php echo $instance->hard_limit_type == 0 ? 'selected="selected"' : ''?>><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Percentenge')?></option>
						<option value="1" <?php echo $instance->hard_limit_type == 1 ? 'selected="selected"' : ''?>><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Number')?></option>
					</select>
				</div>
			</div>
			<div class="columns col-xs-6">
				<div class="form-group">
					<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Hard limit value')?></label> <input readonly="readonly" class="form-control" type="text" placeholder="Number" value="<?php echo htmlspecialchars($instance->hard_limit)?>" name="hard_limit" autocomplete="off">
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
