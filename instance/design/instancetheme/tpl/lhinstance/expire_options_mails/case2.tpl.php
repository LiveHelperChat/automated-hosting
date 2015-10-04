<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/email','Hello');?><?php if (isset($client_attributes_array['name'])) {echo ' ',$client_attributes_array['name'];};if (isset($client_attributes_array['surname'])) {echo ' ',$client_attributes_array['surname'];}; echo ",\n\n";?>

<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/email','We are informing that your instance will expire at');?>:<?php echo "\n";?>

<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/email','Your instance will expire at');?>:
<?php echo date('Y-m-d',$instance->expires),"\n\n";?>

<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/email','Sincerely');?>,<?php echo "\n";?>
<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/email','Live Support Team');?>