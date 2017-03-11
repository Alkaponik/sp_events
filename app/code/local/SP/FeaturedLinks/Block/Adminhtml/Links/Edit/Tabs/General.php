<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2016, Pavel Usachev
 */

class SP_FeaturedLinks_Block_Adminhtml_Links_Edit_Tabs_General
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
            'links_form',
            array(
                'legend' => Mage::helper('sp_events')->__('Event information')
            )
        );

        $model = Mage::registry('links_data');

        if ($model && $model->getId()) {
            $fieldset->addField(
                'link_id',
                'hidden',
                [
                    'name'      => 'link_id',
                    'required'  => true
                ]
            );
        }

        $fieldset->addField(
            'title',
            'text',
            [
                'label' => Mage::helper('sp_featuredlinks')->__('Title'),
                'required' => true,
                'name' => 'title',
            ]
        );

        $fieldset->addField(
            'link',
            'text',
            [
                'label' => Mage::helper('sp_featuredlinks')->__('Link'),
                'required' => true,
                'name' => 'link',
            ]
        );

        $fieldset->addField(
            'display_from',
            'date',
            [
                'name'               => 'display_from',
                'label'              => Mage::helper('sp_featuredlinks')->__('Date From'),
                'tabindex'           => 1,
                'image'              => $this->getSkinUrl('images/grid-cal.gif'),
                'format'             => Mage::app()->getLocale()
                                                   ->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT)
            ]
        );

        $fieldset->addField(
            'display_to',
            'date',
            [
                'name'               => 'display_to',
                'label'              => Mage::helper('sp_featuredlinks')->__('Date To'),
                'tabindex'           => 1,
                'image'              => $this->getSkinUrl('images/grid-cal.gif'),
                'format'             => Mage::app()->getLocale()
                    ->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT)
            ]
        );

        $fieldset->addField(
            'short_description',
            'textarea',
            [
                'name'               => 'short_description',
                'label'              => Mage::helper('sp_featuredlinks')->__('Short Description'),
            ]
        );

        $fieldset->addField(
            'is_active',
            'select',
            array(
                'label' => Mage::helper('sp_events')->__('Status'),
                'name' => 'is_active',
                'values' => array(
                    [
                        'value' => 1,
                        'label' => Mage::helper('sp_events')->__('Enabled'),
                    ],
                    [
                        'value' => 0,
                        'label' => Mage::helper('sp_events')->__('Disabled'),
                    ],
                ),
            )
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
