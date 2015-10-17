<?php if (erLhcoreClassInstance::getInstance()->is_active == false) : ?>
<div class="alert alert-danger alert-dismissible" role="alert" style="max-width:1024px;margin:7px auto;">
    <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('pagelayout/pagelayout','Your service plan has expired.');?>
    <?php if (erConfigClassLhConfig::getInstance()->getSetting('site','hide_billing') == false) : ?>
        <a class="alert-link" href="<?php echo erLhcoreClassDesign::baseurl('instance/billing')?>" ><i class="material-icons">account_balance</i><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('pagelayout/pagelayout','Billing');?></a>
    <?php endif;?>
</div>
<?php endif;?>