<?php

$def = new ezcPersistentObjectDefinition();
$def->table = "lhc_instance_client_alias";
$def->class = "erLhcoreClassModelInstanceAlias";

$def->idProperty = new ezcPersistentObjectIdProperty();
$def->idProperty->columnName = 'id';
$def->idProperty->propertyName = 'id';
$def->idProperty->generator = new ezcPersistentGeneratorDefinition(  'ezcPersistentNativeGenerator' );

$def->properties['instance_id'] = new ezcPersistentObjectProperty();
$def->properties['instance_id']->columnName   = 'instance_id';
$def->properties['instance_id']->propertyName = 'instance_id';
$def->properties['instance_id']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_INT;

$def->properties['address'] = new ezcPersistentObjectProperty();
$def->properties['address']->columnName   = 'address';
$def->properties['address']->propertyName = 'address';
$def->properties['address']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

$def->properties['url'] = new ezcPersistentObjectProperty();
$def->properties['url']->columnName   = 'url';
$def->properties['url']->propertyName = 'url';
$def->properties['url']->propertyType = ezcPersistentObjectProperty::PHP_TYPE_STRING;

return $def;

?>