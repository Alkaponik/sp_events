<?php


class SP_FeaturedLinks_Model_System_Config_Source_Topbottom
{
    const TOP = 1;
    const BOTTOM = 0;

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => self::TOP, 'label'=>Mage::helper('adminhtml')->__('Top')),
            array('value' => self::BOTTOM, 'label'=>Mage::helper('adminhtml')->__('Bottom')),
        );
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            self::BOTTOM => Mage::helper('adminhtml')->__('Top'),
            self::TOP => Mage::helper('adminhtml')->__('Bottom'),
        );
    }
}
