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
class Delete extends \Magento\Backend\App\Action
{
    
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = $this->_objectManager->create('Magestore\Retailerkittools\Model\Vendor');
                $model->setId($this->getRequest()->getParam('id'))
                    ->delete();
                 $this->messageManager->addSuccess(
                    __('Vendor was successfully deleted')
                );
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                 $this->messageManager->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
        
        $resultPage = $this->_resultPageFactory->create();
        


        return $resultPage;

    }
    
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magestore_Retailerkittools::vendor');
    }
}
