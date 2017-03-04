<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class SP_FeaturedLinks_Block_Items
    extends Mage_Core_Block_Template
{
    public function getItems()
    {
        return Mage::getModel('sp_featuredlinks/featuredlinks')->getCollection();
    }
}
