<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2016, Pavel Usachev
 */

class SP_Events_Helper_Data
    extends Mage_Core_Helper_Abstract
{
    const IS_ENABLE_PATH = 'sp_events/general/enabled';
    const SENDER_NAME_PATH = 'sp_events/general/sender_name';

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return (bool)Mage::getStoreConfig(self::IS_ENABLE_PATH);
    }

    /**
     * @return string
     */
    public function getSenderName()
    {
        return Mage::getStoreConfig(self::SENDER_NAME_PATH);
    }

}
