<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class SP_Adminhtml_ContactsController
    extends Mage_Adminhtml_Controller_Action
{
    /** @var  SP_Contacts_Helper_Data */
    protected $_helper;

    public function _construct()
    {
        $this->_helper = Mage::helper('sp_contacts');
    }

    /**
     * Render grid data for events
     */
    public function indexAction()
    {
        $this->_title($this->__('Contacts'));

        $this->loadLayout();
        $this->_setActiveMenu('sp_contacts');
        $this->_addBreadcrumb(
            Mage::helper('sp_contacts')->__('Contacts'),
            Mage::helper('sp_contacts')->__('Contacts')
        );

        $this->renderLayout();
    }

    /**
     * Render form for new item
     */
    public function newAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    /**
     * Render form for edit item
     */
    public function editAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function deleteAction()
    {
        $itemId = $this->getRequest()->getParam('contact_id', false);

        try {
            $this->_helper->deleteItem($itemId);

            Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('sp_events')->__('Item successfully deleted')
            );

            return $this->_redirect('*/*/');
        } catch (Mage_Core_Exception $e){
            Mage::getSingleton('adminhtml/session')->addError(
                $this->__("Item %d hasn't deleted", $itemId)
            );
            Mage::logException($e);

            return  $this->_redirectReferer();
        }
    }

    public function massDeleteAction()
    {
        $ids = $this->getRequest()->getParam('link_ids');
        if(!is_array($ids)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('sp_featuredlinks')->__('Please select link(s).'));
        } else {
            try {
                $this->_helper->massDelete($ids);
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('sp_featuredlinks')->__(
                        'Total of %d record(s) were deleted.', count($ids)
                    )
                );
            } catch (Exception $e) {
                Mage::logException($e);
                Mage::getSingleton('adminhtml/session')->addError("Error");
            }
        }

        $this->_redirect('*/*/');
    }

    public function saveAction()
    {
        $data = $this->getRequest()->getPost();
        if (!empty($data)) {
            try{
                $this->_helper->saveItem($data);
            } catch (Mage_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    $this->__('Item hasn\'t saved')
                );
                Mage::getSingleton('adminhtml/session')->setData('contacts_data', $data);
                Mage::logException($e);

                return $this->_redirect('*/*/edit');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    $e->getMessage()
                );
                Mage::getSingleton('adminhtml/session')->setData('contacts_data', $data);

                return $this->_redirect('*/*/edit');
            }
        }
        return $this->_redirect('*/*/');
    }
}
