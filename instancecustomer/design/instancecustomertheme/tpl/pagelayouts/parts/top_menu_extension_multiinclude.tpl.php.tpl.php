<?php if ($currentUser->hasAccessTo('lhinstance','billing')) : ?>
<li><a href="<?php echo erLhcoreClassDesign::baseurl('instance/billing')?>" ><i class="material-icons">account_balance</i> <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('pagelayout/pagelayout','Billing');?></a></li>
<?php endif;?>