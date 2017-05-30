<?php

class SharesNS_Shares_Block_Adminhtml_Sharesadmin_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('shares_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle($this->__('Shares Information'));
    }

    protected function _prepareLayout()
    {

        $this->addTab('link', array(
            'label'     => $this->__('Share settings'),
            'url'       => $this->getUrl('*/*/link', array('_current' => true)),
            'class'     => 'ajax',
            'after'     => 'share_section'
        ));
        return parent::_prepareLayout();
    }
}
