<?php
class MyShop_MyCarrier_Block_System_Fields extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{
    public function __construct()
    {
        $this->addColumn('regexp', array(
            'label' => $this->__('Minimal Weight'),
            'style' => 'width:120px',
        ));
        $this->addColumn('value', array(
            'label' => $this->__('Delivery Price $'),
            'style' => 'width:120px',
        ));
        $this->_addAfter = false;
        $this->_addButtonLabel = Mage::helper('adminhtml')->__('Add Weight Price');
        parent::__construct();
    }
}
