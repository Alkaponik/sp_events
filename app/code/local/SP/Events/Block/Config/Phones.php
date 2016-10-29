<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2016, Pavel Usachev
 */
class SP_Events_Block_Config_Phones
    extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{
    protected function _prepareToRender()
    {
        $this->addColumn('city_name', array(
            'label' => Mage::helper('sp_events')->__('City'),
            'style' => 'width:200px',
        ));
        $this->addColumn('phone_number', array(
            'label' => Mage::helper('sp_events')->__('Phone number'),
            'style' => 'width:200px',
        ));

        $this->addColumn('country_id', array(
            'label' => Mage::helper('sp_events')->__('Country'),
            'renderer' => $this->_getRenderer(),
        ));

        $this->_addAfter = false;
        $this->_addButtonLabel = Mage::helper('sp_events')->__('Add');
    }

    protected function  _getRenderer()
    {
        if (!$this->_itemRenderer) {
            $this->_itemRenderer = $this->getLayout()->createBlock(
                'sp_events/config_adminhtml_form_field_country', '',
                array('is_render_to_js_template' => true)
            );
        }
        return $this->_itemRenderer;
    }

    protected function _prepareArrayRow(Varien_Object $row)
    {
        $row->setData(
            'option_extra_attr_' . $this->_getRenderer()
                ->calcOptionHash($row->getData('country_id')),
            'selected="selected"'
        );
    }
}
