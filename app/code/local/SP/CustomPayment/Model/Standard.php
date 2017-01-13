<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class SP_CustomPayment_Model_Standard
    extends Mage_Payment_Model_Method_Abstract
{
    /**
     *{@inherit}
     */
    protected $_code = 'sp_custompayment';

    /**
     *{@inherit}
     */
    protected $_isInitializeNeeded      = true;

    /**
     *{@inherit}
     */
    protected $_canUseInternal          = false;

    /**
     *{@inherit}
     */
    protected $_canUseForMultishipping  = false;

    /**
     *{@inherit}
     */
    protected $_formBlockType           = 'sp_custompayment/form_custompaymentmethod';

    /**
     *{@inherit}
     */
    protected $_infoBlockType           = 'sp_custompayment/info_custompaymentmethod';

    /**
     * @var array
     */
    protected $_validateMapping = [];

    /**
     * Set custom fields if exists
     *
     *{@inheritdoc}
     */
    public function assignData($data)
    {
        $info = $this->getInfoInstance();

        (!$data->getData('custom_field_one')) ?: $info->setData('custom_field_one', $data->getData('custom_field_one'));
        (!$data->getData('custom_field_two')) ?: $info->setData('custom_field_two', $data->getData('custom_field_two'));

        return $this;
    }

    /**
     *{@inheritdoc}
     */
    public function validate()
    {
        parent::validate();

        $this->_validateMapping = [
            'custom_field_one' => 'invalid_data '.$this->_getHelper()->__('Custom field one is required field'),
            'custom_field_two' => 'invalid_data '.$this->_getHelper()->__('Custom field two is required field'),
        ];

        $info = $this->getInfoInstance();

        foreach ($this->_validateMapping as $field => $errMessage) {
            if (!$info->hasData($field)) {
                continue;
            }
            (int)$info->getData($field) ?: Mage::throwException($errMessage);
        }

        return $this;
    }

    /**
     * Return Order place redirect url
     *
     * @return string
     */
    public function getOrderPlaceRedirectUrl()
    {
        // when you click on place order you will be redirected on this url
        return Mage::getUrl('custompayment/payment/redirect', ['_secure' => false]);
}
}
