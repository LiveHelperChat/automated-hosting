<div class="form-group">
    <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Address');?></label>
    <input type="text" class="form-control" name="Address"  value="<?php echo htmlspecialchars($instance->address);?>" />
</div>

<div class="form-group">
    <label><input type="checkbox" name="fullAddress" value="on" <?php echo $instance->full_domain ? 'checked="checked"' : '';?> /> <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','it is full domain address');?></label>    
</div>

<div class="form-group">
    <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Client title for invoices');?></label>
    <input type="text" class="form-control" name="ClientTitle"  value="<?php echo htmlspecialchars($instance->client_title);?>" />
</div>

<div class="form-group">
    <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','E-mail');?></label>
    <input type="text" class="form-control" name="Email"  value="<?php echo htmlspecialchars($instance->email);?>" />
</div>

<div class="form-group">
    <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Request left');?></label>
    <input type="text" class="form-control" name="Request"  value="<?php echo htmlspecialchars($instance->request);?>" />
</div>

<div class="form-group">
    <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Status');?> - <?php if ($instance->status == 0) : ?><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','pending initialization');?><?php else : ?><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','created');?><?php endif;?></label>
</div>

<div class="form-group">
    <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Suspended');?> <input type="checkbox" name="Suspended" value="on" <?php echo $instance->suspended ? 'checked="checked"' : '';?> /></label>
</div>

<div class="form-group">
    <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Terminate');?> <input type="checkbox" name="Terminate" value="on" <?php echo $instance->terminate ? 'checked="checked"' : '';?> /></label>
</div>

<div class="form-group">
    <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Expires, 0 - not expirable');?></label>
    <input type="text" class="form-control" name="Expires"  value="<?php echo htmlspecialchars($instance->expires > 0 ? date('Y-m-d H:i:s',$instance->expires) : 0);?>" />
</div>

<?php include(erLhcoreClassDesign::designtpl('lhinstance/attr_int_1.tpl.php'));?>

<?php include(erLhcoreClassDesign::designtpl('lhinstance/attr_int_2.tpl.php'));?>

<?php include(erLhcoreClassDesign::designtpl('lhinstance/attr_int_3.tpl.php'));?>