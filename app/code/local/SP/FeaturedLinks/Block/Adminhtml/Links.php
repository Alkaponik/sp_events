<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class SP_FeaturedLinks_Block_Adminhtml_Links
    extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * SP_Events_Block_Adminhtml_Event constructor.
     */
    public function __construct()
    {
        $this->_controller = 'adminhtml_links';
        $this->_blockGroup = 'sp_featuredlinks';
        $this->_headerText = Mage::helper('sp_events')->__('Events grid');
        $this->_addButtonLabel = Mage::helper('sp_events')->__('Add event');

        parent::__construct();
    }
}