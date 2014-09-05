<?php if ($currentUser->hasAccessTo('lhinstance','billing')) : ?>
<li><a href="<?php echo erLhcoreClassDesign::baseurl('instance/billing')?>" ><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('pagelayout/pagelayout','Billing');?></a></li>
<li class="divider"></li>
<?php endif; ?>