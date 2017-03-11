<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2016, Pavel Usachev
 */

/**
 * Class SP_Events_Block_Adminhtml_Event_Edit
 */
class SP_FeaturedLinks_Block_Adminhtml_Links_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * SP_Events_Block_Adminhtml_Event_Edit constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->_objectId    = 'link_id';
        $this->_blockGroup  = 'sp_featuredlinks';
        $this->_controller  = 'adminhtml_links';
        $this->_mode        = 'edit';

        $linksId = (int)$this->getRequest()->getParam($this->_objectId);

        if (!empty($linksId)) {
            $this->_addButton('delete', array(
                'label'     => Mage::helper('adminhtml')->__('Delete'),
                'class'     => 'delete',
                'onclick'   => 'deleteConfirm(\''. Mage::helper('adminhtml')->__('Are you sure you want to do this?')
                    .'\', \'' . $this->getDeleteUrl() . '\')',
            ));
        }

        $model = Mage::getModel('sp_featuredlinks/featuredlinks')->load($linksId);
        Mage::register('links_data', $model);
    }

    /**
     * @return string
     */
    public function getHeaderText()
    {
        if( Mage::registry('links_data') && Mage::registry('links_data')->getId() ) {
            return Mage::helper('sp_featuredlinks')->__(
                "Edit link '%s'",
                $this->escapeHtml(Mage::registry('links_data')->getTitle())
            );
        } else {
            return Mage::helper('sp_featuredlinks')->__('Add links');
        }
    }
}
