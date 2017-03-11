<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class SP_Contacts_Model_Source_Status
{
    const STATUS_PENDING     = 1;
    const STATUS_COMPLETE    = 2;
    const STATUS_ON_HOLD     = 3;
    const STATUS_NOT_RESPOND = 0;

    /** @var SP_Contacts_Helper_Data */
    protected $_helper;

    public function __construct()
    {
        $this->_helper = Mage::helper('sp_contacts');
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            [
                'label' => $this->_helper->__('Pending'),
                'value' => self::STATUS_PENDING
            ],
            [
                'label' => $this->_helper->__('Complete'),
                'value' => self::STATUS_COMPLETE
            ],
            [
                'label' => $this->_helper->__('On Hold'),
                'value' => self::STATUS_ON_HOLD
            ],
            [
                'label' => $this->_helper->__('Not Respond'),
                'value' => self::STATUS_NOT_RESPOND
            ]
        ];
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            self::STATUS_PENDING        => $this->_helper->__('Pending'),
            self::STATUS_COMPLETE       => $this->_helper->__('Complete'),
            self::STATUS_ON_HOLD        => $this->_helper->__('On Hold'),
            self::STATUS_NOT_RESPOND    => $this->_helper->__('Not Respond')
        ];
    }
}