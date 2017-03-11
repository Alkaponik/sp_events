<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2016, Pavel Usachev
 */

/**
 * Class SP_Events_Block_Adminhtml_Event_Edit_Tabs_Image
 */
class SP_FeaturedLinks_Block_Adminhtml_Links_Edit_Tabs_Image
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
            'links_image',
            array(
                'legend' => Mage::helper('sp_featuredlinks')->__('Image')
            )
        );

//        $fieldset->addType('event_image', 'SP_Events_Block_Adminhtml_Renderer_Form_Image');

        $fieldset->addField(
            'image',
            'image',
            [
                'label' => Mage::helper('sp_featuredlinks')->__('Image'),
                'required' => true,
                'name' => 'image',
            ]
        );

        if (Mage::getSingleton('adminhtml/session')->getData('links_data')) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getData('links_data'));
            Mage::getSingleton('adminhtml/session')->setData('links_data', null);
        } elseif (Mage::registry('links_data')) {
            $form->setValues(Mage::registry('links_data')->getData());
        }

        return parent::_prepareForm();
    }
}
