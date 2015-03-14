<h1><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Edit instance');?> - <?php echo htmlspecialchars($instance->address)?></h1>

<?php if (isset($errors)) : ?>
	<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
<?php endif; ?>

<?php if (isset($updated)) : $msg = erTranslationClassLhTranslation::getInstance()->getTranslation('user/account','Updated'); ?>
	<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success.tpl.php'));?>
<?php endif; ?>


<div role="tabpanel">

	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#maindata" aria-controls="maindata" role="tab" data-toggle="tab"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Main data');?></a></li>
		<li role="presentation"><a href="#attributes" aria-controls="attributes" role="tab" data-toggle="tab"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Attributes')?></a></li>
		<li role="presentation"><a href="#reseller" aria-controls="reseller" role="tab" data-toggle="tab"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Reseller')?></a></li>
		<li role="presentation"><a href="#features" aria-controls="features" role="tab" data-toggle="tab"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Features')?></a></li>
		<li role="presentation"><a href="#sms" aria-controls="login" role="tab" data-toggle="tab"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','SMS information')?></a></li>
		<li role="presentation"><a href="#login" aria-controls="login" role="tab" data-toggle="tab"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Login information')?></a></li>
		<?php include(erLhcoreClassDesign::designtpl('lhinstance/tabs/extension_tab_multiinclude.tpl.php'));?>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="maindata">
		  <div class="row">
			<div class="col-sm-8">
				<form action="<?php echo erLhcoreClassDesign::baseurl('instance/edit')?>/<?php echo $instance->id?>#maindata" method="post">		
					<?php include(erLhcoreClassDesign::designtpl('lhinstance/form.tpl.php'));?>
				
				    <?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>
				
					<div class="btn-group" role="group" aria-label="...">
				      <input type="submit" class="btn btn-default" name="Save_departament" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Save');?>"/>
				      <input type="submit" class="btn btn-default" name="Update_departament" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Update');?>"/>
				      <input type="submit" class="btn btn-default" name="Cancel_departament" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Cancel');?>"/>
				    </div>
				    	
				</form>
			</div>
			<div class="col-sm-4">
					<ul>
						<li><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Active');?>: <?php if ($instance->is_active) : ?><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','yes');?><?php else : ?><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','no');?><?php endif;?></li>
						<li><a target="_blank" href="http://<?php echo $instance->address?>.<?php echo erConfigClassLhConfig::getInstance()->getSetting( 'site', 'seller_domain')?>/site_admin">http://<?php echo $instance->address?>.<?php echo erConfigClassLhConfig::getInstance()->getSetting( 'site', 'seller_domain')?>/site_admin</a></li>
						<li><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Suspended by reseller');?> - <?php if ($instance->reseller_suspended) : ?><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','yes');?><?php else : ?><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','no');?><?php endif;?></li>
						<?php if ($instance->is_reseller) : ?><li><?php echo $instance->reseller_instances_count?>/<?php echo $instance->reseller_max_instances?></li><?php endif;?>
					</ul>
			</div>	
		</div> 
		</div>
		<div role="tabpanel" class="tab-pane" id="attributes">
		     <form action="<?php echo erLhcoreClassDesign::baseurl('instance/edit')?>/<?php echo $instance->id?>#attributes" method="post" autocomplete="off">		
				
				<?php include(erLhcoreClassDesign::designtpl('lhinstance/form_attributes.tpl.php'));?>
        			
			    <input type="submit" class="btn btn-default" name="UpdateAttributes" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Update attributes');?>"/>				  
			  			    	
			</form>	
		</div>
		<div role="tabpanel" class="tab-pane" id="reseller">
		
		<div class="row">
			<div class="col-sm-8">
				<form action="<?php echo erLhcoreClassDesign::baseurl('instance/edit')?>/<?php echo $instance->id?>#reseller" method="post" autocomplete="off">		
					<?php include(erLhcoreClassDesign::designtpl('lhinstance/form_reseller.tpl.php'));?>	        										
				
				    <input type="submit" class="btn btn-default" name="UpdateReseller" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Update');?>"/>				  
				    	
				 </form>	
			 </div>
			<div class="col-sm-4">
					<ul class="circle">
						<li><?php echo $instance->reseller_instances_count?>/<?php echo $instance->reseller_max_instances?></li>
					</ul>
			</div>	
		</div>
		
		</div>
		<div role="tabpanel" class="tab-pane" id="login">
		  <form action="<?php echo erLhcoreClassDesign::baseurl('instance/edit')?>/<?php echo $instance->id?>#login" method="post" autocomplete="off">		
		        <div class="form-group">											 
    				<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Username')?></label>
    				<input class="form-control" type="text" value="" name="InstanceUsername" autocomplete="off">
				</div>
				
				<div class="form-group">	
				    <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Password')?></label>
				    <input class="form-control" type="password" value="" name="InstancePassword" autocomplete="off">
				</div>
				
			    <input type="submit" class="btn btn-default" name="ChangePassword" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Update');?>"/>				  
			    	
			</form>			
		</div>
		<div role="tabpanel" class="tab-pane" id="features">
		    <form action="<?php echo erLhcoreClassDesign::baseurl('instance/edit')?>/<?php echo $instance->id?>#features" method="post" autocomplete="off">		
		         <?php include(erLhcoreClassDesign::designtpl('lhinstance/features.tpl.php'));?>	
			</form>			
		</div>
		<div role="tabpanel" class="tab-pane" id="sms">
		    <form action="<?php echo erLhcoreClassDesign::baseurl('instance/edit')?>/<?php echo $instance->id?>#sms" method="post" autocomplete="off">		
		         <?php include(erLhcoreClassDesign::designtpl('lhinstance/sms.tpl.php'));?>	
			</form>			
		</div>
		<?php include(erLhcoreClassDesign::designtpl('lhinstance/tabs_content/extension_tab_multiinclude.tpl.php'));?>
	</div>
</div>
