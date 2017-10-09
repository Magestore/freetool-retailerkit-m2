<?php


namespace Magestore\Retailerkittools\Block;


use Magento\Framework\App\Filesystem\DirectoryList;

class Barcode extends \Magento\Framework\View\Element\Template
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
        \Magestore\Retailerkittools\Helper\Data $retailerkittoolHelper
    ) { 
    	$this->request = $request;
    	$this->_countryFactory = $countryFactory;
        $this->_storeManager = $storeManager;
        $this->_filesystem = $fileSystem;
        $this->_retailerkittoolHelper = $retailerkittoolHelper;
        parent::__construct($context);
    }

	 public function getBarcodeString(){
    	return $this->request->getParam('query');
    }

    public function getBarcodeImage(){    	
        $barcodeString = $this->request->getParam('query');
        $filename="barcode.png";
        $file = \Zend_Barcode::draw('code128', 'image', array('text' => $barcodeString, 'drawText' => false,'barHeight'=> 25, 'factor'=>3), array());
        $barcode_path= "barcode.png";

        $store_image = imagepng($file,$this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath('barcode/').$barcode_path);
        if($store_image)
        {           
            $urlImage = $this->_storeManager-> getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA ).'/barcode/'. $barcode_path;    
        }
        return $urlImage;
    }
}