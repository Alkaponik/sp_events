<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2016, Pavel Usachev
 */

/**
 * Class SP_Events_Block_Adminhtml_Event
 */
class SP_Events_Block_Adminhtml_Event
    extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * SP_Events_Block_Adminhtml_Event constructor.
     */
    public function __construct()
    {
        $this->_controller = 'adminhtml_event';
        $this->_blockGroup = 'sp_events';
        $this->_headerText = Mage::helper('sp_events')->__('Events grid');
        $this->_addButtonLabel = Mage::helper('sp_events')->__('Add event');

        parent::__construct();
    }
}
