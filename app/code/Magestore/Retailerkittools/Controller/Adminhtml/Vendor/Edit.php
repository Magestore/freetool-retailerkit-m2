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
class Edit extends \Magento\Backend\App\Action
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

        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create('Magestore\Retailerkittools\Model\Vendor');
        $registryObject = $this->_objectManager->get('Magento\Framework\Registry');
        
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This vendor no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
        }

        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $registryObject->register('vendor_data', $model);
        
        $resultPage = $this->_resultPageFactory->create();
        if($id){
            $resultPage->getConfig()->getTitle()->prepend(__('Edit Vendor "%1"', $model->getVendorName()));
        }else {
            $resultPage->getConfig()->getTitle()->prepend(__('Add New Vendor'));
        }
        


        return $resultPage;

    }
    
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magestore_Retailerkittools::vendor');
    }
}
