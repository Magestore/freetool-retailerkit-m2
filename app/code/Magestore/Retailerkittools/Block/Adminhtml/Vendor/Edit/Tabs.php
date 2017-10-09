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
 * Retailerkittools Vendor Edit Tabs Block
 * 
 * @category    Magestore
 * @package     Magestore_Retailerkittools
 * @author      Magestore Developer
 */
namespace Magestore\Retailerkittools\Block\Adminhtml\Vendor\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
     /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;
    
    
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Json\EncoderInterface $jsonEncoder
     * @param \Magento\Backend\Model\Auth\Session $authSession
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Backend\Model\Auth\Session $authSession,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        array $data = []
    ) {
        parent::__construct($context, $jsonEncoder, $authSession, $data);
        $this->_objectManager = $objectManager;
    }

    /**
     * Magestore_Retailerkittools_Block_Adminhtml_Earning_Edit_Tabs constructor.
     */
    public function _construct()
    {
        parent::_construct();
        $this->setId('retailerkittools_vendor_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Vendor Information'));
    }
    
    /**
     * prepare before render block to html
     *
     * @return Magestore_Retailerkittools_Block_Adminhtml_Vendor_Edit_Tabs
     */
    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => __('Vendor Information'),
            'title'     => __('Vendor Information'),
            'content'   => $this->getLayout()
                                ->createBlock('Magestore\Retailerkittools\Block\Adminhtml\Vendor\Edit\Tab\Form')
                                ->toHtml(),
        ));
        return parent::_beforeToHtml();
    }
}
