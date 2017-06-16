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

class Web4pro_Fastorder_Block_Abstract extends Mage_Core_Block_Template
{

    /**
     * @return Web4pro_Fastorder_Helper_Data
     */
    public function getModuleHelper()
    {
        return Mage::helper('web4pro_fastorder');
    }

    protected function _toHtml()
    {
        if(Mage::registry('fastorderBundleAndGroupValidate') === true) {
            return parent::_toHtml();
        }
        if (!$this->getModuleHelper()->isEnabled() || $this->getModuleHelper()->isCartFormShow()) {
            return '';
        }
        return parent::_toHtml();
    }

    /**
     * @return bool
     * rewrite with normal correct core helper
     */
    public function isGuest()
    {
        return !Mage::helper('customer')->isLoggedIn();
    }

}