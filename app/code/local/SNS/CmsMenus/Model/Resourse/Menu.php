<?php

class SNS_CmsMenus_Model_Resource_Menu extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Initialize resource model
     *
     */
    protected function _construct()
    {
        $this->_init('cmsMenu/menu', 'menu_id');
    }
}