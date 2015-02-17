<h1><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Billing');?></h1>

<div class="row">
	<div class="col-sm-6">
		<table class="table">
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
	</div>
	<div class="col-sm-6">		
		<?php include(erLhcoreClassDesign::designtpl('lhinstance/billing_paypal.tpl.php'));?>
	</div>
</div>


<?php if ($instance->is_reseller) : ?>
<div role="tabpanel">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="clients" aria-controls="clients" role="tab" data-toggle="tab"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Clients');?></a></li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="clients">
		  
		<table class="table" cellpadding="0" cellspacing="0">
		<thead>
		<tr>
		    <th width="1%">ID</th>
		    <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Email');?></th>
		    <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Address');?></th>
		    <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Status');?></th>
		    <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Request left');?></th> 
		    <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Expires');?></th>
		    <th><abbr title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','default back office language');?>"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Locale');?></abbr></th>
		    <th><abbr title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','default frontend language');?>"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Siteaccess');?></abbr></th>
		</tr>
		</thead>
		<?php foreach ($itemsInstance as $departament) : ?>
		    <tr>
		        <td><?php echo $departament->id?></td>
		        <td><?php echo htmlspecialchars($departament->email)?></td>
		        <td><?php echo htmlspecialchars($departament->address)?></td>
		        <td><?php if ($departament->status == 0) : ?><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','pending initialization');?><?php else : ?><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','created');?><?php endif;?></td>
		        <td><?php echo htmlspecialchars($departament->request)?></td> 
		        <td><?php echo htmlspecialchars(date('Y-m-d H:i:s',$departament->expires))?></td>		    
		        <td><?php echo htmlspecialchars($departament->locale)?></td>		    
		        <td><?php echo htmlspecialchars($departament->siteaccess)?></td>		    
		    </tr>
		<?php endforeach; ?>
		</table>
		
		<?php if (isset($pagesInstance)) : $pages = $pagesInstance;?>
		    <?php include(erLhcoreClassDesign::designtpl('lhkernel/paginator.tpl.php')); ?>
		<?php endif;?>
				
		</div>
	</div>
</div>		
<?php endif;?>