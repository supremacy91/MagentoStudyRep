<?php
$installer = $this;

$installer->startSetup();

$installer->addAttribute(
    'customer',
    'customer_balance',
    array(
        "backend_type" => "decimal",
        "frontend_inpt" => "text",
        "is_required" => "0",
        "system" => "1",
        "visible" => "1",
        "label" => "Customer balance"
    )
);


Mage::getSingleton('eav/config')
    ->getAttribute('customer', 'customer_balance')
    ->setData('used_in_forms', array('adminhtml_customer'))
    ->save();


$installer->endSetup();
