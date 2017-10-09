<?php


namespace Magestore\Retailerkittools\Model;

use Magestore\Retailerkittools\Api\Data\VendorInterfaceFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;
use Magestore\Retailerkittools\Api\VendorRepositoryInterface;
use Magento\Framework\Api\SortOrder;
use Magestore\Retailerkittools\Api\Data\VendorSearchResultsInterfaceFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magestore\Retailerkittools\Model\ResourceModel\Vendor as ResourceVendor;
use Magestore\Retailerkittools\Model\ResourceModel\Vendor\CollectionFactory as VendorCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;

class VendorRepository implements vendorRepositoryInterface
{

    protected $dataVendorFactory;

    private $storeManager;

    protected $searchResultsFactory;

    protected $vendorFactory;

    protected $dataObjectProcessor;

    protected $dataObjectHelper;

    protected $vendorCollectionFactory;

    protected $resource;


    /**
     * @param ResourceVendor $resource
     * @param VendorFactory $vendorFactory
     * @param VendorInterfaceFactory $dataVendorFactory
     * @param VendorCollectionFactory $vendorCollectionFactory
     * @param VendorSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceVendor $resource,
        VendorFactory $vendorFactory,
        VendorInterfaceFactory $dataVendorFactory,
        VendorCollectionFactory $vendorCollectionFactory,
        VendorSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->vendorFactory = $vendorFactory;
        $this->vendorCollectionFactory = $vendorCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataVendorFactory = $dataVendorFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Magestore\Retailerkittools\Api\Data\VendorInterface $vendor
    ) {
        /* if (empty($vendor->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $vendor->setStoreId($storeId);
        } */
        try {
            $vendor->getResource()->save($vendor);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the vendor: %1',
                $exception->getMessage()
            ));
        }
        return $vendor;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($vendorId)
    {
        $vendor = $this->vendorFactory->create();
        $vendor->getResource()->load($vendor, $vendorId);
        if (!$vendor->getId()) {
            throw new NoSuchEntityException(__('Vendor with id "%1" does not exist.', $vendorId));
        }
        return $vendor;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->vendorCollectionFactory->create();
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
        \Magestore\Retailerkittools\Api\Data\VendorInterface $vendor
    ) {
        try {
            $vendor->getResource()->delete($vendor);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Vendor: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($vendorId)
    {
        return $this->delete($this->getById($vendorId));
    }
}
