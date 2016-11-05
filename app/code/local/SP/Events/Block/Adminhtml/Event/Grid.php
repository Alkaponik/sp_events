<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2016, Pavel Usachev
 */

/**
 * Class SP_Events_Block_Adminhtml_Event_Grid
 */
class SP_Events_Block_Adminhtml_Event_Grid
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
        $collection = Mage::getSingleton('sp_events/event')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * @return SP_Events_Block_Adminhtml_Event_Grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'event_id',
            array(
                'header'    => Mage::helper('sp_events')->__('ID'),
                'align'     => 'right',
                'width'     => '50px',
                'index'     => 'event_id',
            )
        );

        $this->addColumn(
            'title',
            array(
                'header'    => Mage::helper('sp_events')->__('Title'),
                'align'     => 'center',
                'index'     => 'title',
            )
        );

        $this->addColumn(
            'display_from',
            array(
                'header'    => Mage::helper('sp_events')->__('Display From'),
                'align'     =>'left',
                'index'     => 'display_from',
            )
        );

        $this->addColumn(
            'display_to',
            array(
                'header'    => Mage::helper('sp_events')->__('Display To'),
                'align'     =>'left',
                'index'     => 'display_to',
            )
        );

        $this->addColumn(
            'is_active',
            array(
                'header'    => Mage::helper('sp_events')->__('Status'),
                'align'     => 'left',
                'width'     => '80px',
                'index'     => 'is_active',
                'type'      => 'options',
                'options'   => array(
                    1 =>  Mage::helper('sp_events')->__('Enabled'),
                    0 =>  Mage::helper('sp_events')->__('Disabled'),
                ),
            )
        );

        $this->addColumn(
            'action',
            array(
                'header'    =>  Mage::helper('sp_events')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('sp_events')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'event_id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'event_id',
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
        $this->getMassactionBlock()->setFormFieldName('event');

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
     * @param SP_Events_Model_Event $event
     * @return string
     */
    public function getRowUrl($event)
    {
        return $this->getUrl('*/*/edit', array(
            'event_id' => $event->getId(),
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
