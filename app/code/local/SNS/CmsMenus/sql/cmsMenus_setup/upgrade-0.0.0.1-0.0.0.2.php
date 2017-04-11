<?php
$installer = $this;

$installer->getConnection()->addColumn(
    $installer->getTable('cmsMenu/menu'),
    'link',
    array(
        'type'      => Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        'unsigned'  => true,
        'nullable'  => true,
        'comment'   => 'Link'
    )
);