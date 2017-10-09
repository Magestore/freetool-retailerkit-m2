<?php


namespace Magestore\Retailerkittools\Controller\Adminhtml\Index;

class Changevendor extends \Magento\Backend\App\Action
{

    protected $resultPageFactory;

    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magestore\Retailerkittools\Model\Vendor $vendor,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
    	$this->vendor = $vendor;
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $result = array();
        $vendorid = $this->getRequest()->getParam('vendorid');
        $vendor = $this->vendor->load($vendorid);
        $result['vendor_name'] = $vendor->getData('vendor_name');
        $result['vendor_email'] = $vendor->getData('vendor_email');
        $result['vendor_phone'] = $vendor->getData('vendor_phone');
        $result['vendor_address'] = $vendor->getData('vendor_address');
        $result['vendor_city'] = $vendor->getData('vendor_city');
        $result['vendor_country'] = $vendor->getData('vendor_country');
        $result['vendor_zipcode'] = $vendor->getData('vendor_zipcode');
        $result['vendor_state'] = $vendor->getData('vendor_state');
        $result['vendor_state_id'] = $vendor->getData('vendor_state_id');
        return $this->resultJsonFactory->create()->setData($result);
    }
}
