<?php


namespace Magestore\Retailerkittools\Model;

use Magestore\Retailerkittools\Api\InvoiceRepositoryInterface;
use Magestore\Retailerkittools\Api\Data\InvoiceSearchResultsInterfaceFactory;
use Magestore\Retailerkittools\Api\Data\InvoiceInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magestore\Retailerkittools\Model\ResourceModel\Invoice as ResourceInvoice;
use Magestore\Retailerkittools\Model\ResourceModel\Invoice\CollectionFactory as InvoiceCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class InvoiceRepository implements invoiceRepositoryInterface
{

    protected $resource;

    protected $invoiceFactory;

    protected $invoiceCollectionFactory;

    protected $searchResultsFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $dataInvoiceFactory;

    private $storeManager;


    /**
     * @param ResourceInvoice $resource
     * @param InvoiceFactory $invoiceFactory
     * @param InvoiceInterfaceFactory $dataInvoiceFactory
     * @param InvoiceCollectionFactory $invoiceCollectionFactory
     * @param InvoiceSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceInvoice $resource,
        InvoiceFactory $invoiceFactory,
        InvoiceInterfaceFactory $dataInvoiceFactory,
        InvoiceCollectionFactory $invoiceCollectionFactory,
        InvoiceSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->invoiceFactory = $invoiceFactory;
        $this->invoiceCollectionFactory = $invoiceCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataInvoiceFactory = $dataInvoiceFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Magestore\Retailerkittools\Api\Data\InvoiceInterface $invoice
    ) {
        /* if (empty($invoice->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $invoice->setStoreId($storeId);
        } */
        try {
            $invoice->getResource()->save($invoice);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the invoice: %1',
                $exception->getMessage()
            ));
        }
        return $invoice;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($invoiceId)
    {
        $invoice = $this->invoiceFactory->create();
        $invoice->getResource()->load($invoice, $invoiceId);
        if (!$invoice->getId()) {
            throw new NoSuchEntityException(__('Invoice with id "%1" does not exist.', $invoiceId));
        }
        return $invoice;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->invoiceCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
                    $collection->addStoreFilter($filter->getValue(), false);
                    continue;
                }
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Magestore\Retailerkittools\Api\Data\InvoiceInterface $invoice
    ) {
        try {
            $invoice->getResource()->delete($invoice);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Invoice: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($invoiceId)
    {
        return $this->delete($this->getById($invoiceId));
    }
}
