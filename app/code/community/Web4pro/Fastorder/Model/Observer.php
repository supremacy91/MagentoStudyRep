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

class Web4pro_Fastorder_Model_Observer
{
    /**
     * @return Web4pro_Fastorder_Helper_Data
     */
    protected function _helper()
    {
        return Mage::helper('web4pro_fastorder');
    }

    /**
     * @dispatch checkout_type_onepage_save_order_after
     * @param Varien_Event_Observer $observer
     * @return $this
     */
    public function saveMagentoOrderId(Varien_Event_Observer $observer)
    {
        $params = Mage::app()->getRequest()->getParams();
        $fastOrderInstance = Mage::registry('fastorder_order_instance');
        if ($fastOrderInstance && $fastOrderInstance instanceof Web4pro_Fastorder_Model_Order) {
            $order = $observer->getEvent()->getOrder();
            if($params['comment']){
                $order->addStatusHistoryComment($params['comment']);
            }

           if($params['email'] && !$order->getCustomerEmail()){
                $order->setCustomerEmail($params['email']);
                $order->save();
            }
            $fastOrderInstance->setMagentoOrderId($order->getId());
            $fastOrderInstance->save();
        }
        Mage::unregister('fastorder_order_instance');

        return $this;
    }
    
    /**
     * @param Varien_Event_Observer $observer
     * @return $this
     */
    public function addPhoneColumnToSalesCollection(Varien_Event_Observer $observer)
    {
        if ($this->_helper()->isDisplayPhoneInSalesOrders()) {
            $collection = $observer->getEvent()->getOrderGridCollection();
            $collection->getSelect()->joinLeft(
                array('web4pro_orders' => $collection->getTable('web4pro_fastorder/order')),
                'web4pro_orders.magento_order_id=main_table.entity_id',
                array('phone', 'country')
            );
        }
        return $this;
    }

    /**
     * @param Varien_Event_Observer $observer
     * @return $this
     */
    public function addPhoneColumnToSalesGrid(Varien_Event_Observer $observer)
    {
        $block = $observer->getEvent()->getBlock();
        if (!isset($block)) {
            return $this;
        }
        if ($block->getType() == 'adminhtml/sales_order_grid' && $this->_helper()->isDisplayPhoneInSalesOrders()) {
            $block->addColumnAfter('customer_phone',
                array(
                    'header' => $this->_helper()->__('Customer Phone'),
                    'type' => 'text',
                    'index' => 'phone',
                    'filter_index' => 'web4pro_orders.phone',
                ),
                'shipping_name'
            );
            $block->sortColumnsByOrder();
        }
        return $this;
    }


    /**
     * @param Varien_Event_Observer $observer
     */
    public function saveFastOrderPlaceAfter(Varien_Event_Observer $observer){
        $order = $observer->getOrder();
        Mage::register('magento_order', $order);
    }

    /**
     * Check Captcha On Place Fastorder
     *
     * @param Varien_Event_Observer $observer
     *
     * @return Web4pro_Fastorder_Model_Observer
     */
    public function checkFastorder(Varien_Event_Observer $observer)
    {
        $formId = 'fastorder-form';
        $helper = Mage::helper('web4pro_fastorder');
        $hasError = false;
        if ($helper->isCaptchaEnabled()) {
            $controller = $observer->getControllerAction();
            $captchaModel = Mage::helper('web4pro_fastorder/captcha')->getCaptcha($formId);
            if (!$captchaModel->isCorrect($this->_getCaptchaString($controller))) {
                $hasError = true;
            }
            $postData = $controller->getRequest()->getPost();
            if($hasError)
            {
                $postData['captcha_error'] = true;
            }
            Mage::getSingleton('customer/session')->setFormData($postData);
        }
    }

    /**
     * Get Captcha String
     *
     * @param Varien_Object $controller
     *
     * @return string
     */
    protected function _getCaptchaString($controller)
    {
        $reCaptchaString = $controller->getRequest()->getPost('g-recaptcha-response');

        return $reCaptchaString;
    }
}
