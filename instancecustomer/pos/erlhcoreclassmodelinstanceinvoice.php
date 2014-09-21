<?php

$def = new ezcPersistentObjectDefinition();
$def->table = "lhc_instance_invoice";
$def->class = "erLhcoreClassModelInstanceInvoice";

$def->idProperty = new ezcPersistentObjectIdProperty();
$def->idProperty->columnName = 'id';
$def->idProperty->propertyName = 'id';
$def->idProperty->generator = new ezcPersistentGeneratorDefinition(  'ezcPersistentNativeGenerator' );

$def->properties['txn_id'] = new ezcPersistentObjectProperty();
$def->properties['txn_id']->columnName   = 'txn_id';
$def->properties['txn_id']->propertyName = 'txn_id';
$def->properties['txn_id']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['instance_id'] = new ezcPersistentObjectProperty();
$def->properties['instance_id']->columnName   = 'instance_id';
$def->properties['instance_id']->propertyName = 'instance_id';
$def->properties['instance_id']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['order_item'] = new ezcPersistentObjectProperty();
$def->properties['order_item']->columnName   = 'order_item';
$def->properties['order_item']->propertyName = 'order_item';
$def->properties['order_item']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['odate'] = new ezcPersistentObjectProperty();
$def->properties['odate']->columnName   = 'odate';
$def->properties['odate']->propertyName = 'odate';
$def->properties['odate']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['currency'] = new ezcPersistentObjectProperty();
$def->properties['currency']->columnName   = 'currency';
$def->properties['currency']->propertyName = 'currency';
$def->properties['currency']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['amount'] = new ezcPersistentObjectProperty();
$def->properties['amount']->columnName   = 'amount';
$def->properties['amount']->propertyName = 'amount';
$def->properties['amount']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['log'] = new ezcPersistentObjectProperty();
$def->properties['log']->columnName   = 'log';
$def->properties['log']->propertyName = 'log';
$def->properties['log']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

return $def;

?>