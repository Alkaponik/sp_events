<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2016, Pavel Usachev
 */

for ($i = 0; $i < 20; $i++) {
    $model = Mage::getModel('sp_events/event');
    $model->setTitle(sprintf("Title_%d", $i));
    $model->setImage(sprintf("image_%d", $i));
    $model->setDisplayFrom('28-10-2016');
    $model->setDisplayTo('31-10-2016');

    try {
        $model->save();
    } catch (Exception $e) {
        Mage::logException($e);
    }
}

