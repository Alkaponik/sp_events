<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2016, Pavel Usachev
 */

class SP_Events_Block_Adminhtml_Event_Edit_Tabs_General
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
            'event_form',
            array(
                'legend' => Mage::helper('sp_events')->__('Event information')
            )
        );

        $model = Mage::registry('event_data');

        if ($model && $model->getId()) {
            $fieldset->addField(
                'event_id',
                'hidden',
                [
                    'name'      => 'event_id',
                    'required'  => true
                ]
            );
        }

        $fieldset->addField(
            'title',
            'text',
            [
                'label' => Mage::helper('sp_events')->__('Title'),
                'required' => false,
                'name' => 'title',
            ]
        );

        $fieldset->addField(
            'display_from',
            'date',
            [
                'name'               => 'display_from',
                'label'              => Mage::helper('sp_events')->__('Date From'),
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
                'label'              => Mage::helper('sp_events')->__('Date To'),
                'tabindex'           => 1,
                'image'              => $this->getSkinUrl('images/grid-cal.gif'),
                'format'             => Mage::app()->getLocale()
                    ->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT)
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

        if (Mage::getSingleton('adminhtml/session')->getData('event_data')) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getData('event_data'));
            Mage::getSingleton('adminhtml/session')->setData('event_data', null);
        } elseif (Mage::registry('event_data')) {
            $form->setValues(Mage::registry('event_data')->getData());
        }

        return parent::_prepareForm();
    }
}
