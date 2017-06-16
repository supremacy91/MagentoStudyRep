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

class Web4pro_Fastorder_IndexController extends Mage_Core_Controller_Front_Action
{
    const CHARS_LOWERS                          = 'abcdefghijklmnopqrstuvwxyz';
    const CHARS_UPPERS                          = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    protected $_errors = array();

    /**
     * @return Mage_Checkout_OnepageController
     */
    public function preDispatch()
    {
        parent::preDispatch();

        $helper = $this->helper('web4pro_fastorder');
        if (!$helper->isEnabled()) {
            return $this->ajaxEnd(array(
                'error' => $helper->__('Please, use standard checkout for order product.')
            ));
        }
    }


    public function saveOrderCurrentProductAction()
    {
        $order = Mage::getModel('web4pro_fastorder/orderCurrentProduct');
        $helper = $this->helper('web4pro_fastorder');
        $params = $this->getRequest()->getParams();
        $product =  $helper->initProduct($params);

        $quote = $order->getNewQuoteFastOrder($params, $product);

        if($this->validate($quote, $product)){
            return $this->ajaxEnd(array(
                'error' => $helper->getErrors()
            ));
        }

        Mage::register('fastorder_ignore_quote_validation', true);
        try{
            $order->submit();
        }catch(Exception $e){
            Mage::logException($e);
            return $this->ajaxEnd(array(
                'error' => $helper->__('Sorry, there was a failure ... Try to add the product to the cart and place an order through the ordering process!')
            ));
        }
        Mage::unregister('fastorder_ignore_quote_validation');
        
        return $this->ajaxEnd(array(
            'success' => true,
            'redirect' => Mage::getUrl('web4pro_fastorder/index/success')
        ));
    }

    /**
     * Save and process order
     */
    public function saveOrderAction()
    {
        $helper = $this->helper('web4pro_fastorder');
        if($this->validate()){
            return $this->ajaxEnd(array(
                'error' => $helper->getErrors()
            ));
        }

        $params = $this->getRequest()->getParams();
        $helper->checkoutSessionQuote(); 
        
        if (!$helper->getOnepage()->getQuote()->hasItems() || $helper->getOnepage()->getQuote()->getHasError()) {
            return $this->ajaxEnd(array(
                'error' => $helper->__('Please, add item to Cart before order.')
            ));
        }

        $order = $helper->saveOrderInfo($params);
        $helper->saveMagentoOrder();
        $order->save();
        $data = $helper->getProductData($params);
        $helper->setBillingAndShippingForOrder($order, $data);

        $helper->getOnepage()->getQuote()->setIsActive(0)->save();

        $helper->clearCart();
        Mage::getSingleton('checkout/session')->setFastOrderId($order->getId());
        
        return $this->ajaxEnd(array(
            'success' => true,
            'redirect' => Mage::getUrl('web4pro_fastorder/index/success')
        ));
    }

    /**
     * Success page
     */
    public function successAction()
    {
        if (!Mage::getSingleton('checkout/session')->getFastOrderId()) {
            return $this->_redirect('checkout/cart/index');
        }
        Mage::getSingleton('checkout/session')->setFastOrderId(false);
        $this->loadLayout();

        $this->_initLayoutMessages('checkout/session');
        $this->renderLayout();
    }

    /**
     * @param $helperAlias
     * @return Mage_Core_Helper_Abstract
     */
    public function helper($helperAlias)
    {
        return Mage::helper($helperAlias);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function ajaxEnd($data)
    {
        return $this->getResponse()->setBody(
            Mage::helper('core')->jsonEncode($data)
        );
    }


    /**
     * @return mixed
     */
    public function validate($quote = false, $product = false)
    {
        $helper = $this->helper('web4pro_fastorder');
        
        $params = $this->getRequest()->getParams();
        $params['quote']       = $quote;
        $params['productData'] = $product;
        $formData = Mage::getSingleton('customer/session')->getFormData();
        $hasCaptchaError = $formData['captcha_error'] ? $formData['captcha_error'] : false;

        Mage::getSingleton('customer/session')->unsFormData();

        if (!$helper->validateData($params, $hasCaptchaError)) {
            return true;
        }
        return false;
    }

}
