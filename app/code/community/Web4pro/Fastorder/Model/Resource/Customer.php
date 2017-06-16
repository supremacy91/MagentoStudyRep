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

class Web4pro_Fastorder_Model_Resource_Customer extends Mage_Customer_Model_Resource_Customer
{

    /**
     * Check customer scope, email and confirmation key before saving
     * @param Varien_Object $customer
     * @return $this
     */
    protected function _beforeSave(Varien_Object $customer)
    {
        // set confirmation key logic
        $store = Mage::app()->getStore();

        $customer->setCreatedIn($store->getName());
        if ($customer->getForceConfirmed()) {
            $customer->setConfirmation(null);
        } elseif (!$customer->getId() && $customer->isConfirmationRequired()) {
            $customer->setConfirmation($customer->getRandomConfirmationKey());
        }
        // remove customer confirmation key from database, if empty
        if (!$customer->getConfirmation()) {
            $customer->setConfirmation(null);
        }

        parent::_beforeSave($customer);

        return $this;
    }
}