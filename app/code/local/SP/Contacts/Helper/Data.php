<?php

class SP_Contacts_Helper_Data
    extends Mage_Core_Helper_Abstract
{
    /** @var SP_Contacts_Model_Contacts  */
    protected $_model;

    public function __construct()
    {
        $this->_model = Mage::getModel('sp_contacts/contacts');
    }

    /**
     * @param array $data
     */
    public function saveItem(array $data)
    {
        $this->_model->setData($data)->save();
    }

    /**
     * @param int $itemId
     */
    public function deleteItem($itemId)
    {
        $this->_model->setId($itemId)->delete();
    }

    /**
     * @param array $itemIds
     */
    public function massDelete(array $itemIds)
    {
        foreach ($itemIds as $id) {
            $this->deleteItem($id);
        }
    }
}