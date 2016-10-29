<?php

class SP_Events_Model_Event
    extends Mage_Core_Model_Abstract
{
    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init("sp_events/event");
    }
}
