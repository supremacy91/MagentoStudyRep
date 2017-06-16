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

class Web4pro_Fastorder_Helper_Captcha extends Mage_Captcha_Helper_Data
{
    /**
     * The API server address
     */
    const RECAPTCHA_API_SERVER = "https://www.google.com";
    const RECAPTCHA_API_PATH = "/recaptcha/api";
    const RECAPTCHA_VERIFY_SERVER = "www.google.com";
    const RECAPTCHA_VERIFY_PATH = "verify";
    const RECAPTCHA_SITEVERIFY_PATH = "siteverify";

    /**
     * Get Captcha
     *
     * @param string $formId
     * @return Mage_Captcha_Model_Interface
     */
    public function getCaptcha($formId)
    {
        if (!array_key_exists($formId, $this->_captcha)) {
            $this->_captcha[$formId] = Mage::getModel('web4pro_fastorder/captcha', array('formId' => $formId));
        }
        return $this->_captcha[$formId];
    }

}