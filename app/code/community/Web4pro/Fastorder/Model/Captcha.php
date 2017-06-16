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

class Web4pro_Fastorder_Model_Captcha
    extends Mage_Captcha_Model_Zend
    implements Mage_Captcha_Model_Interface
{
    /**
     * Key in session for captcha code
     */
    const SESSION_WORD = 'word';

    /**
     * Helper Instance
     *
     * @var Mage_Captcha_Helper_Data
     */
    protected $_helper = null;

    /**
     * Captcha form id
     *
     * @var string
     */
    protected $_formId;
    protected $_language = 'en';
    protected $_theme = 'clean';
    protected $_private_key = null;
    protected $_public_key = null;


    /**
     * Get Block Name
     *
     * @return string
     */
    public function getBlockName()
    {
        return 'web4pro_fastorder/captcha_recaptcha';
    }

    /**
     * Returns captcha helper
     *
     * @return Web4pro_Fastorder_Helper_Data
     */
    protected function _getHelper()
    {
        if (empty($this->_helper)) {
            $this->_helper = Mage::helper('web4pro_fastorder/captcha');
        }

        return $this->_helper;
    }

    /**
     * Whether captcha is enabled at this area
     *
     * @return bool
     */
    public function isEnabled()
    {
        return (bool)Mage::helper('web4pro_fastorder')->isCaptchaEnabled();
    }

    /**
     * Returns number of allowed attempts for same login
     *
     * @return int
     */
    protected function _getAllowedAttemptsForSameLogin()
    {
        return 0; //always
    }

    /**
     * Returns number of allowed attempts from same IP
     *
     * @return int
     */
    protected function _getAllowedAttemptsFromSameIp()
    {
        return 0; // always
    }

    /**
     * Whether to show captcha for this form every time
     *
     * @return bool
     */
    protected function _isShowAlways()
    {
        // setting the allowed attempts to 0 is like setting mode to always
        if ($this->_getAllowedAttemptsForSameLogin() == 0 || $this->_getAllowedAttemptsFromSameIp() == 0) {
            return true;
        }

        return false;
    }

    /**
     * Generate configuration for captcha
     */
    public function generate()
    {

        $this->_language = Mage::helper('web4pro_fastorder')-> getCaptchaLanguage();

        $this->_theme = Mage::helper('web4pro_fastorder')->getCaptchaTheme();

        $this->_private_key = Mage::helper('web4pro_fastorder')->getCaptchaPrivateKey();

        $this->_public_key = Mage::helper('web4pro_fastorder')->getCaptchaPublicKey();
    }

    /**
     * Return language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->_language;
    }

    /**
     * Return theme name
     *
     * @return string
     */
    public function getTheme()
    {
        return $this->_theme;
    }

    /**
     * Return API private key
     *
     * @return string
     */
    public function getPrivateKey()
    {
        return $this->_private_key;
    }

    /**
     * Return API public key
     *
     * @return string
     */
    public function getPublicKey()
    {
        return $this->_public_key;
    }

    /**
     * Check if data is correct
     *
     * @param string $word
     * @return bool
     */
    public function isCorrect($word)
    {
        try {
            $request = Mage::app()->getFrontController()->getRequest();
            $this->generate();
            if ($response = $request->getParam('g-recaptcha-response')) {
                $path = Web4pro_Fastorder_Helper_Captcha::RECAPTCHA_SITEVERIFY_PATH;
                $params = array(
                    'secret'   => $this->_private_key,
                    'response' => $response
                );

                $result = $this->_sendRequest($path, $params);
                $response = json_decode($result);

                if (is_object($response) && $response->success == true) {
                    return true;
                }
            } else {
                $params = array(
                    'privatekey' => $this->_private_key,
                    'challenge'  => $request->getParam('recaptcha_challenge_field'),
                    'response'   => $request->getParam('recaptcha_response_field'),
                );

                $path = Web4pro_Fastorder_Helper_Captcha::RECAPTCHA_VERIFY_PATH;
                $result = $this->_sendRequest($path, $params);
                $answers = explode("\n", $result);

                if (is_array($answers) && array_key_exists('0', $answers)) {
                    return (trim($answers[0]) == 'true') ? true : false;
                }
            }
        } catch (Exception $e) {
            Mage::logException($e);
        }

        return false;
    }

    /**
     * Get API challenge url
     *
     * @return string
     */
    public function getUrl()
    {
        $url =  Web4pro_Fastorder_Helper_Captcha::RECAPTCHA_API_SERVER.
                Web4pro_Fastorder_Helper_Captcha::RECAPTCHA_API_PATH.
                '/challenge?k=' . $this->_public_key;

        return $url;
    }

    /**
     * Send request
     *
     * @param $path
     * @param $params
     * @return string
     * @throws Mage_Core_Exception
     * @throws Zend_Http_Client_Exception
     */
    private function _sendRequest($path, $params)
    {
        $uri = Web4pro_Fastorder_Helper_Captcha::RECAPTCHA_API_SERVER.'/'.
               Web4pro_Fastorder_Helper_Captcha::RECAPTCHA_API_PATH.'/'.
               $path;

        $httpRequest = new Zend_Http_Client($uri);
        $httpRequest->setParameterPost(array_merge(array('remoteip' => $_SERVER['REMOTE_ADDR']), $params));
        $response = $httpRequest->request('POST');

        if ($response->getStatus() != 200) {
            $message = Mage::helper('web4pro_fastorder')->__('Google gateway has rejected request. Status: %s',
                $response->getStatus()
            );
            Mage::throwException($message);
        }

        return $response->getBody();
    }

    /**
     * Overlap of the parent method
     *
     * Now deleting old captcha images make crontab script
     * @see Mage_Captcha_Model_Observer::deleteExpiredImages
     */
    protected function _gc()
    {
        //do nothing
    }
}