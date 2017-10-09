<?php

namespace Magestore\Retailerkittools\Controller\Index;

class Barcode extends \Magento\Framework\App\Action\Action
{

    protected $resultPageFactory;

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Action\Context  $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,\Magento\Framework\App\Request\Http $request,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->_request = $request;
        $this->_transportBuilder = $transportBuilder;
        $this->_storeManager = $storeManager;
        $this->resultPageFactory = $resultPageFactory;
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
        try{
            $transport = $this->_transportBuilder->setTemplateIdentifier('retailerkittools_email_barcode')
                ->setTemplateOptions(['area' => 'frontend', 'store' => $store])
                ->setTemplateVars(
                    [
                        'data' => json_encode($data),
                        'url'   => $this->_url->getUrl('retailerkittools/index/showbarcode/').'?query='.$data['query'],
                    ]
                )
                ->setFrom('general')
                // you can config general email address in Store -> Configuration -> General -> Store Email Addresses
                ->addTo($data['email'], $data['email'])
                ->getTransport();
            $transport->sendMessage();
        }catch(\Exception $e){
            
        }
        return $this->resultPageFactory->create();
    }
}
