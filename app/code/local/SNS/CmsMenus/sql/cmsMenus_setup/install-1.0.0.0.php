<?php

$installer = $this;
$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($installer->getTable('cmsMenu/menu'))
    ->addColumn('menu_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Menu Id')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ), 'Name')
    ->addColumn('date_created', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
    ), 'Date created')
    ->addColumn('date_update', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
    ), 'Date update')
    ->addColumn('status', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ), 'Status')
$installer->getConnection()->createTable($table);

$table = $installer->getConnection()
    ->newTable($installer->getTable('cmsMenu/menu'))
    ->addColumn('ref_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Menu Id')
    ->addColumn('ref_cms_menu', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
    ), 'CMS menu reference')
    ->addColumn('ref_cms_', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
    ), 'CMS menu reference')
$installer->getConnection()->createTable($table);