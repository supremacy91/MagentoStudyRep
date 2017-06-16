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

class Web4pro_Fastorder_Model_Resource_Order extends Mage_Core_Model_Mysql4_Abstract
{

    protected function _construct()
    {
        $this->_init('web4pro_fastorder/order', 'entity_id');
    }

}