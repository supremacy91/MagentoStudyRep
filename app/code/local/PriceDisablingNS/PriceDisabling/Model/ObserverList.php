<?php


class PriceDisablingNS_PriceDisabling_Model_ObserverList {

    public function observe_list($observer){
        $moduleActivated = Mage::getStoreConfig("price_disabling/settings/activation");
        if($moduleActivated) {
            if (!Mage::getSingleton("customer/session")->isLoggedIn()) {
                $collection = $observer->getEvent()->getCollection();
                foreach($collection as $col) {

                    $col->setCanShowPrice(false);
                }

            }
        }

    }
}