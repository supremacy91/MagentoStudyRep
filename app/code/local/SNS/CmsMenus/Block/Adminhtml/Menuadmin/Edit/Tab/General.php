<?php
class SNS_CmsMenus_Block_Adminhtml_Menuadmin_Edit_Tab_General
    extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    public function __construct()
    {
        parent::__construct();
        $this->setShowGlobalIcon(true);
    }


  protected function _prepareForm()
    {
        $isElementDisabled = false;

        $form = new Varien_Data_Form();


        $model = Mage::registry('cmsMenu_menu');

        $layoutFieldset = $form->addFieldset('layout_fieldset', array(
            'legend' => Mage::helper('cms')->__('Menu Edit'),
            'class'  => 'fieldset-wide',
            'disabled'  => $isElementDisabled
        ));

        $layoutFieldset->addField('menu_id', 'hidden', array(
            'name'      => 'menu_id',

        ));

        $layoutFieldset->addField('name', 'text', array(
            'name'      => 'name',
            'label'     => $this->__('Name'),
           // 'style'     => 'height:24em;',
            'disabled'  => $isElementDisabled
        ));

        $layoutFieldset->addField('status', 'select', array(
            'name'     => 'status',
            'label'    => $this->__('Status'),
            'required' => true,
            'values'   => array(array('label'=>$this->__('Enabled'), 'value'=>1), array('label'=>$this->__('Disabled'), 'value'=>0)),
            'disabled' => $isElementDisabled
        ));


        $layoutFieldset->addField('link', 'text', array(
            'name'      => 'link',
            'label'     => $this->__('Link'),
            // 'style'     => 'height:24em;',
            'disabled'  => $isElementDisabled
        ));



        $form->setValues($model->getData());

        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return $this->__('General');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return $this->__('Design');
    }

    /**
     * Returns status flag about this tab can be showen or not
     *
     * @return true
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Returns status flag about this tab hidden or not
     *
     * @return true
     */
    public function isHidden()
    {
        return false;
    }


}