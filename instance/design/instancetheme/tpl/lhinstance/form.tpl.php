<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Address');?></label>
<input type="text" name="Address"  value="<?php echo htmlspecialchars($instance->address);?>" />

<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','E-mail');?></label>
<input type="text" name="Email"  value="<?php echo htmlspecialchars($instance->email);?>" />

<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Request left');?></label>
<input type="text" name="Request"  value="<?php echo htmlspecialchars($instance->request);?>" />

<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Status');?> - <?php if ($instance->status == 0) : ?><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','pending initialization');?><?php else : ?><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','created');?><?php endif;?></label>
<br/>
<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Suspended');?> <input type="checkbox" name="Suspended" value="on" <?php echo $instance->suspended ? 'checked="checked"' : '';?> /></label>

<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Terminate');?> <input type="checkbox" name="Terminate" value="on" <?php echo $instance->terminate ? 'checked="checked"' : '';?> /></label>

<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Expires');?></label>
<input type="text" name="Expires"  value="<?php echo htmlspecialchars($instance->expires > 0 ? date('Y-m-d H:i:s',$instance->expires) : date('Y-m-d H:i:s',time()+6*31*24*3600));?>" />
