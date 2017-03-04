<?php


class Topbutton extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
    public function getAllOptions()
    {
        if (is_null($this->_options)) {
            $this->_options = array(
                array(
                    'label' => 'Top',
                    'value' =>  'Top'
                ),
                array(
                    'label' => 'Bottom',
                    'value' =>  'Bottom'
                ),
            );
        }
        return $this->_options;
    }

}