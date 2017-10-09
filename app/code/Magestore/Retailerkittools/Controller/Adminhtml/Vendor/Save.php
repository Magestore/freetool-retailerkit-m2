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
class Save extends \Magento\Backend\App\Action
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
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory,
        \Magestore\Retailerkittools\Model\Vendor $vendor
    ) {
        $this->resultForwardFactory = $resultForwardFactory;
        $this->vendor = $vendor;
        parent::__construct($context);
    }

    public function execute()
    {	$authSession = $this->_objectManager->create('Magento\Backend\Model\Auth\Session');
    	if ($data = $this->getRequest()->getPostValue()) {
            $model = $this->vendor;
            $model->setData($data)
                ->setId($this->getRequest()->getParam('vendor_id'));
            
            try {
                $model->save();
                $this->messageManager->addSuccess(
                	__('Vendor was successfully saved')
                );
                 $this->_getSession()->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                 $this->_getSession()->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(
            __('Unable to find item to save')
        );
        $this->_redirect('*/*/');
    }
    
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magestore_Retailerkittools::vendor');
    }
}
