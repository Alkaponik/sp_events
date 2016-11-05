<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2016, Pavel Usachev
 */

/**
 * Class SP_Events_Block_Adminhtml_Event_Edit_Tabs
 */
class SP_Events_Block_Adminhtml_Event_Edit_Tabs
    extends Mage_Adminhtml_Block_Widget_Tabs
{
    /**
     * SP_Events_Block_Adminhtml_Event_Edit_Tabs constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setId('event_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('sp_events')->__('Event Information'));
    }

    /**
     * @return Mage_Core_Block_Abstract
     * @throws Exception
     */
    protected function _beforeToHtml()
    {
        $this->addTab('general',
            [
                'label'     => Mage::helper('sp_events')->__('General'),
                'title'     => Mage::helper('sp_events')->__('General'),
                'content'   => $this->getLayout()->createBlock('sp_events/adminhtml_event_edit_tabs_general')->toHtml(),
            ]
        );

        $this->addTab('image',
            [
                'label'     => Mage::helper('sp_events')->__('Image'),
                'title'     => Mage::helper('sp_events')->__('Image'),
                'content'   => $this->getLayout()->createBlock('sp_events/adminhtml_event_edit_tabs_image')->toHtml(),
            ]
        );

        return parent::_beforeToHtml();
    }
}
