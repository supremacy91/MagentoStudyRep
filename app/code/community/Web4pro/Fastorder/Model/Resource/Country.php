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

class Web4pro_Fastorder_Model_Resource_Country extends Mage_Core_Model_Mysql4_Abstract
{

    protected function _construct()
    {
        $this->_init('web4pro_fastorder/country', 'entity_id');
    }

    /**
     * Get country calling code by country code
     *
     * @param string $countryCode
     * @return string|false
     */
    public function getPhoneByCountry($countryCode)
    {
        $adapter = $this->_getReadAdapter();

        $select = $adapter->select()
            ->from($this->getMainTable(), 'phone_code')
            ->where('country_code = :country_code');

        $bind = array(':country_code' => (string)$countryCode);
        return $adapter->fetchOne($select, $bind);
    }
}