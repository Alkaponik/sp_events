<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class SP_FeaturedLinks_Adminhtml_FeaturedlinksController
    extends Mage_Adminhtml_Controller_Action
{
    /**
     * Render grid data for events
     */
    public function indexAction()
    {
        $this->_title($this->__('Featured Links'));

        $this->loadLayout();
        $this->_setActiveMenu('sp_featuredlinks');
        $this->_addBreadcrumb(
            Mage::helper('sp_featuredlinks')->__('Featured Links'),
            Mage::helper('sp_featuredlinks')->__('Featured Links')
        );

        $this->renderLayout();
    }

    /**
     * Render grid data for events
     */
    public function newAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    /**
     * Render grid data for events
     */
    public function editAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function deleteAction()
    {
        $itemId = $this->getRequest()->getParam('link_id', false);

        try {
            $model = Mage::getModel('sp_featuredlinks/featuredlinks')
                            ->load($itemId);

            $model->delete();

            Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('sp_events')->__('Link successfully deleted')
            );

            return $this->_redirect('*/*/');
        } catch (Mage_Core_Exception $e){
            Mage::getSingleton('adminhtml/session')->addError(
                $this->__("Link %d hasn't deleted", $itemId)
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

    public function massDeleteAction()
    {
        $ids = $this->getRequest()->getParam('link_ids');
        if(!is_array($ids)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('sp_featuredlinks')->__('Please select link(s).'));
        } else {
            try {
                $model = Mage::getModel('sp_featuredlinks/featuredlinks');
                foreach ($ids as $id) {
                    $item = $model->setId($id);
                    $item->delete();
                }
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
                Mage::helper('sp_featuredlinks')->savePostData($data);
            } catch (Mage_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    $this->__('Link hasn\'t saved')
                );
                Mage::getSingleton('adminhtml/session')->setData('links_data', $data);
                Mage::logException($e);
                return $this->_redirect('*/*/edit');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    $e->getMessage()
                );
                Mage::getSingleton('adminhtml/session')->setData('links_data', $data);
                return $this->_redirect('*/*/edit');
            }
        }
        return $this->_redirect('*/*/');
    }
}
