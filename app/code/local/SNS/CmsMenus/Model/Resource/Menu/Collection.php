<?php

class SNS_CmsMenus_Model_Resource_Menu_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Define resource model
     *
     */
    protected function _construct()
    {
        $this->_init('cmsMenu/menu');

    }
}

