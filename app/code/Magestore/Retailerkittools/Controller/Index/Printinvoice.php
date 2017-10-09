<?php


namespace Magestore\Retailerkittools\Controller\Index;

class Printinvoice extends \Magento\Framework\App\Action\Action
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
        \Magestore\Retailerkittools\Model\Invoice $invoice
    ) {
        $this->_request = $request;
        $this->_transportBuilder = $transportBuilder;
        $this->_storeManager = $storeManager;
        $this->resultPageFactory = $resultPageFactory;
        $this->invoice = $invoice;
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
        if($_FILES['company_logo']['name'] && $_FILES['company_logo']['type'] == 'image/jpeg'){
            try{
                $fname = $_FILES['company_logo']['name'];
                $imageurl = $this->_storeManager-> getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA ).'/barcode/'. $fname;
                $data['company_logo'] = $imageurl;
            }catch(Exception $e){
            } 
        }
        $model = $this->invoice;
        $invoice = $model->setInvoiceData(json_encode($data))->save();
        $invoiceid = $model->getId(); 
        try{
            $transport = $this->_transportBuilder->setTemplateIdentifier('retailerkittools_email_invoice')
                ->setTemplateOptions(['area' => 'frontend', 'store' => $store])
                ->setTemplateVars(
                    [
                        'data' => json_encode($data),
                        'url'   => $this->_url->getUrl('retailerkittools/index/showinvoice/').'?data='.$invoiceid
                    ]
                )
                ->setFrom('general')
                // you can config general email address in Store -> Configuration -> General -> Store Email Addresses
                ->addTo($data['company']['company_email'], $data['company']['company_name'])
                ->getTransport();
            $transport->sendMessage();
        }catch(\Exception $e){

        }
        return $this->resultPageFactory->create();
    }
}
