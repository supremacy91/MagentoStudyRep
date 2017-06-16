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

class Web4pro_Fastorder_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_ENABLED = 'web4pro_fastorder/general/active';
    const XML_PATH_SEND_EMAIL = 'web4pro_fastorder/general/send_email';
    const XML_PATH_EMAIL = 'web4pro_fastorder/general/email';
    const XML_PATH_CHANGE_ONEPAGE_CHECKOUT = 'web4pro_fastorder/checkout/change_onepage';
    const XML_PATH_DISPLAY_PHONE_IN_SALES_ORDERS = 'web4pro_fastorder/general/display_phone_in_sales_orders';
    const XML_PATH_FAST_ORDER_DESCRIPTION = 'web4pro_fastorder/general/fast_order_description';
    const XML_PATH_SEND_EMAIL_TO_CUSTOMER = 'web4pro_fastorder/general/send_customer_email';
    const XML_PATH_SHOW_FOR_PRODUCTS_MORE_EXPENSIVE_THAN = 'web4pro_fastorder/general/show_for_product_more_expensive_than';
    const XML_PATH_CAPTCHA_ENABLE = 'web4pro_fastorder/captcha/enable';
    const XML_PATH_CAPTCHA_LANGUAGE = 'web4pro_fastorder/captcha/language';
    const XML_PATH_CAPTCHA_THEME = 'web4pro_fastorder/captcha/theme';
    const XML_PATH_CAPTCHA_PRIVATE_KEY = 'web4pro_fastorder/captcha/private_key';
    const XML_PATH_CAPTCHA_PUBLIC_KEY = 'web4pro_fastorder/captcha/public_key';

    /**
     * @var array
     */
    protected $phoneCodes = array();

    /**
     * Is Fast Order functionality enabled
     *
     * @return bool
     */
    public function isEnabled()
    {
        $enabledCondition = Mage::getStoreConfigFlag(self::XML_PATH_ENABLED);
        $priceCondition = true;
        $currentProductMinPrice = $this->_getMaxProductPrice();
        $minConfigPrice = $this->getPriceBigger();
        $request = $this->_getRequest();
        $isProductPage = ($request->getControllerName()=='product') ? true : false;
        if($currentProductMinPrice < $minConfigPrice && $isProductPage) {
            $priceCondition = false;
        }
        return ($priceCondition && $enabledCondition);
    }

    /**
     * returns max product price for different types of product
     * @return float|mixed
     */
    protected function _getMaxProductPrice()
    {
        $currentProduct = Mage::registry('current_product');
        $request = $this->_getRequest();
        if($request->isAjax()) {
            $currentProduct = Mage::getModel('catalog/product')->load($request->getParam('product'));
        }
        $maxPrice = 0.0;
        if(!($currentProduct instanceof Mage_Catalog_Model_Product)) {
            return $maxPrice;
        }
        $currentProductType = $currentProduct->getTypeID();
        switch ($currentProductType) {
            case 'configurable':
                $maxPrice = (float) $currentProduct->getPrice();
                break;
            case 'grouped':
                $productIds = $currentProduct->getTypeInstance()->getChildrenIds($currentProduct->getId());
                $groupedPrices = array();
                foreach ($productIds as $ids) {
                    foreach ($ids as $id) {
                        $childProduct = Mage::getModel('catalog/product')->load($id);
                        $groupedPrices[] = (float) $childProduct->getPriceModel()->getPrice($childProduct);
                    }
                }
                if(is_array($groupedPrices)) {
                    $maxPrice = max($groupedPrices);
                }
                break;
            case 'bundle':
                $bundlePrices = array();
                $selectionCollection = $currentProduct->getTypeInstance(true)->getSelectionsCollection(
                    $currentProduct->getTypeInstance(true)->getOptionsIds($currentProduct), $currentProduct);
                foreach ($selectionCollection as $option) {
                    if ($option->getPrice() != "0.0000") {
                        $bundlePrices [] = (double) $option->getPrice();
                    }
                }
                if(is_array($bundlePrices)) {
                    $maxPrice = max($bundlePrices);
                }
                break;
            default:
                $maxPrice = $currentProduct->getFinalPrice();
        }
        return $maxPrice;
    }

    /**
     * get admin email address for send
     *
     * @return bool|string
     */
    public function getOrderNotificationEmail()
    {
        $email = false;
        if ($this->isSendEmail()) {
            $email = Mage::getStoreConfig(self::XML_PATH_EMAIL);
            if (!$email) {
                $email = Mage::getStoreConfig('trans_email/ident_general/email');
            }
        }
        return $email;
    }

    /**
     * Return country calling codes
     *
     * @return Web4pro_Fastorder_Model_Resource_Country_Collection
     */
    public function getPhonePrefixCodes()
    {
        $collection = Mage::getResourceModel('web4pro_fastorder/country_collection');
        $collection->addFieldToFilter('status', 1);
        $collection->setOrder('main_table.order', Varien_Data_Collection::SORT_ORDER_ASC);
        return $collection;
    }

    /**
     * Return phone code by country code
     *
     * @param string $countryCode
     * @return string
     */
    public function getPhoneCodeByCountry($countryCode)
    {
        if (!isset($this->phoneCodes[$countryCode])) {
            $phoneCode = Mage::getModel('web4pro_fastorder/country')->getPhoneByCountry($countryCode);
            $this->phoneCodes[$countryCode] = $phoneCode;
        }

        return $this->phoneCodes[$countryCode];
    }

    /**
     * @param $data
     * @return bool
     */
    public function initProduct($data) {

        $productId = (int) $data['product'];

        if ($productId) {
            $product = Mage::getModel('catalog/product')
                ->setStoreId(Mage::app()->getStore()->getId())
                ->load($productId);
            if ($product->getId())
                return $product;
        }
        return false;
    }

    /**
     * @param $data
     * @return bool|mixed
     */
    public function createCustomer($data){
        $pwdLength = 8;
        $customer = $this->getCustomerModel();
        $customer->setFirstname('Guest');
        $customer->setLastname('Guest');
        $customer->setCreatedAt(date('Y-m-d h:i:s'));
        $customer->setUpdatedAt(date('Y-m-d h:i:s'));
        $customer->setEmail($data['email']);
        $customer->setTelephone($data['phone']);

        $customer->setPassword($customer->generatePassword($pwdLength));
        $customer->save();
        try{
            if($customer->getEmail()){
                $customer->sendNewAccountEmail(); //send confirmation email to customer
            }
        } catch (Exception $e){
            Mage::log('Create customer error method{createCustomer}: '. $e->getMessage(),null,'fast-order.log');
        }

        //for newsly created customer set the phone number

        $customerAddress = Mage::getModel('customer/address');
        $customerAddress->setCustomerId($customer->getId())
            ->setFirstname($customer->getFirstname())
            ->setLastname($customer->getLastname())
            ->setCountryId($data['country'])
            ->setCity('Guest')
            ->setStreet('Guest')
            ->setIsDefaultBilling('1')
            ->setIsDefaultShipping('1')
            ->setSaveInAddressBook('1')
            ->setTelephone($data['phone'])
            ->setEmail($data['email']);

        $customerAddress->save();

        return $customer->getId();
    }

    /**
     * @param $data
     * @return bool|mixed
     * @throws Mage_Core_Exception
     */
    public function registerCustomer($data){
        $customerModel = $this->getCustomerModel();
        $customerModel->setWebsiteId(Mage::app()->getWebsite('admin')->getId());
        $customerModel->setStore(Mage::app()->getStore());

        $customer = $customerModel->loadByEmail($data['email']);
        $customerId = $customer->getId();

        if($customerId) {
            $newBilling = $this->getNewAddress($data);
            $customer->setBillingAddress($newBilling);
            $customer->save();
            return $customer->getId();
        }else{
            $customerId = $this->createCustomer($data);
        }
        
        return $customerId;
    }

    /**
     * validate entered data
     * @param $data
     * @return bool
     */
    public function validateData($data,$hasCaptchaError)
    {
        $product  = $data['productData'];
        $quote    = $data['quote'];

        $formData = $this->getProductData($data);
        if (!$formData->getPhone())
        {
            $this->_errors[] = $this->__("Phone empty, fill required fields");
        }

        if(!Zend_Validate::is($formData->getEmail(), 'Zend_Validate_EmailAddress'))
        {
            $this->_errors[] = $this->__('Please enter a valid email address.');
        }

        if($hasCaptchaError && $this->isCaptchaEnabled())
        {
            $this->_errors[] = $this->__('Captcha Validation failed.');
        }

        if($product)
        {
            if(!$this->isConfigurableValidate($product, $formData))
            {
                $this->_errors[] = $this->__('Please specify the product\'s option(s).');
                return !(bool)count($this->_errors);
            }
        }

        if($quote)
        {
            if($this->isPriceForProductEnable($quote))
            {
                $error = sprintf('Sorry, but the price when ordering through Fast Order can not be less than %s%s', $this->getPriceBigger(), $this->getSymbol());
                $this->_errors[] = $this->__($error);
            }
        }

        return !(bool)count($this->_errors);
    }

    public function getPriceBigger()
    {
        return Mage::getStoreConfig(self::XML_PATH_SHOW_FOR_PRODUCTS_MORE_EXPENSIVE_THAN);
    }

    public function getSymbol()
    {
        return Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol();
    }


    public function getProductData($data)
    {
        foreach ($data as $key => $value)
        {
            if(is_object($value))
            {
                unset($data[$key]);
            }
        }

        $data = $this->filterData($data);

        $productData = new Varien_Object();
        $productData->setData($data);

        return $productData;
    }

    /**
     * @param $service
     * @param $data
     * @return bool
     * @throws Exception
     */
    public function setBillingAndShippingForOrder($service ,$data)
    {
        if($service instanceOf Mage_Sales_Model_Service_Quote){
            $orderId = $service->getOrder()->getId();
            $order = Mage::getModel('sales/order')->load($orderId);
        }else if($service instanceOf Web4pro_Fastorder_Model_Order) {
            $orderId = $service->getMagentoOrderId();
            $order = Mage::getModel('sales/order')->load($orderId);
        }

        if(!$order)
        {
            return false;
        }

        $data = $this->getCustomerData($data);
        /*Set telephone for Shipping Address*/
        $orderShippingAddress = $order->getShippingAddress()->getId();
        $orderShipping = Mage::getModel('sales/order_address')->load($orderShippingAddress);
        $orderShipping->setTelephone($data['telephone'])
            ->setFirstname($data['firstname'])
            ->setLastname($data['lastname'])
            ->setEmail($data['email'])
            ->setCity($data['city'])
            ->setFax($data['fax'])
            ->setPostcode($data['postcode'])
            ->setCompany($data['company'])
            ->setRegion($data['region'])
            ->setRegionId($data['region_id'])
            ->setMiddlename($data['middlename'])
            ->setCountryId($data['country_id'])
            ->setStreet($data['street']);

        /*Set telephone for Billing Address*/
        $orderBillingAddress = $order->getBillingAddress()->getId();
        $orderBilling = Mage::getModel('sales/order_address')->load($orderBillingAddress);
        $orderBilling->setTelephone($data['telephone'])
            ->setFirstname($data['firstname'])
            ->setLastname($data['lastname'])
            ->setEmail($data['email'])
            ->setCity($data['city'])
            ->setFax($data['fax'])
            ->setPostcode($data['postcode'])
            ->setCompany($data['company'])
            ->setRegion($data['region'])
            ->setRegionId($data['region_id'])
            ->setMiddlename($data['middlename'])
            ->setCountryId($data['country_id'])
            ->setStreet($data['street']);

        $orderShipping->save();
        $orderBilling->save();
    }

    
    public function getCustomerData($data)
    {
        $customer = Mage::getSingleton('customer/customer');
        $websiteId = Mage::app()->getWebsite()->getId();
        $customer->setWebsiteId($websiteId);
        $customer->loadByEmail($data->getEmail());

        $address = $customer->getPrimaryBillingAddress();
        return array(
            'firstname'  => $customer->getFirstname() ? $customer->getFirstname() : $this->_('Guest Fast Order'),
            'lastname'   => $customer->getLastname() ? $customer->getLastname() : $this->_('Guest Fast Order'),
            'email'      => $data->getEmail(),
            'telephone'  => $data->getPhone(),
            'region'     => $address->getRegion() ? $address->getRegion() : '',
            'middlename' => $address->getMiddlename() ? $address->getMiddlename() : '',
            'company' => $address->getCompany() ? $address->getCompany() : '',
            'fax' => $address->getFax() ? $address->getFax() : '',
            'street' => $address->getStreet() ? $address->getStreet() : '',
            'region_id'  => $address->getRegionId() ? $address->getRegionId() : '',
            'postcode'  => $address->getPostcode() ? $address->getPostcode() : '',
            'country_id'  => $address->getCountryId() ? $address->getCountryId() : '',
            'city'  => $address->getCity() ? $address->getCity() : '',
        );
    }
    /**
     * @param $data
     * @return false|Mage_Core_Model_Abstract
     */
    public function getNewAddress($data)
    {
        $newBillingAddress = Mage::getModel('sales/quote_address');
        $newBillingAddress->setEmail($data['email']);
        $newBillingAddress->setTelephone($data['phone']);

        return $newBillingAddress;
    }

    /**
     * Prepare customer full phone number
     *
     * @param array $data
     * @return string
     */
    public function _prepareCustomerPhone($data)
    {
        $postData = $this->getProductData($data);
        $phoneCode = $this->getPhoneCodeByCountry($postData->getCountry());
        $fullPhoneNumber = "{$phoneCode}{$postData->getPhone()}";
        unset($postData);

        return $fullPhoneNumber;
    }

    /**
     * @param $product
     * @param $buyRequest
     * @return bool
     */
    public function isConfigurableValidate($product, $buyRequest)
    {
        if($product->isConfigurable())
        {
            $configurable = Mage::getModel('catalog/product_type_configurable');
            $validate = $configurable->processConfiguration($buyRequest, $product ,'full');
            if(!is_array($validate)){
               return false;
            }
        }
        return true;
    }

    /**
     * @param $data
     * @return Web4pro_Fastorder_Model_Order
     */
    public function saveOrderInfo($data)
    {
        $customerId = false;

        if($this->isGuest()){
            $customerId = $this->registerCustomer($data);
        }

        $model = $this->getFastOrderModel($data, $customerId);
        Mage::register('fastorder_order_instance', $model);
        
        $quote = $this->getOnepage()->getQuote();

        // save for Guest

        if (!$customerId) {
            $customer = Mage::getSingleton('customer/session');
        } else{
            $customer = $this->getCustomerModel()->load($customerId);
        }

        $newAddress = $this->getNewAddress($data);

        $quote->assignCustomer($customer);
        $quote->getBillingAddress()->setBillingAddress($newAddress)->save();        
        $model->setPhone($data['phone']);
        return $model;
    }

    /**
     * @param $data
     * @param $customerId
     * @return false|Mage_Core_Model_Abstract
     */
    public function getFastOrderModel($data, $customerId)
    {
        $model = Mage::getModel('web4pro_fastorder/order');
        $model->setData($data);
        $model->setCustomerId($customerId);
        $model->setQuoteId($this->getOnepage()->getQuote()->getId());
        $model->setStoreId(Mage::app()->getStore()->getId());
        $model->setCreateDate(date('Y-m-d h:i:s'));
        $phone = $this->_prepareCustomerPhone($data);
        $model->setTelephone($phone);
        $model->setCustomerEmail($data['email']);
        
        return $model;
    }

    /**
     * Save order in Magento
     * @return bool
     */
    public function saveMagentoOrder()
    {
        $onepage = $this->getOnepage();
        try {
            $onepage->getQuote()->setTotalsCollectedFlag(false);
            $onepage->savePayment(array(
                'method' => 'web4pro_fastorder',
            ));
            $onepage->getQuote()->setTotalsCollectedFlag(false)->collectTotals()->save();
            Mage::register('fastorder_ignore_quote_validation', true);
            Mage::register('save_magento_order_from_fastorder', true);
            $onepage->saveOrder();
            Mage::unregister('fastorder_ignore_quote_validation');
        } catch (Exception $e) {
            Mage::log('Create customer error method{saveMagentoOrder}: '. $e->getMessage(),null,'fast-order.log');
        }
    }

    

    public function filterData($data)
    {
        if($data['bundle_option'])
        {
            foreach($data['bundle_option'] as $key => $values)
            {
                foreach($values as $value)
                {
                    $options = explode(',', $value);
                }
                $bundleOption[$key] = $options;
            }
            $data['bundle_option'] = $bundleOption;
        }
        return $data;
    }
    
    /**
     * @return bool
     * rewrite with normal correct core helper
     */
    public function isGuest()
    {
        return !Mage::helper('customer')->isLoggedIn();
    }

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->getCart()->getQuote()->getCustomer();
    }

    /**
     * @return Mage_Core_Model_Abstract
     */
    public function getCart(){
        return Mage::getSingleton('checkout/cart');
    }


    /**
     * @return string
     */
    public function getErrors()
    {
        return implode("\n\n", $this->_errors);
    }

    /**
     * @return Mage_Core_Model_Abstract
     */
    public function getOnepage()
    {
        return Mage::getSingleton('checkout/type_onepage');
    }

    /**
     * @return Mage_Core_Model_Abstract
     */
    public function getSession()
    {
        return Mage::getSingleton('checkout/session');
    }

    /**
     * @return bool
     */
    public function isCaptchaEnabled()
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_CAPTCHA_ENABLE);
    }

    /**
     * @return string language code
     */
    public function getCaptchaLanguage()
    {
        return Mage::getStoreConfig(self::XML_PATH_CAPTCHA_LANGUAGE);
    }

    /**
     * @return string theme code
     */
    public function getCaptchaTheme()
    {
        return Mage::getStoreConfig(self::XML_PATH_CAPTCHA_THEME);
    }

    /**
     * @return string private key
     */
    public function getCaptchaPrivateKey()
    {
        return Mage::getStoreConfig(self::XML_PATH_CAPTCHA_PRIVATE_KEY);
    }

    /**
     * @return string public key
     */
    public function getCaptchaPublicKey()
    {
        return Mage::getStoreConfig(self::XML_PATH_CAPTCHA_PUBLIC_KEY);
    }

    /**
     *  remove all items from cart
     */
    public function clearCart()
    {
        $cart =  Mage::getModel('checkout/cart')->truncate();
        $cart->save();
    }

    /**
     * @param int $magentoOrderId
     * @return string
     */
    public function getPhoneNumberByOrder($magentoOrderId)
    {
        $order = Mage::getModel('web4pro_fastorder/order')->load($magentoOrderId, 'magento_order_id');
        return $order->getId() ? $order->getPhone() : '';
    }

    /**
     * Is display phone number in Magento Sales Orders grid Order
     *
     * @return bool
     */
        public function isDisplayPhoneInSalesOrders()
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_DISPLAY_PHONE_IN_SALES_ORDERS);
    }

    /**
     * Send email address to admin
     *
     * @return bool
     */
    public function isSendEmail()
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_SEND_EMAIL);
    }

    /**
     * @return bool
     */
    public function isSendEmailToCustomer()
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_SEND_EMAIL_TO_CUSTOMER);
    }

    /**
     * get admin fast order description
     *
     * @return bool|string
     */
    public function getFastOrderDescription()
    {
        return Mage::getStoreConfig(self::XML_PATH_FAST_ORDER_DESCRIPTION);
    }

    /**
     * @return false|Mage_Core_Model_Abstract
     */
    public function getCustomerModel()
    {
        return Mage::getModel('customer/customer');
    }

    
    public function checkoutSessionQuote()
    {
        $checkoutSessionQuote = Mage::getSingleton('checkout/session')->getQuote();
        if ($checkoutSessionQuote->getIsMultiShipping()) {
            $checkoutSessionQuote->setIsMultiShipping(false);
            $checkoutSessionQuote->removeAllAddresses();
        }
    }

    public function isCartFormShow()
    {
        $quote = $this->getCart()->getQuote();
        return $this->isPriceForProductEnable($quote) ? true : false;
    }

    public function isPriceForProductEnable($quote)
    {
        return $quote->getGrandTotal() < $this->getPriceBigger();
    }
}
