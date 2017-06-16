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

class Web4pro_Fastorder_Block_FormAbstract extends Web4pro_Fastorder_Block_Abstract
{
    public function getPhoneCodeHtml($name, $class = '', $withCountryName = true, $emptyLabel = 'Code', $selectedValue = null)
    {
        $countryCallingCodeCollection = $this->getModuleHelper()->getPhonePrefixCodes();
        $callingCodes = $countryCallingCodeCollection->toOptionArray($withCountryName);
        $codesQuantity = count($callingCodes);

        if ($codesQuantity > 1) {
            $options = array_merge(
                array(array(
                    'value' => '',
                    'label' => $emptyLabel,
                )),
                $callingCodes
            );
        } elseif ($codesQuantity == 1) {
            $item = $countryCallingCodeCollection->getFirstItem();
            $countryName = Mage::app()->getLocale()->getCountryTranslation($item->getCountryCode());
            $label = "{$item->getPhoneCode()} ($countryName)";

            $options = array(array(
                'value' => $item->getCountryCode(),
                'label' => $label,
            ));
        } else {
            $countryCode = Mage::getStoreConfig('general/country/default');
            $countryName = Mage::app()->getLocale()->getCountryTranslation($countryCode);
            $phoneCode = $this->getModuleHelper()->getPhoneCodeByCountry($countryCode);
            $label = "{$phoneCode} ($countryName)";

            $options = array(array(
                'value' => $countryCode,
                'label' => $label,
            ));
        }

        $html = $this->getLayout()->createBlock('core/html_select')
            ->setName($name)
            ->setId('fastorder-phone-code')
            ->setClass($class)
            ->setValue($selectedValue)
            ->setOptions($options)
            ->getHtml();

        return $html;
    }

    public function getCaptchaHtml()
    {
        $childHtml = Mage::getSingleton('core/layout')
            ->createBlock('web4pro_fastorder/captcha_recaptcha')
            ->setData('form_id', 'fastorder-form')
            ->setData('img_width', 230)
            ->setData('img_height', 50)
            ->toHtml();
        return $childHtml;
    }

    public function getHandle()
    {
        $controller = array(
            'catalog_product_view' => 'fastorder/index/saveOrderCurrentProduct',
            'checkout_cart_index'  => 'fastorder/index/saveOrder'
        );

        $handles = $this->getLayout()->getUpdate()->getHandles();

        Mage::dispatchEvent('add_handle_in_form', array('controller' => $controller));

        foreach($controller as $key => $value)
        {
            if(array_search($key, $handles)){
                return $value;
            }
        }
    }
}