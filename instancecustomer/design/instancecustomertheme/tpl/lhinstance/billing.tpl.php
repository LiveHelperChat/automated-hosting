<h1><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Billing');?></h1>

<table class="large-6">
	<?php if ($instance->is_reseller) : ?>
	<tr>
		<td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Instances');?></td>
		<td><?php echo $instance->reseller_instances_count?>/<?php echo $instance->reseller_max_instances?></td>
	</tr>
	<tr>
		<td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Request left to sell');?></td>
		<td><?php echo $instance->reseller_request?></td>
	</tr>
	<tr>
		<td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Max request per instance');?></td>
		<td><?php echo $instance->reseller_max_instance_request?></td>
	</tr>
	<?php endif; ?>
	<tr>
		<td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Request left');?></td>
		<td><?php echo $instance->request?></td>
	</tr>
	<tr>
		<td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Expires');?></td>
		<td><?php echo date('Y-m-d H:i:s',$instance->expires)?></td>
	</tr>
	<tr>
		<td><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','E-mail');?></td>
		<td><?php echo $instance->email?></td>
	</tr>
</table>

