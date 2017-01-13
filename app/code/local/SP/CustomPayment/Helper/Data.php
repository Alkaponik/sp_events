<?php

class SP_CustomPayment_Helper_Data extends Mage_Core_Helper_Abstract
{
    const MERCHANT_ID_SYSTEM_CONFIG_NODE = 'payment/sp_custompayment/merchant_id';

    /**
     * @return mixed
     */
    public function getMerchantId()
    {
        return Mage::getStoreConfig(self::MERCHANT_ID_SYSTEM_CONFIG_NODE);
    }

    /**
     * @return string
     */
    public function getPaymentGatewayUrl()
    {
        return Mage::getUrl('custompayment/payment/gateway', ['secure' => false]);
    }
}