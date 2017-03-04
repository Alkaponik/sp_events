<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class SP_CustomPayment_PaymentController
    extends Mage_Core_Controller_Front_Action
{
    public function gatewayAction()
    {
        if ($orderId = $this->getRequest()->get('orderId')) {
            $queryString = [
                'flag' => $this->getRequest()->has('error') ? (int)$this->getRequest()->get('error') : 1,
                'orderId' => $orderId
            ];

            Mage_Core_Controller_Varien_Action::_redirect('custompayment/payment/response', [
                'secure' => false,
                '_query' => $queryString
            ]);
        }
    }

    public function redirectAction()
    {
        $this->loadLayout();
        $block = $this->getLayout()->createBlock('core/template', 'custompaymentmathod', [
            'template' => 'sp/custompayment/redirect.phtml'
        ]);
        $this->getLayout()->getBlock('content')->append($block);
        $this->renderLayout();
    }

    public function responseAction()
    {
        /** @var Mage_Core_Controller_Request_Http $request */
        $request = $this->getRequest();

        if (!$request->get('flag') || !$request->get('orderId')) {
            Mage_Core_Controller_Varien_Action::_redirect('checkout/onepage/failure', [
                'secure' => false
            ]);
        }

        $orderId = $request->get('orderId');
        $order = Mage::getModel('sales/order')->loadByIncrementId($orderId);
        $order->setState(Mage_Sales_Model_Order::STATE_PAYMENT_REVIEW, true, 'Payment success');
        $order->save();

        Mage::getSingleton('checkout/session')->unsQuoteId();
        Mage_Core_Controller_Varien_Action::_redirect('checkout/onepage/success', [
            'secure' => false
        ]);
    }
}
