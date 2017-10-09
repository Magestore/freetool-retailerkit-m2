<?php


namespace Magestore\Retailerkittools\Block;


use Magento\Framework\App\Filesystem\DirectoryList;

class Shippinglabel extends \Magento\Framework\View\Element\Template
{
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
 	 public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Directory\Model\CountryFactory $countryFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Filesystem $fileSystem,
        \Magestore\Retailerkittools\Helper\Data $retailerkittoolHelper,
        \Magestore\Retailerkittools\Model\Label $label
    ) { 
    	$this->request = $request;
    	$this->_countryFactory = $countryFactory;
        $this->_storeManager = $storeManager;
        $this->_filesystem = $fileSystem;
        $this->_retailerkittoolHelper = $retailerkittoolHelper;
        $this->_label = $label;
        parent::__construct($context);
    }

    public function getSenderData(){
    	return $this->request->getParam('sender');
    }

    public function getReceiverData(){
    	return $this->request->getParam('receiver');
    }

    public function getShippingDate(){
    	return $this->request->getParam('shipping_date');
    }
    public function getTrackingNumber(){
    	return $this->request->getParam('tracking_number');
    }

    public function getWeight(){
    	return $this->request->getParam('weight');
    }

    public function getUnitOfMeasurement(){
        return $this->request->getParam('unit_measurement');
    }

     public function getBarcodeUrl()
    {        
        $result = array();
        $filename="barcode.png";
        $barcodeString = $this->request->getParam('tracking_number');
        if(!$barcodeString){
            $id = $this->request->getParam('data');
            $label = $this->_label->load($id);
            $data = json_decode($label->getLabelData());
            
            $barcodeString = $data->tracking_number;
        }
        $file = \Zend_Barcode::draw('code128', 'image', array('text' => $barcodeString, 'drawText' => false), array());
        $barcode_path= "barcode.png";

        $store_image = imagepng($file,$this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath('barcode/').$barcode_path);
        $urlImage = '';
        if($store_image)
        {
            $urlImage = $this->_storeManager-> getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA ).'/barcode/'. $barcode_path;            
        }
        return $urlImage;
    }

    public function getCompanyLogo(){
        return $this->_storeManager-> getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA ).'/barcode/'.$this->_retailerkittoolHelper->getRetailerKitToolsConfig('company','company_logo');
    }
}