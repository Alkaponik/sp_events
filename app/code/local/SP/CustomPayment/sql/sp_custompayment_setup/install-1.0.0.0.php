<?php

/** @var Mage_Core_Model_Resource_Setup $installer */
$installer = $this;

$installer->startSetup();

$installer->getConnection()
          ->addColumn($installer->getTable('sales/quote_payment'), 'custom_field_one', [
              'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
              'length'  => 255,
              'comment' => 'for test'
          ]);
$installer->getConnection()
          ->addColumn($installer->getTable('sales/quote_payment'), 'custom_field_two', [
              'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
              'length'  => 255,
              'comment' => 'for test'
          ]);
$installer->getConnection()
          ->addColumn($installer->getTable('sales/order_payment'), 'custom_field_one', [
              'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
              'length'  => 255,
              'comment' => 'for test'
          ]);
$installer->getConnection()
          ->addColumn($installer->getTable('sales/order_payment'), 'custom_field_two', [
              'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
              'length'  => 255,
              'comment' => 'for test'
          ]);

$installer->endSetup();