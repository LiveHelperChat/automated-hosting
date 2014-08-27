<h1><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Instances');?></h1>

<table class="twelve" cellpadding="0" cellspacing="0">
<thead>
<tr>
    <th width="1%">ID</th>
    <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Email');?></th>
    <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Address');?></th>
    <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Status');?></th>
    <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Request left');?></th> 
    <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Expires');?></th>
    <th width="1%">&nbsp;</th>
</tr>
</thead>
<?php foreach ($items as $departament) : ?>
    <tr>
        <td><?php echo $departament->id?></td>
        <td><?php echo htmlspecialchars($departament->email)?></td>
        <td><?php echo htmlspecialchars($departament->address)?></td>
        <td><?php if ($departament->status == 0) : ?><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','pending initialization');?><?php else : ?><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','created');?><?php endif;?></td>
        <td><?php echo htmlspecialchars($departament->request)?></td> 
        <td><?php echo htmlspecialchars(date('Y-m-d H:i:s',$departament->expires))?></td>
        <td nowrap><a class="small button round" href="<?php echo erLhcoreClassDesign::baseurl('instance/edit')?>/<?php echo $departament->id?>"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Edit');?></a></td>
    </tr>
<?php endforeach; ?>
</table>

<?php if (isset($pages)) : ?>
    <?php include(erLhcoreClassDesign::designtpl('lhkernel/paginator.tpl.php')); ?>
<?php endif;?>

<a class="small button" href="<?php echo erLhcoreClassDesign::baseurl('instance/new')?>"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','New instance');?></a>
