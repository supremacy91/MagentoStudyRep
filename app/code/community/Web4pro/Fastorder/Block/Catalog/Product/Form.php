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

class Web4pro_Fastorder_Block_Catalog_Product_Form extends Web4pro_Fastorder_Block_FormAbstract
{
    protected function _toHtml()
    {
        if (Mage::registry('current_product')->getTypeId() == Mage_Catalog_Model_Product_Type::TYPE_BUNDLE) {
            $bundled = true;
        }
        if (Mage::registry('current_product')->getTypeId() == Mage_Catalog_Model_Product_Type::TYPE_GROUPED) {
            $grouped = true;
        }
        if($bundled || $grouped) {
            Mage::register('fastorderBundleAndGroupValidate', true);
        }
        return parent::_toHtml();
    }
}