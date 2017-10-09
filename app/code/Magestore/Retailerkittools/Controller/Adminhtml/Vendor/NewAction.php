<?php

namespace Magestore\Retailerkittools\Controller\Adminhtml\Vendor;

/**
 * Adminhtml Giftvoucher New Action
 *
 * @category Magestore
 * @package  Magestore_Giftvoucher
 * @module   Giftvoucher
 * @author   Magestore Developer
 */
class NewAction extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * NewAction constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
    ) {
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('edit');
    }
    
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magestore_Retailerkittools::vendor');
    }
}
