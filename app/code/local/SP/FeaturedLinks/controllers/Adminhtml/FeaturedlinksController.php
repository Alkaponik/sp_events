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
}
