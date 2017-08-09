<?php

class Web4pro_Fastorder_Model_OrderCurrentProduct
{

    public $_helper;
    
    protected $_quote;

    protected $_productData;

    public function __construct()
    {
        $this->_helper = $this->getHelper('web4pro_fastorder');
        
        $storeId = Mage::app()->getStore()->getId();
        $this->_quote = Mage::getModel('sales/quote')->setStoreId($storeId);
    }
    /**
     * @param $data
     * @param $product
     * @return mixed
     */
    public function getNewQuoteFastOrder($data, $product)
    {
        $customerRegisterId = $this->_helper->registerCustomer($data);
        $this->_productData = $this->_helper->getProductData($data);
        $newAddress = $this->_helper->getNewAddress($data);
        $customer = $this->_helper->getCustomerModel()->load($customerRegisterId);
        $this->_quote->getBillingAddress()->setBillingAddress($newAddress);
        $this->_quote->getShippingAddress()->setShippingAddress($newAddress);
        $this->_quote->assignCustomer($customer);

        try {
            if ($product) {
                $this->_quote->addProduct($product, $this->_productData);
                $this->_quote->getPayment()->importData(array(
                    'method' => 'web4pro_fastorder',
                ));

            } else {
                Mage::getSingleton('checkout/session')->addError(Mage::helper('checkout')->__('Such product has not been found!'));
            }
        } catch (Mage_Core_Exception $e) {
            Mage::log('Create customer error method{getNewQuoteFastOrder}: '. $e->getMessage(),null,'fast-order.log');
        }

        $this->_quote->save();
        $bb = $this->_quote;
        return $this->_quote;
    }
    
    public function submit()
    {
        $service = Mage::getModel('sales/service_quote', $this->_quote);
        $service->submitAll();
        $order = $this->_helper->saveOrderInfo($this->_productData);
        $order->setMagentoOrderId($service->getOrder()->getId());
        $order->save();
        $this->_helper->setBillingAndShippingForOrder($service, $this->_productData);
        Mage::getSingleton('checkout/session')->setFastOrderId($service->getOrder()->getId());
        Mage::getSingleton('checkout/session')->setLastOrderId($service->getOrder()->getId());
    }
    

    public function getHelper($alias)
    {
        return Mage::helper($alias);
    }
    
}