<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class SP_CustomPayment_Block_Form_Custompaymentmethod
    extends Mage_Payment_Block_Form
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('sp/custompayment/form/custompaymentmethod.phtml');
    }
}
