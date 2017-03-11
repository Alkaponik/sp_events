<?php
/** @var Mage_Core_Model_Resource_Setup $installer */
$installer = $this;
$installer->startSetup();

$table = $installer->getConnection()
                   ->createTable($installer->getTable('sp_contacts/contacts'))
                   ->addColumn(
                        'contact_id',
                        Varien_Db_Ddl_Table::TYPE_INTEGER,
                        null,
                        [
                            'unsigned' => true,
                            'nullable' => false,
                            'primary' => true,
                            'identity' => true,
                        ],
                        'Contact ID'
                   )
                   ->addColumn(
                        'name',
                        Varien_Db_Ddl_Table::TYPE_VARCHAR,
                        128,
                        [
                            'nullable' => false,
                        ],
                        'Customer name'
                   )
                   ->addColumn(
                        'email',
                        Varien_Db_Ddl_Table::TYPE_VARCHAR,
                        128,
                        [
                            'nullable' => false,
                        ],
                        'Customer email'
                   )
                   ->addColumn(
                        'phone',
                        Varien_Db_Ddl_Table::TYPE_VARCHAR,
                        24,
                        [
                            'nullable' => true,
                        ],
                        'Customer phone'
                   )
                   ->addColumn(
                        'comments',
                        Varien_Db_Ddl_Table::TYPE_TEXT,
                        null,
                        [
                            'nullable' => false,
                        ],
                        'Custommer comments'
                   )
                   ->addColumn(
                        'status',
                        Varien_Db_Ddl_Table::TYPE_TINYINT,
                        4,
                        [
                            'nullable' => false,
                            'default'  => SP_Contacts_Model_Source_Status::STATUS_PENDING
                        ],
                        'Status'
                   )
                   ->setComment('SP Contacts table');

$installer->getConnection()->createTable($table);

$installer->endSetup();