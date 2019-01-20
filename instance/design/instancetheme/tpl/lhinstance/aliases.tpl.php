<h4>Aliases</h4>

<?php $aliases = erLhcoreClassModelInstanceAlias::getList(array('filter' => array('instance_id' => $instance->id))); ?>

<form method="post" action="<?php echo erLhcoreClassDesign::baseurl('instance/edit')?>/<?php echo $instance->id?>#/aliases">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Address')?></label>
                <input name="address" type="text" class="form-control" />
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Default URL')?></label>
                <input name="url" type="text" class="form-control" />
            </div>
        </div>
        <div class="col-12">
            <div class="btn-group" role="group" aria-label="...">
        		<input type="submit" name="AddAlias" class="btn btn-primary" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Add')?>"> 
        	</div>
        </div>
    </div>
</form>

<hr>

<table class="table" width="100%" cellpadding="0" cellspacing="0">
<thead>
    <tr>
        <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Address')?></th>
        <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','URL')?></th>
        <th width="1%"></th>
    </tr>
</thead>
<?php foreach ($aliases as $alias) : ?>
    <tr>
        <td><?php echo htmlspecialchars($alias->address)?></td>
        <td><?php echo htmlspecialchars($alias->url)?></td>
        <td><a onclick="return confirm('<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('kernel/messages','Are you sure?');?>')" href="<?php echo erLhcoreClassDesign::baseurl('instance/edit')?>/<?php echo $instance->id?>/(deletealias)/<?php echo $alias->id?>" class="btn btn-danger btn-xs csfr-required"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Delete')?></a></td>
    </tr>
<?php endforeach; ?>
</table>

<?php include(erLhcoreClassDesign::designtpl('lhkernel/secure_links.tpl.php')); ?>