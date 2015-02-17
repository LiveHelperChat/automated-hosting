<h1><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Invoices');?></h1>

<table class="table" cellpadding="0" cellspacing="0">
<thead>
<tr>
    <th width="1%">ID</th>
    <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Amount');?></th>
    <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Currency');?></th>
    <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Item');?></th>
    <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','Date');?></th> 
    <th><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('instance/edit','PDF');?></th> 
</tr>
</thead>
<?php foreach ($items as $payment) : ?>
    <tr>
        <td><?php echo $payment->id?></td>
        <td><?php echo htmlspecialchars($payment->amount_front)?></td>
        <td><?php echo htmlspecialchars($payment->currency)?></td>
        <td><?php echo htmlspecialchars($payment->option_selection1)?></td>
        <td><?php echo htmlspecialchars($payment->date_front)?></td>
        <td><a target="_blank" href="<?php echo erLhcoreClassDesign::baseurl('instance/billingpdf')?>/<?php echo $payment->id?>" class="btn btn-default btn-sm">PDF</a> </td>
    </tr>
<?php endforeach; ?>
</table>

<?php if (isset($pages)) : ?>
    <?php include(erLhcoreClassDesign::designtpl('lhkernel/paginator.tpl.php')); ?>
<?php endif;?>