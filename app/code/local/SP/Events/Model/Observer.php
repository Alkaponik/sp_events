<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2016, Pavel Usachev
 */

/**
 * Class SP_Events_Model_Observer
 */
class SP_Events_Model_Observer
{
    /**
     * @var SP_Events_Helper_Data
     */
    protected $_helper;

    /**
     * SP_Events_Model_Observer constructor.
     */
    public function __construct()
    {
        $this->_helper = Mage::helper('sp_events');
    }

    /**
     * @param Varien_Event_Observer $observer
     */
    public function removeImages($observer)
    {
        $event = $observer->getItem();

        $this->_helper->deleteImage($event->getImage());
    }
}

