<?php

$model = Mage::getModel('sp_featuredlinks/featuredlinks');

for ($i=0; $i < 10; $i++) {
    $model->setData([
        'title' => sprintf("Test %d", $i),
        'link'  => 'asdasd',
        'image' => 'test.png',
    ]);

    $model->save();
}
