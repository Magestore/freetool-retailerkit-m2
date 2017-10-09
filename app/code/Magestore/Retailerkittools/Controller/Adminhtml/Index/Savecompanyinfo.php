<?php


namespace Magestore\Retailerkittools\Controller\Adminhtml\Index;

use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\App\Filesystem\DirectoryList;

class Savecompanyinfo extends \Magento\Backend\App\Action
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
        \Magento\Config\Model\Config\Factory $configFactory,
        \Magento\Framework\Filesystem $fileSystem
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->configWriter = $configWriter;
        $this->configFactory = $configFactory;
        $this->_filesystem = $fileSystem;
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
        try{
            if($_FILES['company_logo']['name']){
                $logo = $_FILES['company_logo']['name'];
                $uploader = $this->_objectManager->create(
                        'Magento\MediaStorage\Model\File\Uploader',
                        ['fileId' => 'company_logo']
                    );
                $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                $uploader->setAllowRenameFiles(true);
                $uploader->setFilesDispersion(false);
                $mediaDirectory = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath('barcode/');
                                $result = $uploader->save($mediaDirectory);
                $configData = [
                    'section' => 'retailerkittools',
                    'website' => null,
                    'store'   => null,
                    'groups'  => [
                        'company' => [
                            'fields' => [
                                'company_logo' => ['value' => $logo,],
                            ],
                        ],
                    ],
                ];
                $configModel = $this->configFactory->create(['data' => $configData]);
                $configModel->save();
            }
            $data = $this->getRequest()->getParam('company');
            if($data){ 
                $configData = [
                    'section' => 'retailerkittools',
                    'website' => null,
                    'store'   => null,
                    'groups'  => [
                        'company' => [
                            'fields' => [
                                'company_name' => ['value' => $data["company_name"],],
                                'company_email' => ['value' => $data["company_email"],],
                                'company_address' => ['value' => $data["company_address"],],
                                'company_city' => ['value' => $data["company_city"],],
                                'company_zipcode' => ['value' => $data["company_zipcode"],],
                                'company_country' => ['value' => $data["country"],],
                                'company_state' => ['value' => $data["province"],],
                                'company_state_id' => ['value' => $data["province_id"],],
                            ],
                        ],
                    ],
                ];
                $configModel = $this->configFactory->create(['data' => $configData]);
                $configModel->save();
            }
            $this->messageManager->addSuccess(
                    __('Company Information was successfully saved')
                );
        }catch( Exception $e){

        }

        return $this->_redirect('*/*/companyinfo');
    }
}
