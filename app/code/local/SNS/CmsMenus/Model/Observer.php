<?php


class SNS_CmsMenus_Model_Observer {

    public function cms_page_render_func($observer) {
        $pageModel = $observer->getEvent()->getPage();
        Mage::register("current_page", $pageModel);
    }
}