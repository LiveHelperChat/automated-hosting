<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/email','Hello');?>,<?php echo "\n\n";?>

<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/email','Here is your chat instance data');?>:<?php echo "\n";?>
<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/email','Address');?>: <?php echo erConfigClassLhConfig::getInstance()->getSetting( 'site', 'http_mode')?><?php echo $instance->address?>.<?php echo erConfigClassLhConfig::getInstance()->getSetting( 'site', 'seller_domain')?>/site_admin/<?php echo "\n\n";?>

<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/email','Login');?>: <?php echo $email,"\n";?>
<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/email','Password');?>: <?php echo $password,"\n\n";?>

<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/email','Number of purchased request');?>:
<?php echo $instance->request,"\n\n";?>

<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/email','Valid untill');?>:
<?php echo date('Y-m-d',$instance->expires),"\n\n";?>

<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/email','Recommended embed code');?>:<?php echo "\n";?>
<?php echo '<script type="text/javascript">
var LHCChatOptions = {};
LHCChatOptions.opt = {widget_height:190,widget_width:300,popup_height:520,popup_width:500};
(function() {
var po = document.createElement(\'script\'); po.type = \'text/javascript\'; po.async = true;
var refferer = (document.referrer) ? encodeURIComponent(document.referrer) : \'\';
var location  = (document.location) ? encodeURIComponent(document.location) : \'\';
po.src = \'';?><?php echo erConfigClassLhConfig::getInstance()->getSetting( 'site', 'http_mode')?><?php echo $instance->address.'.'. erConfigClassLhConfig::getInstance()->getSetting( 'site', 'seller_domain') .'/chat/getstatus/(click)/internal/(position)/bottom_right/(check_operator_messages)/true/(top)/350/(units)/pixels/(leaveamessage)/true?r=\'+refferer+\'&l=\'+location;
var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(po, s);
})();
</script>',"\n\n"; ?>

<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/email','Sincerely');?>,<?php echo "\n";?>
<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/email','Live Support Team');?>