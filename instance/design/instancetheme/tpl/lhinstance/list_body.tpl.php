<table class="table" cellpadding="0" cellspacing="0">
<thead>
<tr>
    <th width="1%">ID</th>
    <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','E-mail');?></th>
    <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Address');?></th>
    <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Status');?></th>
    <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Request left');?></th> 
    <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Expires');?></th>
    <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Owner');?></th>
    <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Is reseller');?></th>
    <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Number of instances');?></th>
    <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Request left to sell');?></th>
    <th width="1%">&nbsp;</th>
</tr>
</thead>
<?php foreach ($items as $departament) : ?>
    <tr>
        <td><?php echo $departament->id?></td>
        <td><?php echo htmlspecialchars($departament->email)?></td>
        <td><?php echo htmlspecialchars($departament->address)?></td>
        <td>
            <?php if ($departament->status == 0) : ?>
                <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','pending initialization');?>
            <?php elseif ($departament->status == 2) : ?>
                <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','In progress...');?>
            <?php else : ?>
                <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','created');?>
            <?php endif;?>

        </td>
        <td><?php echo htmlspecialchars($departament->request)?></td> 
        <td>
        <?php if ($departament->expires > 0) : ?>
        <?php echo htmlspecialchars(date('Y-m-d H:i:s',$departament->expires))?>
        <?php else : ?>
        -
        <?php endif;?>
        </td>
        <td>
        <?php if ($departament->reseller !== false) : ?>
        	<?php echo htmlspecialchars($departament->reseller->reseller_tite)?>        	
        <?php endif;?>        
        </td>
        <td>
        <?php if ($departament->is_reseller == 1) : ?>
        	<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Yes');?>
        <?php else : ?>
        	<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','No');?>
        <?php endif;?>
        </td>
        <td>
        <?php if ($departament->is_reseller == 1) : ?>
        	<?php echo $departament->reseller_instances_count?>/<?php echo $departament->reseller_max_instances?>          	
        <?php endif;?>
        </td>
        <td><?php echo $departament->reseller_request?></td>
        <td nowrap>

        <?php if (isset($listInstancesParams['show_configuration'])) : ?>
            <a class="btn btn-default btn-sm" href="#"><i class="material-icons mr-0">settings_applications</i></a>
        <?php endif;?>

        <?php if (isset($listInstancesParams['show_unasign'])) : ?>
            <a class="btn btn-default btn-sm" href="<?php echo erLhcoreClassDesign::baseurl('instance/assign')?>/<?php echo $departament->reseller_id?>/(unasign)/<?php echo $departament->id?>"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Unasign');?></a>
        <?php endif;?>

        <a class="btn btn-default btn-sm" href="<?php echo erLhcoreClassDesign::baseurl('instance/edit')?>/<?php echo $departament->id?>"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Edit');?></a>
        </td>
    </tr>
<?php endforeach; ?>
</table>