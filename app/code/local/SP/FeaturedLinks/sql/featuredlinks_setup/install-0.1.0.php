<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2016, Pavel Usachev
 */

/** @var Mage_Core_Model_Resource_Setup $this */
$installer = $this;

$installer->startSetup();

$table= $installer->getConnection()
    ->newTable($installer->getTable('sp_featuredlinks/featuredlinks'))
    ->addColumn(
        'link_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        10,
        [
            'unsigned' => true,
            'nullable' => false,
            'primary' => true,
            'identity' => true,
        ],
        'Link ID'
    )
    ->addColumn(
        'title',
        Varien_Db_Ddl_Table::TYPE_VARCHAR,
        128,
        [
            'nullable' => false,
        ],
        'Link title'
    )
    ->addColumn(
        'link',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        null,
        [
            'nullable' => false,
        ],
        'Link title'
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
        1,
        [
            'nullable' => false,
            'default'  => 1
        ]
    )
    ->setComment('SP Links table');

$installer->getConnection()->createTable($table);

$installer->endSetup();
