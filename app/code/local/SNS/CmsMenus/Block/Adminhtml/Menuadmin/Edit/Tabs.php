<?php

class SNS_CmsMenus_Block_Adminhtml_Menuadmin_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('page_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle($this->__('Menu Information'));
    }

    protected function _prepareLayout()
    {

        $this->addTab('link', array(
            'label'     => $this->__('Link'),
            'url'       => $this->getUrl('*/*/link', array('_current' => true)),
            'class'     => 'ajax',
            'after'     => 'general_section'
        ));
        return parent::_prepareLayout();
    }
}
