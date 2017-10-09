<?php


namespace Magestore\Retailerkittools\Controller\Adminhtml\Index;

use Magento\Framework\App\Config\Storage\WriterInterface;

class Saveshippingsender extends \Magento\Backend\App\Action
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
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        WriterInterface $configWriter,
        \Magento\Config\Model\Config\Factory $configFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_configWriter = $configWriter;
        $this->configFactory = $configFactory;
        parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    { 
    	$data = $this->getRequest()->getParam('sender');
        try{
            if($data){
                $configData = [
                    'section' => 'retailerkittools',
                    'website' => null,
                    'store'   => null,
                    'groups'  => [
                        'shipping_sender' => [
                            'fields' => [
                                'first_name' => ['value' => $data["first_name"],],
                                'last_name' => ['value' => $data["last_name"],],
                                'email' => ['value' => $data["email"],],
                                'address' => ['value' => $data["address"],],
                                'city' => ['value' => $data["city"],],
                                'zipcode' => ['value' => $data["zip"],],
                                'country' => ['value' => $data["country"],],
                                'state' => ['value' => $data["province"],],
                                'state_id' => ['value' => $data["province_id"],],
                            ],
                        ],
                    ],
                ];
                $configModel = $this->configFactory->create(['data' => $configData]);
                $configModel->save();
            }
            $this->messageManager->addSuccess(
                   __('Shipping Sender Information was successfully saved')
                );
        }catch(Exception $e){

        }

        return $this->_redirect('*/*/shippingsender');
    }
}
