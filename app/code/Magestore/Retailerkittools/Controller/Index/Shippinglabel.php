<?php

namespace Magestore\Retailerkittools\Controller\Index;

class Shippinglabel extends \Magento\Framework\App\Action\Action
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
        \Magestore\Retailerkittools\Model\Label $label,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->_request = $request;
        $this->_transportBuilder = $transportBuilder;
        $this->_storeManager = $storeManager;
        $this->label = $label;
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
        $data = $this->getRequest()->getParams();
        $store = $this->_storeManager->getStore()->getId();
        $model = $this->label;
        $label = $model->setLabelData(json_encode($data))->save();
        $labelid = $model->getId(); 
        try{
            $transport = $this->_transportBuilder->setTemplateIdentifier('retailerkittools_email_label')
                ->setTemplateOptions(['area' => 'frontend', 'store' => $store])
                ->setTemplateVars(
                    [
                        'data' => json_encode($data),
                        'url'   => $this->_url->getUrl('retailerkittools/index/showlabel/').'?data='.$labelid
                    ]
                )
                ->setFrom('general')
                // you can config general email address in Store -> Configuration -> General -> Store Email Addresses
                ->addTo($data['sender']['email'],$data['sender']['first_name'])
                ->getTransport();
            $transport->sendMessage();
        }catch(\Exception $e){

        }
        return $this->resultPageFactory->create();
    }
}
