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

class Web4pro_Fastorder_Block_Adminhtml_Fastorder_Phonecode_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('fastorder_phonecode_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('web4pro_fastorder')->__('Country Calling Code Information'));
    }
}
