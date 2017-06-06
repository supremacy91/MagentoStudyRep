<?php


class PriceDisablingNS_PriceDisabling_Model_ObserverView {

    public function observe_views($observer){
        $moduleActivated = Mage::getStoreConfig("price_disabling/settings/activation");
        if($moduleActivated) {
            if (!Mage::getSingleton("customer/session")->isLoggedIn()) {
               // Mage::log("ObserverView");
                $observer->getEvent()->getProduct()->setCanShowPrice(false);
            }
        }

    }
}