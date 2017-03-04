<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class SP_FeaturedLinks_Block_Adminhtml_Links_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * SP_Events_Block_Adminhtml_Event_Grid constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('eventGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    /**
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getSingleton('sp_featuredlinks/featuredlinks')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * @return SP_Events_Block_Adminhtml_Event_Grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'link_id',
            array(
                'header'    => Mage::helper('sp_featuredlinks')->__('ID'),
                'align'     => 'right',
                'width'     => '50px',
                'index'     => 'link_id',
            )
        );

        $this->addColumn(
            'title',
            array(
                'header'    => Mage::helper('sp_featuredlinks')->__('Title'),
                'align'     => 'center',
                'index'     => 'title',
            )
        );

        $this->addColumn(
            'link',
            array(
                'header'    => Mage::helper('sp_featuredlinks')->__('Link'),
                'align'     =>'left',
                'index'     => 'display_from',
            )
        );

        $this->addColumn(
            'is_active',
            array(
                'header'    => Mage::helper('sp_featuredlinks')->__('Status'),
                'align'     => 'left',
                'width'     => '80px',
                'index'     => 'is_active',
                'type'      => 'options',
                'options'   => array(
                    1 =>  Mage::helper('sp_featuredlinks')->__('Enabled'),
                    0 =>  Mage::helper('sp_featuredlinks')->__('Disabled'),
                ),
            )
        );

        $this->addColumn(
            'action',
            array(
                'header'    =>  Mage::helper('sp_featuredlinks')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('sp_events')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'link_id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'is_system' => true,
            )
        );

        return parent::_prepareColumns();
    }

    /**
     * @return MageKeeper_Slider_Block_Adminhtml_Slider_Grid
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('event_id');
        $this->getMassactionBlock()->setFormFieldName('event_ids');

        $this->getMassactionBlock()
            ->addItem(
                'delete',
                array(
                    'label'    => Mage::helper('sp_events')->__('Delete'),
                    'url'      => $this->getUrl('*/*/massDelete'),
                    'confirm'  => Mage::helper('sp_events')->__('Are you sure?')
                )
            );

        return $this;
    }

    /**
     * @param SP_FeaturedLinks_Model_Featuredlinks $item
     * @return string
     */
    public function getRowUrl($item)
    {
        return $this->getUrl('*/*/edit', array(
            'link_id' => $item->getId(),
        ));
    }

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }
}
