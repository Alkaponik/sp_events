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
    const PHONE_NAME_PATH = 'sp_events/general/header_phones';

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return true;
    }

    /**
     * @return string
     */
    public function getSenderName()
    {
        return Mage::getStoreConfig(self::SENDER_NAME_PATH);
    }

    public function getDateRange()
    {
        $now = date('Y-m-d');

        return ($now >= Mage::getStoreConfig('sp_events/slider/date_from')
            && $now <= Mage::getStoreConfig('sp_events/slider/date_to'));
    }

    public function getHeaderPhones()
    {
        return Mage::getStoreConfig(self::PHONE_NAME_PATH);
    }

}
