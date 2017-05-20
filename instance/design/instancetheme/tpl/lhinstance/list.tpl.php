<a href="<?php echo erLhcoreClassDesign::baseurl('instance/invoices')?>" class="btn btn-default btn-sm pull-right"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Invoices')?></a>

<h1><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Instances');?></h1>

<?php include(erLhcoreClassDesign::designtpl('lhinstance/list/search_panel.tpl.php')); ?>

<?php include(erLhcoreClassDesign::designtpl('lhinstance/list_body.tpl.php')); ?>

<?php if (isset($pages)) : ?>
    <?php include(erLhcoreClassDesign::designtpl('lhkernel/paginator.tpl.php')); ?>
<?php endif;?>

<a class="btn btn-default" href="<?php echo erLhcoreClassDesign::baseurl('instance/new')?>"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','New instance');?></a>
