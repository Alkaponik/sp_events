<?php

class SP_Contacts_Model_Resource_Contacts_Collection
    extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    public function _construct()
    {
        $this->_init("sp_contacts/contacts");
    }
}