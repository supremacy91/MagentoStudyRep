<?php
/**
 * WEB4PRO - Creating profitable online stores
 *
 *
 * @author    WEB4PRO <support@web4pro.net>
 * @category  WEB4PRO
 * @package   Web4pro_Fastorder
 * @copyright Copyright (c) 2015 WEB4PRO (http://www.web4pro.net)
 * @license   http://www.web4pro.net/license.txt
 */

class Web4pro_Fastorder_Block_Adminhtml_Fastorder_Phonecode_Edit_Tab_Main
    extends Mage_Adminhtml_Block_Widget_Form implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset("main_form", array(
            "legend" => Mage::helper("web4pro_fastorder")->__("General Information")
        ));

        $phoneCodeField = $fieldset->addField('phone_code', 'text', array(
            'name' => 'phone_code',
            'label' => Mage::helper('web4pro_fastorder')->__('Phone Prefix Code'),
            'title' => Mage::helper('web4pro_fastorder')->__('Phone Prefix Code'),
            'class' => 'validate-phonePrefixCode',
            'required' => true,
        ));

        $phoneCodeField->setAfterElementHtml(
            "<script type='text/javascript'>
                 Validation.add(
                    'validate-phonePrefixCode',
                    'Please use this phone prefix format: +XXX.<br>' +
                    'For example +1.<br>' +
                    'Note: \'+\'(plus) is required. The prefix must contain at least 1 number and be no more than 5',
                    function(v) {
                        if(Validation.get('IsEmpty').test(v)) return true;
                        var regex = /^\+\d{1,5}$/;
                        return regex.test(v);
                    }
                );
                Element.observe('phone_code', 'change', function(){
                    Validation.validate($('phone_code'))
                }.bind($('phone_code')));
            </script>");

        $fieldset->addField('country_code', 'select', array(
            'label' => Mage::helper('web4pro_fastorder')->__('Country'),
            'name' => 'country_code',
            'class' => 'countries',
            'values' => Mage::getModel('adminhtml/system_config_source_country')->toOptionArray(),
            'required' => true
        ));

        $fieldset->addField('order', 'text', array(
            'name' => 'order',
            'label' => Mage::helper('web4pro_fastorder')->__('Position'),
            'title' => Mage::helper('web4pro_fastorder')->__('Position'),
            'class' => 'validate-digits',
            'required' => false
        ));

        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('web4pro_fastorder')->__('Status'),
            'required'  => true,
            'name'      => 'status',
            'values'    => array(
                0 => Mage::helper('web4pro_fastorder')->__('Disabled'),
                1 => Mage::helper('web4pro_fastorder')->__('Enabled')
            ),
        ));

        $data = Mage::registry("fastorder_phonecode_data");
        $form->setValues($data);

        return parent::_prepareForm();
    }

    /**
     * Prepare content for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return Mage::helper('web4pro_fastorder')->__('General Information');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return Mage::helper('web4pro_fastorder')->__('General Information');
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