<?php


namespace Magestore\Retailerkittools\Controller\Index;

class Printorder extends \Magento\Framework\App\Action\Action
{

    protected $resultPageFactory;

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Action\Context  $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magestore\Retailerkittools\Model\Order $order,
        \Magestore\Retailerkittools\Model\Vendor $vendor
    ) {        
        $this->_request = $request;
        $this->_transportBuilder = $transportBuilder;
        $this->_storeManager = $storeManager;
        $this->resultPageFactory = $resultPageFactory;
        $this->order = $order;
        $this->vendor = $vendor;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {   
        $store = $this->_storeManager->getStore()->getId();
        $data = $this->getRequest()->getParams();
        $vendorData = $data['vendor'];
        $vendorModel = $this->vendor;
        $vendorId = $this->vendorIdExisted($vendorData['vendor_email']);
        $vendorModel->setData($vendorData)
                        ->setVendorId($vendorId)
                        ->setVendorPhone($vendorData['phone'])
                        ->setVendorAddress($vendorData['address'])
                        ->setVendorCity($vendorData['city'])
                        ->setVendorCountry($vendorData['country'])
                        ->setVendorZipcode($vendorData['zip'])
                        ->setVendorState($vendorData['province'])
                        ->setVendorStateId($vendorData['province_id']);
        try {
            $vendorModel->save();
        }catch(Exception $e){

        }
        if($_FILES['company_logo']['name'] && $_FILES['company_logo']['type'] == 'image/jpeg'){
            try{
                $fname = $_FILES['company_logo']['name'];
                $imageurl = $this->_storeManager-> getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA ).'/barcode/'. $fname;
                $data['company_logo'] = $imageurl;
            }catch(\Exception $e){
            } 
        }
        $model = $this->order;
        $order = $model->setOrderData(json_encode($data))->save();
        $orderid = $model->getId(); 
        try{
            $transport = $this->_transportBuilder->setTemplateIdentifier('retailerkittools_email_order')
                ->setTemplateOptions(['area' => 'frontend', 'store' => $store])
                ->setTemplateVars(
                    [
                        'data' => json_encode($data),
                        'url'   => $this->_url->getUrl('retailerkittools/index/showorder/').'?data='.$orderid
                    ]
                )
                ->setFrom('general')
                ->addTo($data['company']['email'], $data['company']['company_name'])
                ->getTransport();
            $transport->sendMessage();
        }catch(\Exception $e){

        }
        return $this->resultPageFactory->create();
    }

    public function vendorIdExisted($email){
        $vendor =$this->vendor->getCollection()->addFieldToFilter('vendor_email', $email)->getFirstItem();
        if($vendor->getId()){
            return $vendor->getId();
        }
        return null;
    }
}
