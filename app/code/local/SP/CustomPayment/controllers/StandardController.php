<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class SP_CustomPayment_StandardController
    extends Mage_Core_Controller_Front_Action
{
    public function redirectAction()
    {
        /** @var SP_CustomPayment_Helper_Data $helper */
        $helper = Mage::helper('sp_custompayment');

        //@TODO find encripted method
        $merchantId = $helper->getMerchantId();

        //@TODO need redirect logic here
    }
}
