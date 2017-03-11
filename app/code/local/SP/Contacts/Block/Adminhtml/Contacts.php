<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class SP_Contacts_Block_Adminhtml_Contacts
    extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_contacts';
        $this->_blockGroup = 'sp_contacts';
        $this->_headerText = Mage::helper('sp_contacts')->__('Contacts grid');
        $this->_addButtonLabel = Mage::helper('sp_contacts')->__('Add data');

        parent::__construct();
    }
}
