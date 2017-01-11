<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2016, Pavel Usachev
 */
class SP_CustomProduct_Model_Carrier
    extends Mage_Shipping_Model_Carrier_Abstract
    implements Mage_Shipping_Model_Carrier_Interface
{
    protected $_code = 'sp_shipping';

    /**
     * @var SP_CustomShipping_Helper_Data
     */
    protected $_helper;

    /**
     * @var bool
     */
    protected $_expressAvailable = true;

    protected function _construct()
    {
        $this->_helper = Mage::helper('sp_customshipping');
    }

    /**
     * @param Mage_Shipping_Model_Rate_Request $request
     * @return Mage_Shipping_Model_Rate_Result
     */
    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        /** @var Mage_Shipping_Model_Rate_Result $result */
        $result = Mage::getModel('shipping/rate_result');

        $expressMaxWeight = $this->_helper->getExpressMaxWeight();

        foreach ($request->getAllItems() as $item) {
            if ($item->getWeight > $expressMaxWeight) {
                $this->_expressAvailable = false;
                break;
            }
        }

        if ($this->_expressAvailable) {
            $result->append($this->_getExpressRate());
        }
        $result->append($this->_getStandardRate());

        return $result;
    }

    /**
     * @return Mage_Shipping_Model_Rate_Result_Method
     */
    protected function _getStandardRate()
    {
        /** @var Mage_Shipping_Model_Rate_Result_Method $rate */
        $rate = Mage::getModel('shipping/rate_result_method');

        $rate->setCarrier($this->_code);
        $rate->setCarrierTitle($this->getConfigData('title'));
        $rate->setMethod('large');
        /** @TODO get method title from system config */
        $rate->setMethodTitle('Standart delivery');
        /** @TODO get price from system config */
        $rate->setPrice(1.5);
        $rate->setCost(0);

        return $rate;
    }

    /**
     * @return Mage_Shipping_Model_Rate_Result_Method
     */
    protected function _getExpressRate()
    {
        /** @var Mage_Shipping_Model_Rate_Result_Method $rate */
        $rate = Mage::getModel('shipping/rate_result_method');

        $rate->setCarrier($this->_code);
        $rate->setCarrierTitle($this->getConfigData('title'));
        $rate->setMethod('large');
        /** @TODO get method title from system config */
        $rate->setMethodTitle('Express delivery');
        /** @TODO get price from system config */
        $rate->setPrice(10);
        $rate->setCost(0);

        return $rate;
    }

    /**
     * @return string[]
     */
    public function getAllowedMethods()
    {
        return array(
            'standard'    =>  'Standard delivery',
            'express'     =>  'Express delivery',
        );
    }
}
