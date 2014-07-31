<h1><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('department/edit','Edit instance');?> - <?php echo htmlspecialchars($instance->address)?></h1>

<?php if (isset($errors)) : ?>
	<?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
<?php endif; ?>

<?php if (isset($updated)) : $msg = erTranslationClassLhTranslation::getInstance()->getTranslation('user/account','Updated'); ?>
	<?php include(erLhcoreClassDesign::designtpl('lhkernel/alert_success.tpl.php'));?>
<?php endif; ?>

<div class="section-container auto" data-section="auto" id="tabs" data-options="deep_linking: true" ng-cloak>

  <section>
    <p class="title" data-section-title><a href="#maindata" >Main data</a></p>
    <div class="content" data-section-content data-slug="maindata">
      <div>
      
      	<div class="row">
			<div class="columns large-8">
				<form action="<?php echo erLhcoreClassDesign::baseurl('instance/edit')?>/<?php echo $instance->id?>#maindata" method="post">		
					<?php include(erLhcoreClassDesign::designtpl('lhinstance/form.tpl.php'));?>
				
				    <?php include(erLhcoreClassDesign::designtpl('lhkernel/csfr_token.tpl.php'));?>
				
					<ul class="button-group radius">
				      <li><input type="submit" class="small button" name="Save_departament" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Save');?>"/></li>
				      <li><input type="submit" class="small button" name="Update_departament" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Update');?>"/></li>
				      <li><input type="submit" class="small button" name="Cancel_departament" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Cancel');?>"/></li>
				    </ul>		
				</form>
			</div>
			<div class="columns large-4">
					<ul class="circle">
						<li>Active: <?php echo $instance->is_active ? 'yes' : 'no'?></li>
						<li><a target="_blank" href="http://<?php echo $instance->address?>.<?php echo erConfigClassLhConfig::getInstance()->getSetting( 'site', 'seller_domain')?>/site_admin">http://<?php echo $instance->address?>.<?php echo erConfigClassLhConfig::getInstance()->getSetting( 'site', 'seller_domain')?>/site_admin</a></li>
					</ul>
			</div>	
		</div> 
		 	  	
  	  </div>
    </div>
  </section>

  <section>
    <p class="title" data-section-title><a href="#login" >Login information</a></p>
    <div class="content" data-section-content data-slug="login">
      <div> 
			<form action="<?php echo erLhcoreClassDesign::baseurl('instance/edit')?>/<?php echo $instance->id?>#login" method="post" autocomplete="off">		
				
				<input style="display:none">
								 
				<label>Username</label>
				<input type="text" value="" name="InstanceUsername" autocomplete="off">
				
				<label>Password</label>
				<input type="password" value="" name="InstancePassword" autocomplete="off">
								
				<ul class="button-group radius">
			      <li><input type="submit" class="small button" name="ChangePassword" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Update');?>"/></li>				  
			    </ul>		
			</form>		 	  	
  	  </div>
    </div>
  </section>
  
</div>