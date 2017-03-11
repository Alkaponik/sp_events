<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */
class SP_FeaturedLinks_Block_Adminhtml_Links_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * @return Mage_Adminhtml_Block_Widget_Form
     * @throws Exception
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(
            [
                'id' => 'edit_form',
                'action' => $this->getUrl(
                    '*/*/save',
                    [
                        'link_id' => $this->getRequest()->getParam('link_id')
                    ]
                ),
                'method' => 'post',
                'enctype' => 'multipart/form-data'
            ]
        );

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
