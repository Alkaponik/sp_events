<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2016, Pavel Usachev
 */

/**
 * Class SP_Events_Adminhtml_EventsController
 */
class SP_Events_Adminhtml_EventController
    extends Mage_Adminhtml_Controller_Action
{
    /**
     * Render grid data for events
     */
    public function indexAction()
    {
        $this->_title($this->__('Events'));

        $this->loadLayout();
        $this->_setActiveMenu('events');
        $this->_addBreadcrumb(
            Mage::helper('sp_events')->__('Events'),
            Mage::helper('sp_events')->__('Events')
        );

        $this->renderLayout();
    }

    /**
     * Render event form
     */
    public function newAction()
    {
        $this->_title($this->__('Add new event'));
        $this->loadLayout();
        $this->_setActiveMenu('events');
        $this->_addBreadcrumb(
            Mage::helper('sp_events')->__('Add new event'),
            Mage::helper('sp_events')->__('Add new event')
        );
        $this->renderLayout();
    }

    /**
     * Render events form with edit data
     */
    public function editAction()
    {
        $this->_title($this->__('Edit event'));

        $this->loadLayout();
        $this->_setActiveMenu('event');
        $this->_addBreadcrumb(
            Mage::helper('sp_events')->__('Edit event'),
            Mage::helper('sp_events')->__('Edit event')
        );
        $this->renderLayout();
    }

    /**
     * @return MageKeeper_Slider_Adminhtml_SliderController
     */
    public function deleteAction()
    {
        $itemId = $this->getRequest()->getParam('event_id', false);

        try {
            Mage::getModel('sp_events/event')
                ->setId($itemId)
                ->delete();

            Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('sp_events')->__('Event successfully deleted')
            );

            return $this->_redirect('*/*/');
        } catch (Mage_Core_Exception $e){
            Mage::getSingleton('adminhtml/session')->addError(
                $this->__("Event %d hasn't deleted", $itemId)
            );
            Mage::logException($e);
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError(
                $this->__('Somethings went wrong')
            );
            Mage::logException($e);
        }

        $this->_redirectReferer();
    }

    public function saveAction()
    {
        $data = $this->getRequest()->getPost();
        if (!empty($data)) {
            try{
                Mage::helper('sp_events')->savePostData($data);
            } catch (Mage_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    $this->__('Event hasn\'t saved')
                );
                Mage::getSingleton('adminhtml/session')->setData('event_data', $data);
                Mage::logException($e);
                return $this->_redirect('*/*/edit');
            }
        }
        return $this->_redirect('*/*/');
    }
}
