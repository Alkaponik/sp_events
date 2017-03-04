<?php

class SP_FeaturedLinks_Model_Featuredlinks
    extends Mage_Core_Model_Abstract
{
    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init("sp_featuredlinks/featuredlinks");
    }
}