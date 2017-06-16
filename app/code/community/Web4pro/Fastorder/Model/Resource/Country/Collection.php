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

class Web4pro_Fastorder_Model_Resource_Country_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{

    protected function _construct()
    {
        $this->_init('web4pro_fastorder/country');
    }

    public function toOptionArray($withCountryName = true)
    {
        $res = array();

        foreach ($this as $item) {
            $label = $item->getPhoneCode();
            if ($withCountryName) {
                $label .= ' (' . Mage::app()->getLocale()->getCountryTranslation($item->getCountryCode()) . ')';
            }
            $res[] = array(
                'value' => $item->getCountryCode(),
                'label' => $label
            );
        }
        return $res;
    }

    /**
     * Retrieve available country list for phone prefixes
     *
     * @return array
     */
    public function toCountryOptionArray()
    {
        $options = array();

        foreach ($this as $item) {
            $countryCode = $item->getCountryCode();

            $options[] = array(
                'value' => $countryCode,
                'label' => Mage::app()->getLocale()->getCountryTranslation($countryCode)
            );
        }

        return $options;
    }
}