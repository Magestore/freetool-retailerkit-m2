<?php


namespace Magestore\Retailerkittools\Controller\Adminhtml\Index;

class Printinvoice extends \Magento\Backend\App\Action
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
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
    	 $resultPageFactory = $this->getPageFactory();
        return $resultPageFactory;
        // $data = $this->getRequest()->getPostValue()
        // $translate = Mage::getSingleton('core/translate');
        // $translate->setTranslateInline(false);
        // $templateId = 'retailerkittools_email_invoice';
        // $senderName = Mage::getStoreConfig('trans_email/ident_support/name');
        // $senderEmail = Mage::getStoreConfig('trans_email/ident_support/email');     
        // $sender = array('name' => $senderName,
        //             'email' => $senderEmail);
        // $recepientEmail = $data['company']['company_email'];
        // $recepientName = $data['company']['company_name'];
        // if($_FILES['company_logo']['name'] && $_FILES['company_logo']['type'] == 'image/jpeg'){
        //     try{
        //         $fname = $_FILES['company_logo']['name'];
        //         $imageurl = Mage::getBaseUrl('media') . DS . 'barcode'. DS . $fname;
        //         $data['company_logo'] = $imageurl;
        //     }catch(Exception $e){
        //     } 
        // }  
        // $store = Mage::app()->getStore()->getId();
        // $model = Mage::getModel('retailerkittools/invoice');
        // $invoice = $model->setInvoiceData(json_encode($data))->save();
        // $invoiceid = $model->getId();  
        // $vars = array(
        //     'data' => json_encode($data),
        //     'url'   => Mage::getUrl('retailerkittools/index/showinvoice/').'?data='.$invoiceid
        // );             
        // Mage::getModel('core/email_template')
        //     ->sendTransactional($templateId, $sender, $recepientEmail, $recepientName, $vars, 0);
                
        // $translate->setTranslateInline(true);
    }
}
