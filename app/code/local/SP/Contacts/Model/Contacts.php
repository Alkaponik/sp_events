<?php

class SP_Contacts_Model_Contacts
    extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
       $this->_init("sp_contacts/contacts");
    }
}
