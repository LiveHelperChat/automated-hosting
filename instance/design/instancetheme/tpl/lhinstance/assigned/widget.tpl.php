<div class="panel panel-default">
    <div class="card-header">
        <a href="<?php echo erLhcoreClassDesign::baseurl('instance/assign')?>/<?php echo $instance->id?>" >Child instances [<?php echo $instance->reseller_instances_count?>]</a>
    </div>
    <div class="card-body">
       <table class="table">
       <tr>
           <th>Instance</th>
           <th>&nbsp;</th>
       </tr>
       <?php foreach (erLhcoreClassModelInstance::getList(array('sort' => 'id DESC', 'filter' => array('reseller_id' => $instance->id))) as $child) : ?>
       <tr>
            <td><a href="<?php echo erLhcoreClassDesign::baseurl('instance/edit')?>/<?php echo $child->id?>"><?php echo htmlspecialchars($child->address)?></a></td>
            <td width="1"><i class="material-icons">info_outline</i></td>
       </tr>
       <?php endforeach;?>
       </table>
    </div>
</div>