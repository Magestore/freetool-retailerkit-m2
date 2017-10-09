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


use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultFactory;

class MassDelete extends \Magento\Backend\App\Action
{
    /**
     * Massactions filter
     *
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param Context $context
     * @param Builder $productBuilder
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Ui\Component\MassAction\Filter $filter,
        RequestInterface $request,
        \Magestore\Retailerkittools\Model\ResourceModel\Vendor\CollectionFactory $collectionFactory
    ) {
        $this->filter = $filter;
        $this->request = $request;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $vendorDeleted = 0;
        foreach ($collection->getItems() as $vendor) {
            $vendor->delete();
            $vendorDeleted++;
        }
        $this->messageManager->addSuccess(
            __('A total of %1 record(s) have been deleted.', $vendorDeleted)
        );

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('retailerkittools/*/index');
    }
    
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magestore_Retailerkittools::vendor');
    }
}
