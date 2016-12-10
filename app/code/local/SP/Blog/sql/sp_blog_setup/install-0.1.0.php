<?php

$installer = $this;
$installer->startSetup();

/*
 * Create all entity tables
 */

$tablename = $installer->getTable('sp_blog/post_entity');


$installer->createEntityTables($tablename);

/*
 * Add Entity type
 */
$installer->addEntityType('sp_blog_post',Array(
    'entity_model'          =>'sp_blog/post',
    'attribute_model'       =>'',
    'table'                 =>'sp_blog/post_entity',
    'increment_model'       =>'',
    'increment_per_store'   =>'0'
));

$installer->installEntities();

$installer->endSetup();