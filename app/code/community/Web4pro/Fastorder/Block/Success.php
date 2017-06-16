<?php
/**
 * WEB4PRO - Creating profitable online stores
 *
 *
 * @author    WEB4PRO <support@web4pro.net>
 * @category  WEB4PRO
 * @package   Web4pro_Fastorder
 * @copyright Copyright (c) 2015 WEB4PRO (http://www.web4pro.net)
 * @license   http://www.web4pro.net/license.txt
 */

class Web4pro_Fastorder_Block_Success extends Web4pro_Fastorder_Block_Abstract
{

    /**
     * @return null|string
     */
    public function getOrderId()
    {
        $id = $this->_getData('order_id');
        return $id ? $id : null;
    }

    /**
     * @return null|string
     */
    public function getPhoneNumber()
    {
        return $this->_getData('phone');
    }

    public function getCustomerEmail()
    {
        return $this->_getData('customer_email');
    }
    
    
    protected function _prepareData()
    {
        $orderId = Mage::getSingleton('checkout/session')->getLastOrderId();

        if ($orderId) {
            $order = Mage::getModel('sales/order')->load($orderId);
            $billingAddress = $order->getBillingAddress();

            if ($order->getId()) {
                $this->addData(array(
                    'order_id'         => $order->getIncrementId(),
                    'phone'            => $billingAddress->getTelephone(),
                    'customer_email'   => $billingAddress->getEmail()
                ));
            }
        }

    }

    
    protected function _beforeToHtml()
    {
        $this->_prepareData();
        parent::_beforeToHtml();
    }
}