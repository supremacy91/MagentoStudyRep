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

class Web4pro_Fastorder_Model_Country extends Mage_Core_Model_Abstract
{

    /**
     * Initialize resources
     */
    protected function _construct()
    {
        $this->_init('web4pro_fastorder/country');
    }

    /**
     * Retrieve resource instance wrapper
     *
     * @return Web4pro_Fastorder_Model_Resource_Country
     */
    protected function _getResource()
    {
        return parent::_getResource();
    }

    /**
     * Load model by field
     *
     * @param string $countryCode
     * @return string
     */
    public function getPhoneByCountry($countryCode)
    {
        return $this->_getResource()->getPhoneByCountry($countryCode);
    }
}