<?php


namespace Magestore\Retailerkittools\Controller\Index;

class Showinvoice extends \Magento\Framework\App\Action\Action
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
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Directory\Model\CountryFactory $countryFactory,
        \Magestore\Retailerkittools\Model\InvoiceFactory $invoiceFactory
    ) {
    	$this->_request = $request;
        $this->invoice = $invoiceFactory;
        $this->resultPageFactory = $resultPageFactory;
    	$this->_countryFactory = $countryFactory;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        return $this->resultPageFactory->create();
    }
}
