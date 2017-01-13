<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class SP_CustomPayment_Block_Info_Custompaymentmethod
    extends Mage_Payment_Block_Info
{
    /**
     * @var array
     */
    protected $_fieldMapping = [];

    /**
     *{@inheritdoc}
     */
    protected function _prepareSpecificInformation($transport = null)
    {
        $this->_fieldMapping = [
            'custom_field_one' => Mage::helper('sp_custompayment')->__('Custom field one'),
            'custom_field_two' => Mage::helper('sp_custompayment')->__('Custom field two'),
        ];

        if (null !== $this->_paymentSpecificInformation) {

            return $this->_paymentSpecificInformation;
        }

        $data = [];

        foreach ($this->_fieldMapping as $fieldName => $fieldLabel) {
            if ($value = $this->getInfo()->getData($fieldName)) {
                $data[$fieldLabel] = $value;
            }
        }

        $transport = parent::_prepareSpecificInformation($transport);

        return $transport->setData(array_merge($data, $transport->getData()));
    }
}
