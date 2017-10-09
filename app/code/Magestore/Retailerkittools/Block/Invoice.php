<?php


namespace Magestore\Retailerkittools\Block;


use Magento\Framework\App\Filesystem\DirectoryList;

class Invoice extends \Magento\Framework\View\Element\Template
{
	public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
 	 public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Directory\Model\CountryFactory $countryFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) { 
    	$this->request = $request;
    	$this->_countryFactory = $countryFactory;
        $this->_storeManager = $storeManager;
        parent::__construct($context);
    }

    public function getCompanyData(){
    	return $this->request->getParam('company');
    }

    public function getCustomerData(){
    	return $this->request->getParam('customer');
    }

    public function getInvoiceNumber(){
    	return $this->request->getParam('invoice_number');
    }

    public function getInvoiceDate(){
    	return $this->request->getParam('invoice_date');
    }
    public function getLineItems(){
    	return $this->request->getParam('line_items');
    }

    public function getNote(){
    	return $this->request->getParam('notes');
    }

    public function getTaxRate(){
    	return $this->request->getParam('tax_rate')/100;
    }

    public function getSubtotal(){
        $subtotal = $this->request->getParam('subtotal');        
        return $this->getCurrency().number_format($subtotal, 2, '.', ',');
        // return Mage::helper('core')->formatPrice($subtotal, true);
    }

    public function getGrandTotal(){
        $subtotal = $this->request->getParam('subtotal');
        $taxAmount = $subtotal * $this->getTaxRate();
        $grandtotal = $taxAmount + $subtotal;
        return $this->getCurrency().number_format($grandtotal, 2, '.', ',');
        // return Mage::helper('core')->formatPrice($grandtotal, true);
    }

    public function getTaxAmount(){
        $subtotal = $this->request->getParam('subtotal');
        $taxAmount = $subtotal * $this->getTaxRate();
        return $this->getCurrency().number_format($taxAmount, 2, '.', ',');
    	// return Mage::helper('core')->formatPrice($taxAmount, true);
    }

    public function getLogo(){
        $result = array();
        $_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        try{
            if($_FILES['company_logo']['name']){
                $fname = $_FILES['company_logo']['name'];
                $uploader = $_objectManager->create(
                        'Magento\MediaStorage\Model\File\Uploader',
                        ['fileId' => 'company_logo']
                    );
                $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                $uploader->setAllowRenameFiles(true);
                $uploader->setFilesDispersion(false);
                $mediaDirectory = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath('barcode/');
                                $result = $uploader->save($mediaDirectory);
                $imageurl = $this->_storeManager-> getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA ).'/barcode/'. $fname;
            } 
        }catch(Exception $e){

        } 
         if(!isset($imageurl)){
            $imageurl = $this->request->getParam('company_logo');
        }
        return $imageurl;
    }

    public function getCurrency(){
        return $this->request->getParam('currencies');
    }
}
