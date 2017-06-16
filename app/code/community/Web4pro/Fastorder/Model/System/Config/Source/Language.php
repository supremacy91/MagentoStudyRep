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

class Web4pro_Fastorder_Model_System_Config_Source_Language
{
    protected $_options;

    public function toOptionArray()
    {
        if (!$this->_options) {
            $this->_options = array(
                array('value' => 'en', 'label' => 'English'),
                array('value' => 'fr', 'label' => 'French'),
                array('value' => 'de', 'label' => 'German'),
                array('value' => 'nl', 'label' => 'Dutch'),
                array('value' => 'pt', 'label' => 'Portuguese'),
                array('value' => 'ru', 'label' => 'Russian'),
                array('value' => 'es', 'label' => 'Spanish'),
                array('value' => 'tr', 'label' => 'Turkish'),
            );
        }
        return $this->_options;
    }
}