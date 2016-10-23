<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2016, Pavel Usachev
 */

/** @var Mage_Core_Model_Resource_Setup $this */
$installer = $this;

$installer->startSetup();

$table= $installer->getConnection()
                  ->newTable($installer->getTable('sp_events/events'))
                  ->addColumn(
                      'event_id',
                      Varien_Db_Ddl_Table::TYPE_INTEGER,
                      null,
                      [
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true,
                        'identity' => true,
                      ],
                      'Event ID'
                  )
                  ->addColumn(
                      'title',
                      Varien_Db_Ddl_Table::TYPE_VARCHAR,
                      128,
                      [
                          'nullable' => false,
                      ],
                      'Event title'
                  )
                  ->addColumn(
                      'short_description',
                      Varien_Db_Ddl_Table::TYPE_TEXT,
                      null,
                      [
                          'nullable' => true,
                      ]
                  )
                  ->addColumn(
                      'image',
                      Varien_Db_Ddl_Table::TYPE_TEXT,
                      null,
                      [
                          'nullable' => false,
                      ]
                  )
                  ->addColumn(
                      'display_from',
                      Varien_Db_Ddl_Table::TYPE_DATE,
                      null,
                      [
                          'nullable' => true,
                      ]
                  )
                  ->addColumn(
                      'display_to',
                      Varien_Db_Ddl_Table::TYPE_DATE,
                      null,
                      [
                          'nullable' => true,
                      ]
                  )
                  ->addColumn(
                      'is_active',
                      Varien_Db_Ddl_Table::TYPE_SMALLINT,
                      2,
                      [
                          'nullable' => false,
                          'default'  => 1
                      ]
                  )
                  ->setComment('SP Events table');

$installer->getConnection()->createTable($table);

$installer->endSetup();
