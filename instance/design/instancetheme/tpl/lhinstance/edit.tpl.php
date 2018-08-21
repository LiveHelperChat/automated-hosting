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
		<li role="presentation"><a href="#clientdata" aria-controls="clientdata" role="tab" data-toggle="tab"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Client data');?></a></li>
		<li role="presentation"><a href="#users" aria-controls="users" role="tab" data-toggle="tab"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Users')?></a></li>
		<li role="presentation"><a href="#attributes" aria-controls="attributes" role="tab" data-toggle="tab"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Attributes')?></a></li>
		<li role="presentation"><a href="#reseller" aria-controls="reseller" role="tab" data-toggle="tab"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Reseller')?></a></li>
		<li role="presentation"><a href="#features" aria-controls="features" role="tab" data-toggle="tab"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Features')?></a></li>
		<li role="presentation"><a href="#sms" aria-controls="sms" role="tab" data-toggle="tab"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','SMS information')?></a></li>
		<li role="presentation"><a href="#login" aria-controls="login" role="tab" data-toggle="tab"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Login information')?></a></li>
		<li role="presentation"><a href="#aliases" aria-controls="aliases" role="tab" data-toggle="tab"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Aliases')?></a></li>
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
						<li>
						<?php if ($instance->full_domain == 0) : ?>
    		              <a href="https://<?php echo $instance->address?>.<?php echo erConfigClassLhConfig::getInstance()->getSetting( 'site', 'seller_domain')?>/site_admin" target="_blank">https://<?php echo $instance->address?>.<?php echo erConfigClassLhConfig::getInstance()->getSetting( 'site', 'seller_domain')?>/site_admin</a>
    		            <?php else : ?>
    		              <a href="https://<?php echo $instance->address?>/site_admin" target="_blank">https://<?php echo $instance->address?>/site_admin</a>
    		            <?php endif;?>
						<li><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Suspended by reseller');?> - <?php if ($instance->reseller_suspended) : ?><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','yes');?><?php else : ?><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','no');?><?php endif;?></li>
						<?php if ($instance->is_reseller) : ?><li><?php echo $instance->reseller_instances_count?>/<?php echo $instance->reseller_max_instances?></li><?php endif;?>
					</ul>

					<div class="panel panel-default">
                      <div class="panel-heading"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Quick maintain');?></div>
                      <div class="panel-body">
                      
                          <?php if (isset($instance_maintain_message)) : ?>
                            <div class="alert alert-info" role="alert">
                              <?php echo $instance_maintain_message; // No need to escape beacause escaped in module?>
                            </div>
                          <?php endif;?>
                          
                          <a href="?update_official=1" class="btn btn-default"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Update instance stucture with official structure')?></a>
                          <br/>
                          <br/>
                          <a href="?update_extension=1" class="btn btn-default"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Update extensions structure')?></a>
                      </div>
                    </div>
			</div>	
		  </div> 
		</div>
		
		<div role="tabpanel" class="tab-pane" id="clientdata">
		   <form action="<?php echo erLhcoreClassDesign::baseurl('instance/edit')?>/<?php echo $instance->id?>#clientdata" method="post" autocomplete="off">		
				<?php include(erLhcoreClassDesign::designtpl('lhinstance/client_data.tpl.php'));?>
			    <input type="submit" class="btn btn-default" name="UpdateClientData" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Update');?>"/>				  
			</form>
		</div>
		
		<div role="tabpanel" class="tab-pane" id="users">
		     <form action="<?php echo erLhcoreClassDesign::baseurl('instance/edit')?>/<?php echo $instance->id?>#users" method="post" autocomplete="off">		
				
				<?php include(erLhcoreClassDesign::designtpl('lhinstance/users_attributes.tpl.php'));?>
        			
			    <input type="submit" class="btn btn-default" name="UpdateUsers" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Update');?>"/>				  
			  			    	
			</form>	
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
    				    <input type="submit" class="btn btn-default" name="UpdateReseller" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Update');?>" />
    				</form>
    			 </div>
    			<div class="col-sm-4">
    				 <ul class="circle">
    					<li><?php echo $instance->reseller_instances_count?>/<?php echo $instance->reseller_max_instances?></li>
    				 </ul>
    				 <?php include(erLhcoreClassDesign::designtpl('lhinstance/assigned/widget.tpl.php'));?>
    			</div>
    		</div>

		</div>
		<div role="tabpanel" class="tab-pane" id="login">
		
		  <div class="row">
		      <div class="col-xs-8">
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
		      <div class="col-xs-4">
		          <?php if ($instance->full_domain == 0) : ?>
		              <a href="http://<?php echo $instance->address?>.<?php echo erConfigClassLhConfig::getInstance()->getSetting( 'site', 'seller_domain')?>/site_admin/instance/logmein/<?php echo time()?>/<?php echo sha1(erConfigClassLhConfig::getInstance()->getSetting('site','seller_secret_hash').sha1(erConfigClassLhConfig::getInstance()->getSetting('site','seller_secret_hash').$instance->address.time()));?>" target="_blank"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Log me in (will expire at')?> <?php echo date('H:i:s',time()+60)?>)</a>
		          <?php else : ?>
		              <a href="http://<?php echo $instance->address?>/site_admin/instance/logmein/<?php echo time()?>/<?php echo sha1(erConfigClassLhConfig::getInstance()->getSetting('site','seller_secret_hash').sha1(erConfigClassLhConfig::getInstance()->getSetting('site','seller_secret_hash').$instance->address.time()));?>" target="_blank"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Log me in (will expire at')?> <?php echo date('H:i:s',time()+60)?>)</a>
		          <?php endif;?>
		      </div>
		  </div>
					
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
		
		<div role="tabpanel" class="tab-pane" id="aliases">
		    <form action="<?php echo erLhcoreClassDesign::baseurl('instance/edit')?>/<?php echo $instance->id?>#aliases" method="post" autocomplete="off">		
		         <?php include(erLhcoreClassDesign::designtpl('lhinstance/aliases.tpl.php'));?>	
			</form>			
		</div>
		<?php include(erLhcoreClassDesign::designtpl('lhinstance/tabs_content/extension_tab_multiinclude.tpl.php'));?>
	</div>
</div>
