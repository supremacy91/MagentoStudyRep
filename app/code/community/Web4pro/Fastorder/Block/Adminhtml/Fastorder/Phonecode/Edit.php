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

class Web4pro_Fastorder_Block_Adminhtml_Fastorder_Phonecode_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_objectId   = 'id';
        $this->_blockGroup = 'web4pro_fastorder';
        $this->_controller = 'adminhtml_fastorder_phonecode';

        $this->_removeButton('reset');
        if(Mage::getSingleton('admin/session')->isAllowed('web4pro_attachments/fastorder_settings/phonecode/change')){
            $this->_updateButton('save', 'label', Mage::helper('web4pro_fastorder')->__('Save'));
            $this->_updateButton('delete', 'label', Mage::helper('web4pro_fastorder')->__('Delete'));
            $this->_addButton('saveandcontinue', array(
                'label'     => Mage::helper('web4pro_fastorder')->__('Save And Continue Edit'),
                'onclick'   => 'saveAndContinueEdit()',
                'class'     => 'save',
            ), -100);
            $this->_formScripts[] = "
		    function saveAndContinueEdit(){
			    editForm.submit($('edit_form').action+'back/edit/');
			}
		";
        }else{
            $this->_removeButton('save');
            $this->_removeButton('delete');
        }
    }

    public function getHeaderText()
    {
        if( Mage::registry('fastorder_phonecode_data') && Mage::registry('fastorder_phonecode_data')->getEntityId() )
        {
            return Mage::helper('web4pro_fastorder')->__("Edit Country Calling Code '%s'",
                $this->escapeHtml(Mage::registry('fastorder_phonecode_data')->getEntityId())
            );
        }
        else
        {
            return Mage::helper('web4pro_fastorder')->__('Add Country Calling Code');
        }
    }
}