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

class Web4pro_Fastorder_Model_System_Config_Source_Themes
{
    protected $_options;

    public function toOptionArray()
    {
        if (!$this->_options) {
            $this->_options = array(
                array('value' => 'clean', 'label' => 'Clean'),
                array('value' => 'white', 'label' => 'White'),
                array('value' => 'red', 'label' => 'Red'),
                array('value' => 'blackglass', 'label' => 'Blackglass'),
                array('value' => 'local', 'label' => 'Local'),
                array('value' => 'New', 'label' => 'I am not a Robot')
            );
        }
        return $this->_options;
    }
}