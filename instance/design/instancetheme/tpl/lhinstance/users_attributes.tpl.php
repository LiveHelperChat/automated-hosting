<div class="form-group">
    <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Only one login per account is enabled');?> <input type="checkbox" name="one_per_account" value="on" <?php echo $instance->one_per_account ? 'checked="checked"' : '';?> /></label>
</div>

<div class="form-group">
    <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Maximum number of operators,0 - unlimited, > 0 number of users');?></label>
    <input type="text" class="form-control" name="max_operators"  value="<?php echo htmlspecialchars($instance->max_operators);?>" />
</div>

<div class="form-group">
    <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Login IP Security Restrictions');?></label>
    <p><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Values can be separated by comma, E.g 1.2.3.*,128.8.8.8');?></p>
    <textarea class="form-control" name="login_ip_security" placeholder="1.2.3.*,128.8.8.8"><?php echo htmlspecialchars($instance->login_ip_security);?></textarea>
</div>