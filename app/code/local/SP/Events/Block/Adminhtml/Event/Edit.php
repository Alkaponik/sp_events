<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2016, Pavel Usachev
 */

/**
 * Class SP_Events_Block_Adminhtml_Event_Edit
 */
class SP_Events_Block_Adminhtml_Event_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * SP_Events_Block_Adminhtml_Event_Edit constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->_objectId    = 'event_id';
        $this->_blockGroup  = 'sp_events';
        $this->_controller  = 'adminhtml_event';
        $this->_mode        = 'edit';

        $eventId = (int)$this->getRequest()->getParam($this->_objectId);

        if (!empty($eventId)) {
            $this->_addButton('delete', array(
                'label'     => Mage::helper('adminhtml')->__('Delete'),
                'class'     => 'delete',
                'onclick'   => 'deleteConfirm(\''. Mage::helper('adminhtml')->__('Are you sure you want to do this?')
                    .'\', \'' . $this->getDeleteUrl() . '\')',
            ));
        }

        $event = Mage::getModel('sp_events/event')->load($eventId);
        Mage::register('event_data', $event);
    }

    /**
     * @return string
     */
    public function getHeaderText()
    {
        if( Mage::registry('event_data') && Mage::registry('event_data')->getId() ) {
            return Mage::helper('sp_events')->__(
                "Edit event '%s'",
                $this->escapeHtml(Mage::registry('event_data')->getTitle())
            );
        } else {
            return Mage::helper('sp_events')->__('Add event');
        }
    }
}
