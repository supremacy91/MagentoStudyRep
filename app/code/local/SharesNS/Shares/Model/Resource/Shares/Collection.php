<?php

class SharesNS_Shares_Model_Resource_Shares_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Define resource model
     *
     */
    protected function _construct()
    {
        $this->_init('shares/shares');

    }
}

