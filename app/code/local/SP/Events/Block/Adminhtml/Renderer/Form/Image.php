<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2016, Pavel Usachev
 */
class SP_Events_Block_Adminhtml_Renderer_Form_Image
    extends Varien_Data_Form_Element_Image
{
    /**
     * @return bool|string
     */
    protected function _getUrl(){
        $url = false;
        if ($this->getValue()) {
            $url = Mage::getBaseUrl('media').'sp_events/'.$this->getValue();
        }
        return $url;
    }
}
