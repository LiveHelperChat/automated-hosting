<h1><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Billing');?></h1>

<table class="large-6">
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

