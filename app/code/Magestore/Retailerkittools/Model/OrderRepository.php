<?php


namespace Magestore\Retailerkittools\Model;

use Magestore\Retailerkittools\Api\OrderRepositoryInterface;
use Magestore\Retailerkittools\Api\Data\OrderSearchResultsInterfaceFactory;
use Magestore\Retailerkittools\Api\Data\OrderInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magestore\Retailerkittools\Model\ResourceModel\Order as ResourceOrder;
use Magestore\Retailerkittools\Model\ResourceModel\Order\CollectionFactory as OrderCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class OrderRepository implements orderRepositoryInterface
{

    protected $resource;

    protected $orderFactory;

    protected $orderCollectionFactory;

    protected $searchResultsFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $dataOrderFactory;

    private $storeManager;


    /**
     * @param ResourceOrder $resource
     * @param OrderFactory $orderFactory
     * @param OrderInterfaceFactory $dataOrderFactory
     * @param OrderCollectionFactory $orderCollectionFactory
     * @param OrderSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceOrder $resource,
        OrderFactory $orderFactory,
        OrderInterfaceFactory $dataOrderFactory,
        OrderCollectionFactory $orderCollectionFactory,
        OrderSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->orderFactory = $orderFactory;
        $this->orderCollectionFactory = $orderCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataOrderFactory = $dataOrderFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Magestore\Retailerkittools\Api\Data\OrderInterface $order
    ) {
        /* if (empty($order->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $order->setStoreId($storeId);
        } */
        try {
            $order->getResource()->save($order);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the order: %1',
                $exception->getMessage()
            ));
        }
        return $order;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($orderId)
    {
        $order = $this->orderFactory->create();
        $order->getResource()->load($order, $orderId);
        if (!$order->getId()) {
            throw new NoSuchEntityException(__('Order with id "%1" does not exist.', $orderId));
        }
        return $order;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->orderCollectionFactory->create();
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
        \Magestore\Retailerkittools\Api\Data\OrderInterface $order
    ) {
        try {
            $order->getResource()->delete($order);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Order: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($orderId)
    {
        return $this->delete($this->getById($orderId));
    }
}
