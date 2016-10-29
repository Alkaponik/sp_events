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
                        'display_from', ['lteq' => date('Y-m-d')]
                    )
                    ->addFieldToFilter(
                        'display_to', ['gteq' => date('Y-m-d')]
                    );
    }
}