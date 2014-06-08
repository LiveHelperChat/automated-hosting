<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('department/edit','Address');?></label>
<input type="text" name="Address"  value="<?php echo htmlspecialchars($instance->address);?>" />

<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('department/edit','E-mail');?></label>
<input type="text" name="Email"  value="<?php echo htmlspecialchars($instance->email);?>" />

<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('department/edit','Request');?></label>
<input type="text" name="Request"  value="<?php echo htmlspecialchars($instance->request);?>" />

<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('department/edit','Status');?>,0 - pending activation, 1 - activated</label>
<input type="text" name="Status"  value="<?php echo htmlspecialchars($instance->status);?>" />

<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('department/edit','Expires');?></label>
<input type="text" name="Expires"  value="<?php echo htmlspecialchars($instance->expires > 0 ? date('Y-m-d H:i:s',$instance->expires) : date('Y-m-d H:i:s',time()+6*31*24*3600));?>" />

