<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2016, Pavel Usachev
 */

/**
 * Class SP_Events_Block_Adminhtml_Event_Edit_Tabs_Image
 */
class SP_Events_Block_Adminhtml_Event_Edit_Tabs_Image
    extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset(
            'event_form_image',
            array(
                'legend' => Mage::helper('sp_events')->__('Image')
            )
        );

        $fieldset->addType('event_image', 'SP_Events_Block_Adminhtml_Renderer_Form_Image');

        $fieldset->addField(
            'image',
            'event_image',
            [
                'label' => Mage::helper('sp_events')->__('Image'),
                'required' => true,
                'name' => 'image',
            ]
        );

        if (Mage::getSingleton('adminhtml/session')->getData('event_data')) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getData('event_data'));
            Mage::getSingleton('adminhtml/session')->setData('event_data', null);
        } elseif (Mage::registry('event_data')) {
            $form->setValues(Mage::registry('event_data')->getData());
        }

        return parent::_prepareForm();
    }
}
