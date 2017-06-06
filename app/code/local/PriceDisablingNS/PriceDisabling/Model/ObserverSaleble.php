<?php


class PriceDisablingNS_PriceDisabling_Model_ObserverSaleble {

    public function observe_saleble($observer){
        $moduleActivated = Mage::getStoreConfig("price_disabling/settings/activation");
        if($moduleActivated) {
            if (!Mage::getSingleton("customer/session")->isLoggedIn()) {

                $observer->getEvent()->getSalable()->setIsSalable(false);

            }
        }

    }
}