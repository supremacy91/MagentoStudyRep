<?php

class SNS_CmsMenus_Adminhtml_MenuController extends Mage_Core_Controller_Front_Action
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

}
