<?php
class MyShop_MyCarrier_Model_Carrier
    extends Mage_Shipping_Model_Carrier_Abstract
    implements Mage_Shipping_Model_Carrier_Interface
{

    protected $_code = 'new_method';
    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }

        $countWeight = 0;
        $countPrice = 0;
        if ($request->getAllItems()) {
            foreach ($request->getAllItems() as $item) {

                if ($item->getFreeShipping() || $item->getProduct()->isVirtual() || $item->getParentItem()) {
                    continue;
                }
                $countWeight += $item->getWeight() * $item->getQty();

                if ($item->getHasChildren() && $item->isShipSeparately()) {
                    foreach ($item->getChildren() as $child) {
                        if ($child->getFreeShipping() && !$child->getProduct()->isVirtual()) {
                            $freeBoxes += $item->getQty() * $child->getQty();
                        }
                    }
                } elseif ($item->getFreeShipping()) {
                    $freeBoxes += $item->getQty();
                }
                $this->setFreeBoxes($freeBoxes);
                $countPrice = ($request->getPackageQty() * $this->getConfigData('first_deliver_price')) - ($freeBoxes * $this->getConfigData('first_deliver_price'));

            }
        }

        $result = Mage::getModel('shipping/rate_result');
        $method = Mage::getModel('shipping/rate_result_method');

        $method->setCarrier('new_method');
        $method->setCarrierTitle($this->getConfigData('title'));

        $method->setMethod('new_method');
        $method->setMethodTitle($this->getConfigData('name'));
        //Mage::log($countWeight);
        
       // var_dump(unserialize($this->getConfigData('weight_price')));


        $weight_price = unserialize($this->getConfigData('weight_price'));

        $faceControl = 1;
        foreach($weight_price as $code => $mas) {
            if($faceControl) {
                $flag = 0;
                foreach($mas as $key => $value) {
                    if(!$flag) {
                        $weightIndex = $key;
                        $flag++;
                    }
                    if($flag) {
                        $priceIndex = $key;
                        $flag++;
                    }
                }
                $faceControl = 0;
            }

            if ($countWeight < $mas[$weightIndex]) {
                break;
            }
            $countPrice = $mas[$priceIndex];
            
        }

        //var_dump($countWeight);
        $method->setWeight($countWeight);
        $method->setPrice($countPrice);

        $result->append($method);
        return $result;
    }

    public function getAllowedMethods()
    {
        return array('new_method'=>$this->getConfigData('name'));
    }

}