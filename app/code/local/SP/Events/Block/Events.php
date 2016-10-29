<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2016, Pavel Usachev
 */

class SP_Events_Block_Events
    extends Mage_Core_Block_Template
{
    public function getCollection()
    {
        return Mage::getSingleton('sp_events/event')
                    ->getCollection()
                    ->addFieldToFilter('is_active', 1)
                    ->addFieldToFilter(
                        'display_from', ['from' => now()]
                    )
                    ->addFieldToFilter(
                        'display_to', ['to' => now()]
                    );
    }
}