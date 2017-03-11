<?php

class SP_Contacts_Model_Resource_Contacts
    extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init("sp_contacts/contacts", "contact_id");
    }
}