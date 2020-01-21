<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/email','Hello');?><?php if (isset($client_attributes_array['name'])) {echo ' ',$client_attributes_array['name'];};if (isset($client_attributes_array['surname'])) {echo ' ',$client_attributes_array['surname'];}; echo ",\n\n";?>

<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/email','Here is your chat instance data');?>:<?php echo "\n";?>
<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/email','Address');?>: <?php echo erConfigClassLhConfig::getInstance()->getSetting( 'site', 'http_mode')?><?php echo $instance->address?>.<?php echo erConfigClassLhConfig::getInstance()->getSetting( 'site', 'seller_domain')?>/site_admin/<?php echo "\n\n";?>

<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/email','Login');?>: <?php echo $email,"\n";?>
<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/email','Password');?>: <?php echo $password,"\n\n";?>

<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/email','Number of purchased request');?>:
<?php echo $instance->request,"\n\n";?>

<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/email','Valid untill');?>:
<?php echo $instance->expires > 0 ? date('Y-m-d',$instance->expires) : '-',"\n\n";?>

<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/email','Recommended embed code');?>:<?php echo "\n";?>
<?php echo '<script>var LHC_API = LHC_API||{};
        LHC_API.args = {mode:\'widget\',lhc_base_url:\'//' . $instance->address . '.' . erConfigClassLhConfig::getInstance()->getSetting( 'site', 'seller_domain') . '\',wheight:450,wwidth:350,pheight:520,pwidth:500,leaveamessage:true};
        (function() {
            var po = document.createElement(\'script\'); po.type = \'text/javascript\'; po.async = true;
            var date = new Date();po.src = \'//'.$instance->address . '.' . erConfigClassLhConfig::getInstance()->getSetting( 'site', 'seller_domain') .'/design/defaulttheme/js/widgetv2/index.js?\'+(""+date.getFullYear() + date.getMonth() + date.getDate());
            var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(po, s);
        })();
    </script>',"\n\n"; ?>

<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/email','Sincerely');?>,<?php echo "\n";?>
<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/email','Live Support Team');?>