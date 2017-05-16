<?php

class MyPayment_MyCheckout_Model_Mypayment extends Mage_Payment_Model_Method_Abstract {

    protected $_code = 'my_payment';
    protected $_canOrder = true;
    protected $_canCapture = true;
    protected $_canRefund                   = true;
    protected $_canRefundInvoicePartial     = true;
    public function isAvailable($quote = null)
    {
        if($quote->getCustomer()->getCustomerBalance() < $quote->getGrandTotal()) {
            return false;
        }
        return parent::isAvailable($quote);
    }

    public function processInvoice($invoice, $payment)
    {
        $payment->setLastTransId(time());

        $grandTotal = $invoice->getGrandTotal();
        $balance = $invoice->getOrder()->getCustomer()->getCustomerBalance();

        if($grandTotal > $balance) {
            Mage::throwException("Not enough balance");
        } else {
            $result = $balance - $grandTotal;
            $invoice->getOrder()->getCustomer()->setCustomerBalance($result)->save();
        }
        //Mage::register("customerBalance", $result);
       // Mage::log("balance: " . $result);
        parent::processInvoice($invoice, $payment);

    }

    public function refund($payment, $amount)
    {
        $grandTotal = $payment->getOrder()->getGrandTotal();

        $customerId = $payment->getOrder()->getCustomerId();
        $customerEntity = Mage::getModel("customer/customer")->load($customerId);
        $customerBalance = $customerEntity->getCustomerBalance();

        $currentBalance = $amount + $customerBalance;

        $customerEntity->setCustomerBalance($currentBalance)->save();

     //   Mage::log($currentBalance);

        return parent::refund($payment, $amount);
    }





}
