<h1><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('department/departments','Instances');?></h1>

<table class="twelve" cellpadding="0" cellspacing="0">
<thead>
<tr>
    <th width="1%">ID</th>
    <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('department/departments','Email');?></th>
    <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('department/departments','Address');?></th>
    <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('department/departments','Status');?></th>
    <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('department/departments','Request left');?></th> 
    <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('department/departments','Request expires');?></th>
    <th width="1%">&nbsp;</th>
</tr>
</thead>
<?php foreach ($items as $departament) : ?>
    <tr>
        <td><?php echo $departament->id?></td>
        <td><?php echo htmlspecialchars($departament->email)?></td>
        <td><?php echo htmlspecialchars($departament->address)?></td>
        <td><?php echo htmlspecialchars($departament->status)?></td>
        <td><?php echo htmlspecialchars($departament->request)?></td> 
        <td><?php echo htmlspecialchars(date('Y-m-d H:i:s',$departament->expires))?></td>
        <td nowrap><a class="small button round" href="<?php echo erLhcoreClassDesign::baseurl('instance/edit')?>/<?php echo $departament->id?>"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('department/departments','Edit');?></a></td>
    </tr>
<?php endforeach; ?>
</table>

<?php if (isset($pages)) : ?>
    <?php include(erLhcoreClassDesign::designtpl('lhkernel/paginator.tpl.php')); ?>
<?php endif;?>

<a class="small button" href="<?php echo erLhcoreClassDesign::baseurl('instance/new')?>"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('department/departments','New instance');?></a>
