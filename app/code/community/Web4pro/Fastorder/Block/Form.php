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

class Web4pro_Fastorder_Block_Form extends Web4pro_Fastorder_Block_FormAbstract
{
    /**
     * @return string
     */
    protected function _toHtml()
    {

        if(Mage::registry('fastorderBundleAndGroupValidate') === true) {
            return parent::_toHtml();
        }
        if ($this->getModuleHelper()->isCartFormShow()  || $this->getModuleHelper()->isCartFormShow()) {
            return '';
        }
        return parent::_toHtml();
    }
}