<?php

/**
 * Magestore
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magestore.com license that is
 * available through the world-wide-web at this URL:
 * http://www.magestore.com/license-agreement.html
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Magestore
 * @package     Magestore_Retailerkittools
 * @module     Retailerkittools
 * @author      Magestore Developer
 *
 * @copyright   Copyright (c) 2016 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 *
 */

/**
 * Retailerkittools Earning Rate Edit Block
 * 
 * @category     Magestore
 * @package     Magestore_Retailerkittools
 * @author      Magestore Developer
 */
namespace Magestore\Retailerkittools\Block\Adminhtml\Vendor;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
	 protected $_coreRegistry;
    
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Magestore_Retailerkittools_Block_Adminhtml_Earning_Edit constructor.
     */
    public function _construct() {
        parent::_construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'Magestore_Retailerkittools';
        $this->_controller = 'adminhtml_vendor';

        $this->buttonList->update('save', 'label', __('Save'));
        $this->buttonList->update('delete', 'label', __('Delete'));

        $this->buttonList->update('saveandcontinue', array(
            'label' => __('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
                ), -100);

        $this->_formScripts[] = "
            require([
                    'prototype'
                ], function () {
                function saveAndContinueEdit(){
                    editForm.submit($('edit_form').action+'back/edit/');
                }
            })
        ";
    }

    /**
     * get text to show in header when edit an item
     *
     * @return string
     */
    public function getHeaderText() {
        if ($this->_coreRegistry->registry('vendor_data') && $this->_coreRegistry->registry('vendor_data')->getId()
        ) {
            return __("Edit Vendor '%s'", $this->_coreRegistry->registry('vendor_data')->getVendorName()
            );
        }
        return __('Add Vendor');
    }

}
