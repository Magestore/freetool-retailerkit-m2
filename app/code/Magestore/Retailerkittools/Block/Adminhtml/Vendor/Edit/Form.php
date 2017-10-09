<?php


namespace Magestore\Retailerkittools\Block\Adminhtml\Vendor\Edit;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{

    protected function _prepareForm()
    {
        $form = $this->_formFactory->create(
            array(
                'data' => array(
                    'id' => 'edit_form',
                    'action' => $this->getUrl('*/*/save'),
                    'method' => 'post',
                    'enctype' => 'multipart/form-data'
                )
            )
        );

        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
