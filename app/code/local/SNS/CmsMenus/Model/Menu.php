<?php
class SNS_CmsMenus_Model_Menu extends Mage_Core_Model_Abstract
{


    protected function _construct()
    {
        parent::_construct();
        $this->_init('cmsMenu/menu');
    }



}