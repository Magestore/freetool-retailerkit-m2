<?php

namespace Magestore\Retailerkittools\Controller\Adminhtml\Vendor;

/**
 * Adminhtml Giftvoucher New Action
 *
 * @category Magestore
 * @package  Magestore_Giftvoucher
 * @module   Giftvoucher
 * @author   Magestore Developer
 */
class State extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * NewAction constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
    ) {
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }

    public function execute()
    {
    	$countryHelper = $this->_objectManager->get('Magento\Directory\Model\Config\Source\Country'); 
        $countrycode = $this->getRequest()->getParam('country');
        $countryFactory = $this->_objectManager->get('Magento\Directory\Model\CountryFactory');
        $state = '';

        $countries = $countryHelper->toOptionArray(); 
	    foreach ( $countries as $countryKey => $country ) {
	        if ( $country['value'] == $countrycode ) { 
	            $stateArray = $countryFactory->create()->setId(
	                $country['value']
	            )->getLoadedRegionCollection()->toOptionArray();
	            foreach ($stateArray as $_state) {
	                $state .= "<option value='" . $_state['value'] . "'>" . $_state['label'] . "</option>";
	            }
	        }
	    }
        echo $state;
    }
    
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magestore_Retailerkittools::vendor');
    }
}
