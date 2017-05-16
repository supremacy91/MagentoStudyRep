<?php


class MyPayment_MyCheckout_Model_Observer extends Mage_Sales_Model_Order_Creditmemo {

    public function my_payment_refund($observer) {
       /* $grandTotal = $observer->getEvent()->getCreditmemo()->getGrandTotal();

        $customerId = $observer->getEvent()->getCreditmemo()->getOrder()->getCustomerId();
        $customerEntity = Mage::getModel("customer/customer")->load($customerId);
        $customerBalance = $customerEntity->getCustomerBalance();

        $currentBalance = $grandTotal + $customerBalance;

        $customerEntity->setCustomerBalance($currentBalance)->save();

        Mage::log($currentBalance);



        return parent::refund();*/
    }
}