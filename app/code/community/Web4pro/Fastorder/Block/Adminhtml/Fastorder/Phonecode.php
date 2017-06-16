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

class Web4pro_Fastorder_Block_Adminhtml_Fastorder_Phonecode extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'web4pro_fastorder';
        $this->_controller = 'adminhtml_fastorder_phonecode';
        $this->_headerText = Mage::helper('web4pro_fastorder')->__('Country Calling Codes');
        parent::__construct();

        if (!Mage::getSingleton('admin/session')->isAllowed('web4pro_attachments/fastorder_settings/phonecode/change')) {
            $this->_removeButton('add');
        }
    }
}